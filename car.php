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

    function setDoors($new_doors)
    {
        $this->doors = $new_doors;
    }

    function setImage($new_image)
    {
        $this->image_path = $new_image;
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

    function getDoors()
    {
        return $this->doors;
    }

    function getImage()
    {
        return $this->image_path;
    }

    function worthBuying ($max_price)
    {
        return $this->price < $max_price;
    }
}

$car1 = new Car("2014 Porsche 911", 114991, 7864, "image/Porsche.jpg");
$car2 = new Car("2011 Ford F450", 55995, 14241, "image/Ford.jpg");
$car3 = new Car("2013 Lexus RX 350", 44700, 20000, "image/Lexus.jpg");
$car4 = new Car("Mercedes Benz CLS550", 39900, 37979, "image/Porsche.jpg", 2);

$cars = array($car1, $car2, $car3, $car4);

$cars_matching_search = array();

foreach ($cars as $car) {
    if ($car->worthBuying($_GET['price'])) {
        array_push($cars_matching_search, $car);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Your Car Dealership's Homepage</title>
    </head>
    <body>
        <h1>Your Car Dealership</h1>
        <ul>
            <?php
                foreach ($cars_matching_search as $car) {
                    $current_make_model = $car->getMakeModel();
                    $current_price = $car->getPrice();
                    $current_miles = $car->getMiles();
                    $current_doors = $car->getDoors();
                    $current_image = $car->getImage();
                    echo "<li> $current_make_model </li>";
                    echo "<ul>";
                        echo "<li> $$current_price </li>";
                        echo "<li> Miles: $current_miles </li>";
                        echo "<li> Doors: $current_doors </li>";
                        echo "<li><img src='$current_image'></li>";
                    echo "</ul>";
                }
            ?>
        </ul>

    </body>
</html>
