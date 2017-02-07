<?php
    class Car
    {
        private $make_model;
        private $price;
        private $miles;
        private $image_path;
        private $doors;

        function __construct($car_make_model, $car_price, $car_miles, $car_image, $car_doors = 4)
        {
            $this->make_model = $car_make_model;
            $this->price = $car_price;
            $this->miles = $car_miles;
            $this->image_path = $car_image;
            $this->doors = $car_doors;
        }

        function setMakeModel($new_make_model)
        {
            $this->make_model = $new_make_model;
        }

        function setPrice ($new_price)
        {
            $float_price = (float) $new_price;
            if ($float_price != 0) {
                $formatted_price = number_format($float_price, 2);
                $this->price = $formatted_price;
            }
        }

        function setMiles($new_miles)
        {
            $this->miles = $new_miles;
        }

        function setImage($new_image)
        {
            $this->image_path = $new_image;
        }

        function setDoors($new_doors)
        {
            $this->doors = $new_doors;
        }

        function getMakeModel()
        {
            return $this->make_model;
        }

        function getPrice()
        {
            return $this->price;
        }

        function getMiles()
        {
            return $this->miles;
        }

        function getImage()
        {
            return $this->image_path;
        }

        function getDoors()
        {
            return $this->doors;
        }

        function worthBuying ($max_price, $max_mileage)
        {
            return ($this->price < $max_price) && ($this->miles < $max_mileage);
        }
    }
?>
