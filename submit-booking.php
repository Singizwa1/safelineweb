<?php

/*
|--------------------------------------------------------------------------
| CityRide ride Booking
|--------------------------------------------------------------------------
| This file receives the booking form and opens Gmail
| with the booking information already prepared.
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ride-booking.html');
    exit;
}


/*
|--------------------------------------------------------------------------
| Helper Function
|--------------------------------------------------------------------------
*/

function clean_input($value)
{
    return trim(strip_tags($value ?? ''));
}


/*
|--------------------------------------------------------------------------
| Receive Form Information
|--------------------------------------------------------------------------
*/

$pickup_location  = clean_input($_POST['pickup_location'] ?? '');
$dropoff_location = clean_input($_POST['dropoff_location'] ?? '');
$passengers       = clean_input($_POST['passengers'] ?? '');
$ride_type        = clean_input($_POST['ride_type'] ?? '');
$pickup_date      = clean_input($_POST['pickup_date'] ?? '');
$driver           = clean_input($_POST['driver'] ?? '');


/*
|--------------------------------------------------------------------------
| Validate Form
|--------------------------------------------------------------------------
*/

if (
    $pickup_location === '' ||
    $dropoff_location === '' ||
    $passengers === '' ||
    $ride_type === '' ||
    $pickup_date === '' ||
    $driver === ''
) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport"
              content="width=device-width, initial-scale=1.0">

        <title>Booking Error | CityRide</title>

        <style>

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 20px;
                min-height: 100vh;

                display: flex;
                align-items: center;
                justify-content: center;

                font-family: Arial, sans-serif;

                background: #f5f6f8;
            }

            .booking-message {
                width: 100%;
                max-width: 550px;

                background: #ffffff;

                padding: 45px 35px;

                text-align: center;

                border-radius: 18px;

                box-shadow:
                    0 15px 45px rgba(0, 0, 0, 0.10);
            }

            .booking-icon {
                width: 70px;
                height: 70px;

                margin: 0 auto 20px;

                display: flex;
                align-items: center;
                justify-content: center;

                border-radius: 50%;

                background: #f8e7e7;

                color: #d9534f;

                font-size: 32px;
            }

            h1 {
                margin: 0 0 15px;

                font-size: 28px;

                color: #222;
            }

            p {
                margin: 0;

                color: #666;

                line-height: 1.7;
            }

            .back-button {
                display: inline-block;

                margin-top: 25px;

                padding: 14px 28px;

                color: #ffffff;

                background: #222;

                text-decoration: none;

                border-radius: 8px;

                font-weight: 600;
            }

            .back-button:hover {
                opacity: 0.9;
            }

        </style>

    </head>

    <body>

        <div class="booking-message">

            <div class="booking-icon">
                !
            </div>

            <h1>
                Booking Information Missing
            </h1>

            <p>
                Please return to the booking form and complete
                all required fields before submitting your ride request.
            </p>

            <a
                href="ride-booking.html"
                class="back-button">

                Return to Booking

            </a>

        </div>

    </body>

    </html>

    <?php

    exit;
}


/*
|--------------------------------------------------------------------------
| Email Recipient
|--------------------------------------------------------------------------
*/

$recipient = 'twagiramunguserge@gmail.com';


/*
|--------------------------------------------------------------------------
| Email Subject
|--------------------------------------------------------------------------
*/

$subject = 'New ride Booking Request';


/*
|--------------------------------------------------------------------------
| Create Email Body
|--------------------------------------------------------------------------
*/

$message  = "NEW ride BOOKING REQUEST\n";
$message .= "========================================\n\n";

$message .= "BOOKING DETAILS\n";
$message .= "----------------------------------------\n\n";

$message .= "Pick Up Location: ";
$message .= $pickup_location;
$message .= "\n\n";

$message .= "Drop Off Location: ";
$message .= $dropoff_location;
$message .= "\n\n";

$message .= "Number of Passengers: ";
$message .= $passengers;
$message .= "\n\n";

$message .= "ride Type: ";
$message .= $ride_type;
$message .= "\n\n";

$message .= "Pick Up Date: ";
$message .= $pickup_date;
$message .= "\n\n";

$message .= "Selected Driver: ";
$message .= $driver;
$message .= "\n\n";

$message .= "========================================\n";

$message .= "This booking request was submitted from the CityRide website.\n";


/*
|--------------------------------------------------------------------------
| Create Gmail Compose URL
|--------------------------------------------------------------------------
|
| Gmail opens a compose window with:
|
| To
| Subject
| Message
|
*/

$gmail_url =
    'https://mail.google.com/mail/?view=cm&fs=1'
    . '&to=' . rawurlencode($recipient)
    . '&su=' . rawurlencode($subject)
    . '&body=' . rawurlencode($message);


/*
|--------------------------------------------------------------------------
| Redirect To Gmail
|--------------------------------------------------------------------------
*/

header('Location: ' . $gmail_url);

exit;

?>
