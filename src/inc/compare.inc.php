<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "src/classes/booking.class.php";
    session_start();

    $hotels = file_get_contents('hotel.json');
    $hotels = json_decode($hotels);

    if(isset($_GET['hotel'])){
      $data = $_GET;
      $hotel_id = htmlentities($_GET['hotel']);
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


  <main class="compare-main">
    <div class="grid-compare">


        <?php foreach($hotels as $key => $hotel): ?>
          <div class="grid-item-compare">
              <section class="card-display">
                <div class="card">
                    <img src="<?php echo $hotel->image ?>" alt="<?php echo $hotel->name ?>" style="width:100%">
                    <div class="container">
                      <div class="content">
                        <h4><b><?php echo $hotel->name ?></b></h4>
                        <p>Description : <?php echo $hotel->description ?></p>
                        <p>Location : <?php echo $hotel->location ?></p>
                        <p>Price : <?php echo $hotel->price ?></p>

                        <?php
                          $bookingObject = new Booking($data['start'],$data['end'],$hotel->price);
                          $duration = $bookingObject->calculateStayDuration();
                          $stay_cost = $bookingObject->calculateStayCost();
                        ?>

                        <p>Your duration : <?php echo $duration ?> days</p>
                        <p>Your cost: <?php echo $stay_cost ?></p>
                      </div>
                      <div class="compare-cta" >
                      <form action="booking.php" method="post" style="background-color: white" >
                        <input type="hidden" name="start" value="<?php echo $data['start'] ?>" />
                        <input type="hidden" name="end" value="<?php echo $data['end'] ?>" />
                        <input type="hidden" name="hotel" value="<?php echo $key ?>" />
                        <input type="hidden" name="duration" value="<?php echo $duration ?>" />
                        <input type="hidden" name="cost" value="<?php echo $stay_cost ?>" />
                        <div class="button-compare">
                        <button type="submit" class="btn btn-primary" name="createBooking" style="text-align: center;">Book</button>
                        </div>
                      </form>
                    </div>
                    </div>
                  </div>
              </section>
          </div>
          <?php endforeach; ?>
      </div>

      </div>
    </main>
  </body>
</html>
