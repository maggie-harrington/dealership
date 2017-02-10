<?php

    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    session_start();
    if (empty($_SESSION['cars'])) {
        $_SESSION['cars'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app ['debug'] = true;


    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    $app->get("/search_results", function() use($app){
        $cars_matching_search = array();
        foreach ($_SESSION['cars'] as $car) {
            if ($car->worthBuying($_GET['price'], $_GET['mileage'])) {
                array_push($cars_matching_search, $car);
            }
        }
        return $app['twig']->render('search_results.html.twig', array('search_result' => $cars_matching_search));
    });

    $app->post("/confirmation", function() use($app) {
        $car = new Car($_POST['make_model'], $_POST['price'], $_POST['mileage'], $_POST['doors']);
        $car->save();

        return $app['twig']->render('confirmation.html.twig', array('newcar' => $car));
    });

    $app->get("/view_all_cars", function() use ($app) {
        return $app['twig']->render('view_all_cars.html.twig', array('cars' => Car::getAll()));
    });


return $app;

?>
