<?php
class Car
{
    private $make_model;
    public $price;
    public $miles;
    public $doors;

    function __construct($car_make_model, $car_price, $car_miles, $car_doors)
    {
        $this->make_model = $car_make_model;
        $this->price = $car_price;
        $this->miles = $car_miles;
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

}

$car1 = new Car("2014 Porsche 911", 114991, 7864, 4);
$car2 = new Car("2011 Ford F450", 55995, 14241, 4);
$car3 = new Car("2013 Lexus RX 350", 44700, 20000, 4);
$car4 = new Car("Mercedes Benz CLS550", 39900, 37979, 2);

$cars = array($car1, $car2, $car3, $car4);

$cars_matching_search = array();

foreach ($cars as $car) {
    $car_price = $car->getPrice();
    if ($car->price < $_GET["price"]) {
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
                    echo "<li> $current_make_model </li>";
                    echo "<ul>";
                        echo "<li> $$current_price </li>";
                        echo "<li> Miles: $current_miles </li>";
                        echo "<li> Doors: $current_doors </li>";
                    echo "</ul>";
                }
            ?>
        </ul>

    </body>
</html>
