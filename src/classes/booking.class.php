<?php

class Booking {

// ========== Members / Fields / Instance Variables ===========


    public $startDate;
    public $endDate;
    public $rate;

// ========== Constructor ===========

    public function __construct($startInput, $endInput, $rateInput)
    {

        $this->startDate = $startInput;
        $this->endDate = $endInput;
        $this->rate = $rateInput;
    }

// ========== User Defined Methods ===========

    # returns number representing length of s
    public function calculateStayDuration() {

        // Calculating the difference in timestamps
        $diff = strtotime($this->endDate) - strtotime($this->startDate);

        // 24 * 60 * 60 = 86400 seconds
        return abs(round($diff / 86400));
    }

    # returns full cost of stay - OF
    public function calculateStayCost() {

        $numDays = $this->calculateStayDuration();

        $amount = $this->rate * $numDays;

        return $amount;
    }

    # Static public method which calls the private constructor and allows you to create
    # a new object of type Booking if the$ startDate is smaller than the $endDate;
    public static function createBooking($startInput, $endInput, $rateInput) {

        if ($startInput >= $endInput) {
            echo "
            <script>
                alert('Error, duration of stay must be longer than 1 night/day');
            </script>
            ";

        } else {

            $newBooking = new Booking($startInput, $endInput, $rateInput);
            echo "
                <script>
                    alert('New Booking object created! - ID: ' + $newBooking->id);
                </script>
            ";
            return $newBooking;
        }
    }

}
