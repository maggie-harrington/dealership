<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";


    $app = new Silex\Application();

    $app->get("/", function() {
        return "
        <!DOCTYPE html>
        <html>
          <head>
             <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Find a Car</title>
          </head>
          <body>
            <div class='container'>
              <h1>Find a Car</h1>
              <form action='/view_car'>
                <div>
                  <label for='price'>Enter Maximum Price:</label>
                  <input id='price' name='price' class='form-control' type='number'>
                </div>
                <div>
                  <label for='mileage'>Enter Maximum Mileage:</label>
                  <input id='mileage' name='mileage' class='form-control' type='number'>
                </div>
                <button type='submit' class='btn-success'>Submit</button>
              </form>
            </div>
          </body>
        </html>
";
    });

$app->get("/view_car", function() {
    $car1 = new Car("2014 Porsche 911", 114991, 7864, "image/Porsche.jpg");
    $car2 = new Car("2011 Ford F450", 55995, 14241, "image/Ford.jpg");
    $car3 = new Car("2013 Lexus RX 350", 44700, 20000, "image/Lexus.jpg");
    $car4 = new Car("Mercedes Benz CLS550", 39900, 37979, "image/Porsche.jpg", 2);

    $cars = array($car1, $car2, $car3, $car4);


        //$my_car = new Car($_GET['price'], $_GET['mileage']);
        //$worth_buying = $my_car->worthBuying();




    $cars_matching_search = array();

    foreach ($cars as $car) {
        if ($car->worthBuying($_GET['price'], $_GET['mileage'])) {
            array_push($cars_matching_search, $car);
        }
    }




    $top_of_page = "<!DOCTYPE html>
    <html>
        <head>

            <title>Your Car Dealership\'s Homepage</title>
        </head>
        <body>
            <h1>Your Car Dealership</h1>
            <ul>";



                $output = "";
                if (empty($cars_matching_search)) {
                    return 'No cars match your search!';
                } else {
                    foreach ($cars_matching_search as $car) {
                        $current_make_model = $car->getMakeModel();
                        $current_price = $car->getPrice();
                        $current_miles = $car->getMiles();
                        $current_doors = $car->getDoors();
                        $current_image = $car->getImage();

                        $output = $output .

                        "<li> $current_make_model </li>
                        <ul>
                            <li> $$current_price </li>
                            <li> Miles: $current_miles </li>
                            <li> Doors: $current_doors </li>
                            <li><img src=$current_image></li>
                        </ul>";
                        }
                    }





    $bottom_of_page = "</ul>

        </body>
    </html>";

    return $top_of_page . $output . $bottom_of_page;

});
return $app;

?>
