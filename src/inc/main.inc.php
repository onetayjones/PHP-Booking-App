<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "src/classes/booking.class.php";
    session_start();

    if ( !isset($_SESSION['bookings']) ) {
        $_SESSION['bookings'] = [];
    }

    $hotels = file_get_contents('hotel.json');
    $hotels = json_decode($hotels);

    // echo "<pre>";
    // print_r($hotels);
    // exit();

    $default_hotel = $hotels[0];

    if(isset($_GET['id'])){
      $hotel_id = htmlentities($_GET['id']);
      $default_hotel = $hotels[$hotel_id];
    }

    if(isset($_GET['error'])){
      echo "<script>
      alert('Error, duration of stay must be longer than 1 night/day');
  </script>
  ";
    }

?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking App</title>
    <link rel="stylesheet" href="src/css/stylesheet.css">


  </head>
  <body>

    <main>
      <div class="grid">
        <div class="grid-item">


      <section class="form-section">
        <form action="compare.php" method="get">
          <fieldset>
          <legend>Hotel Reservations</legend>

            <div class="form-group">
              <label for="select-hotel">Select Hotel:</label>
              <select  id="hotel" name="hotel" onchange="if (this.value) window.location.href = 'index.php?id=' + this.value">
                <?php foreach($hotels as $key => $hotel): ?>
                  <option value="<?php echo $key ?>" <?php echo (isset($_GET['id']) && $_GET['id'] == $key) ? ' selected' : '' ?> ><?php echo $hotel->name ?></option>
                <?php endforeach; ?>
              </select>
            <div class="form-group">
                <label for="start">Check-in: </label>
                <input type="date" min="2022-06-08" name="start" id="start" required>
            </div>
            <div class="form-group">
                <label for="end">Check-out: </label>
                <input type="date" name="end" id="end" required  onchange="handler(event);">
            </div>
            <div class="button">
            <button type="submit" class="btn btn-primary" name="createBooking">Book</button>
            </div>
                      </div>
            </fieldset>
        </form>
          </section>
          </div>


          <div class="grid-item grid-item-form">
              <section class="card-display">
                <div class="card">
                    <img src="<?php echo $default_hotel->image ?>" alt="<?php echo $default_hotel->name ?>" style="width:100%">
                    <div class="container">
                      <h4><b><?php echo $default_hotel->name ?></b></h4>
                      <p>Description : <?php echo $default_hotel->description ?></p>
                      <p>Location : <?php echo $default_hotel->location ?></p>
                      <p>Price : <?php echo $default_hotel->price ?></p>
                    </div>
                  </div>
              </section>
          </div>
      </div>
    </main>




  </body>
</html>
