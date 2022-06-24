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

      $bookingObject = new Booking($data['start'],$data['end'],$default_hotel->price);
      $duration = $bookingObject->calculateStayDuration();
      $stay_cost = $bookingObject->calculateStayCost();


      if($duration < 3){
        header('location: index.php?error=1');
        exit();
      }
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


  </head>
  <body>


  <main>
            <section class="card-display">
                <div class="card-booking">

                    <div class="container">
                      <h4><b>Booking</b></h4>
                      <p>Your booking : <?php echo $default_hotel->name ?></p>
                      <p>Start : <?php echo $data['start'] ?></p>
                      <p>End : <?php echo $data['end'] ?></p>
                      <p>Duration : <?php echo $duration ?> days</p>
                      <p>Cost : <?php echo $stay_cost ?></p>

                      <form action="booking-submit.php" method="post" style="background-color: white" >
                        <input type="hidden" name="start" value="<?php echo $data['start'] ?>" />
                        <input type="hidden" name="end" value="<?php echo $data['end'] ?>" />
                        <input type="hidden" name="hotel" value="<?php echo $data['hotel'] ?>" />
                        <input type="hidden" name="duration" value="<?php echo $duration ?>" />
                        <input type="hidden" name="cost" value="<?php echo $stay_cost ?>" />

                        <label>First name : <input type="text" name="first_name" required /></label><br>
                        <label>Surname : <input type="text" name="surname" required /></label><br>
                        <label>Email : <input type="email" name="email" required /></label><br>
                        <br>
                        <button type="submit" class="btn btn-primary" name="createBooking">Book</button>
                      </form>
                    </div>
                  </div>
              </section>

      </div>
      
    </main>
  </body>
</html>
