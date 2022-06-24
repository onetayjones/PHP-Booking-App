<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "src/classes/booking.class.php";
    session_start();

    $hotels = file_get_contents('hotel.json');
    $hotels = json_decode($hotels);

    if(isset($_POST)){
      $data = $_POST;
      $hotel_id = $data['hotel'];
      $default_hotel = $hotels[$hotel_id];

      $message = "
        Thank you for your booking <br>

        First Name : {$data['first_name']} <br>
        Surname : {$data['surname']} <br>
        Email : {$data['email']} <br>
        Hotel : {$default_hotel->name} <br>
        Start Date : {$data['start']} <br>
        End Date : {$data['end']} <br>

        <br><br>
        Regards <br>
      ";

      mail('user@gmail.com','Thank you for your booking', $message);

    }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking App</title>
    <link rel="stylesheet" href="src/css/stylesheet.css">
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
  </head>
  <body>

    <!-- Header -->

    <?php include 'src/inc/header.inc.php'; ?>

    <!-- Main -->
    <?php include 'src/inc/thankyou.inc.php'; ?>

    <!-- Footer -->
    <?php include 'src/inc/footer.inc.php'; ?>
  </body>
</html>
