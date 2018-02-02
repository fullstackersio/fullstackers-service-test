<?php

require 'vendor/autoload.php';
// require 'predis/autoload.php'; // predis

// Create a new Slim application
$app = new \Slim\App;

// Define your first route
$app->get('/{id}', function ($request, $response, $args)
{
    // return $response->write("Welcome to the homepage, " . $args['name'] . "!");
   $data = array('userid' => $args['id']);
   $newResponse = $response->withJson($data);
   return $newResponse;
});


// Define route for ads
$app->get('/resources/{id}', function ($request, $response, $args)
{
    // return $response->write("Ad for user: " . $args['id']);

    $data = array('userid' => $args['id'], 'resources' => 'Various URLs....');
    $newResponse = $response->withJson($data);
    return $newResponse;

});


// Define route for ads

$app->get('/redis/{id}', function ($request, $response, $args)
{
    // return $response->write("Ad for user: " . $args['id']);

   PredisAutoloader::register();
   $redis = new PredisClient();
   $redis->set('message');
   return $response->write($redis);
    /*
    try {

        $redis = new PredisClient(array(
        "scheme" => "tcp",
        "host" => "172.30.0.13",
        "port" => 6379));

        $data = array('userid' => $args['id'], 'ad' => 'REDIS');

    }
        catch (Exception $e) {
            $data = array('userid' => 'CRAP', 'ad' => 'ERROR');
        }
    }
    */
    // $data = array('userid' => $args['id'], 'ad' => 'PLURALSIGHT');
    $newResponse = $response->withJson($data);
    return $newResponse;

});



// Run the application
$app->run();
