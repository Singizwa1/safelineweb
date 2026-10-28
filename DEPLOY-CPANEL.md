# SafeLine — deploying to cPanel

Upload package: `safeline-website-<date>.zip` (in your Downloads folder).
802 files, 51 MB zipped — every page, the whole `assets` tree, `images`,
`includes`, `storage`, `.htaccess`, `.well-known`, and the `Car Transiport`
template folder.

---

## 1. Upload

1. cPanel → **File Manager** → open `public_html`.
2. If anything is already there and you want a clean start, select all → **Compress**
   to a backup zip first, then delete.
3. **Upload** the zip into `public_html`.
4. Select it → **Extract**. Everything must land *directly* in `public_html`,
   not inside a `safeline/` subfolder. Check that `index.php` sits at
   `public_html/index.php`.
5. Delete the zip once extracted.

> **Show hidden files first.** In File Manager: *Settings → Show Hidden Files
> (dotfiles)*. The site will not work without `.htaccess`, and you cannot
> confirm it uploaded unless hidden files are visible.

---

## 2. Set the PHP version

cPanel → **Select PHP Version** → choose **8.0 or newer** (built and tested on
8.2). No extensions beyond a default cPanel build are required.

---

## 3. Permissions

| Path | Permission |
|---|---|
| folders | `755` |
| files | `644` |
| `storage/` | `755` (must be **writable** by PHP) |

`storage/` is where a booking is written if the server's mail transport is
down, so it must be writable or that fallback silently fails.

---

## 4. Where the forms go

Two separate things, both in `includes/config.php`:

```php
// 1. The inbox that RECEIVES submissions
$form_delivery_email = 'twagiramunguserge@gmail.com';

// 2. The address DISPLAYED to visitors (top bar, footer, contact page)
$contact_email = 'info@safeline.com';
```

**Delivery** — both the booking form and the contact form are emailed to
`$form_delivery_email`. Change that one line and both follow.

**Display** — `$contact_email` is only ever printed as a `mailto:` link so
visitors can write to you directly. The site never delivers anything to it.
The delivery inbox is never printed in the page source.

The booking form additionally posts to the dispatch API at
`https://mis.sangotaxi.com/api/booking/create_booking` — that is the real
booking and it works regardless of email. The email is a backup copy; if PHP
`mail()` is unavailable the booking is appended to `storage/bookings.log`.

### Two things to check after upload

**Does mail arrive?** Submit the contact form once and check the Gmail inbox —
**including spam**. Gmail judges the message by the *sending* domain's SPF and
DKIM records, so mail from a new cPanel server often lands in spam until those
are set. cPanel → *Email Deliverability* shows whether SPF and DKIM are valid
for your domain and offers to fix them.

**Do you own safeline.com?** `info@safeline.com` is shown to every visitor as a
clickable address. If that mailbox does not exist, anyone who writes to it gets
a bounce and you never hear from them. Either create it (cPanel → *Email
Accounts*) or change `$contact_email` to an address you do control.

## 5. Check it worked

Visit these and confirm each returns the page, not a 404 or a raw file listing:

- `/` and `/home` — home page
- `/about`, `/how-it-works`, `/taxi`, `/contact`, `/mission`, `/safety`, `/team`

Also check `/welcome` redirects to `/team` — that page moved, and the old
address is kept as a 301 so links already shared still work.

Then confirm the clean-URL redirect: visiting `/about.php` should bounce you to
`/about`. If it does **not**, `.htaccess` did not upload, or `mod_rewrite` is
off — ask your host to enable it.

Finally, confirm `https://yourdomain.com/storage/bookings.log` returns
**403 Forbidden**. That file holds customer names, phone numbers and addresses,
and `storage/.htaccess` exists to block it. If it downloads instead, stop and
fix it before taking bookings.

---

## 6. HTTPS

cPanel → **SSL/TLS Status** → run *AutoSSL* to issue a free certificate.
Once the padlock works, force HTTPS by adding this at the **top** of
`.htaccess`, immediately after `RewriteEngine On`:

```apache
RewriteCond %{HTTPS} off
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
```

Do this only *after* the certificate is active, or the site will redirect to a
URL that does not yet serve.

---

## Notes

### What the package contains

Everything the website is: all 11 PHP pages, `includes/`, the complete
`assets/` tree (385 files — CSS, JS, fonts, vendor libraries, every image),
`images/`, `storage/` with its protective `.htaccess`, the root `.htaccess`,
`.well-known/` (so Let's Encrypt renewal keeps working), and `router.php` so
the same folder still runs locally with `php -S localhost:8000 router.php`.
Apache ignores `router.php` — it reads `.htaccess` directly.

### About `Car Transiport/`

The purchased CityRide template ships with the package at your request — 383
files of HTML, images, CSS and JavaScript. It was scanned first: no PHP and
nothing credential-shaped, so nothing in it executes on the server.

One thing to know: it contains **61 demo `.html` pages** that will be publicly
reachable once uploaded (for example
`yourdomain.com/Car%20Transiport/index.html`), and Google can index them as
pages of your site. If you want the folder stored on the server but not
browsable, add this to `.htaccess`:

```apache
<IfModule mod_authz_core.c>
    <Directory "Car Transiport">
        Require all denied
    </Directory>
</IfModule>
```

Or, more simply, delete the folder from `public_html` in File Manager once you
have the copy you wanted — nothing on the live site links to it.

### What is deliberately left out

Your project folder also holds material that is **not** part of the SafeLine
website and must not go on a public server:

- **`demo.sangotaxi.com/` and `mis.sangotaxi.com/`** — 6,179 files, 513 MB of
  downloaded copies of a different site. Inside them are 38 files holding live
  database passwords, SMTP credentials and Firebase push keys, and 476
  photographs of real drivers and customers. Putting those in `public_html`
  publishes someone else's passwords and someone else's faces to anyone who
  guesses the path. SafeLine reaches the dispatch API over HTTPS at
  `mis.sangotaxi.com` at runtime — it never reads this local copy, so leaving
  it out changes nothing about how the site behaves.
- **`_dev-backups/`** — `.bak` copies of superseded versions of pages.
- **`.idea/`, `.junie/`, `.claude/`** — local editor and tool configuration.
- After changing any CSS or JS, bump `$asset_version` in `includes/config.php`.
  It is appended to every stylesheet and script URL, so raising it forces
  visitors' browsers to fetch the new file instead of a cached one.
