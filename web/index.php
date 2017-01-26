<?php

require('../vendor/autoload.php');
use Bigcommerce\Api\Client as Bigcommerce;

/*
$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});


$app->run();
*/


echo 'greetings planetoit<br>' . _isCurl();;

function _isCurl(){
    return function_exists('curl_version');
}

Bigcommerce::configure(array(
    'store_url' => 'https://store-yiaomofyl1.mybigcommerce.com',
    'username'  => 'n8thanael',
    'api_key'   => '27829dd700728b0e723d457bb1eca1d25e11bac4'
));

/*
Bigcommerce::configure(array(
    'client_id' => '991f5nw2mjoukseygibqn5idsl9haqd',
    'auth_token' => '63x7yadlpx20svh9543xaeqhtjc0j7s',
    'store_hash' => 'yiaomofyl1'
));
*/

Bigcommerce::verifyPeer(false);

$ping = Bigcommerce::getTime();

if(!$ping){
	$error = Bigcommerce::getLastError();
	echo '<pre>';
	print_r($error);
	echo '</pre>';
} else {
	echo $ping->format('H:i:s');	
}

$products = Bigcommerce::getProducts();

foreach ($products as $product){
	echo $product->id . " - ";	
	echo $product->name . " $";
	echo $product->price . "<br>";
}

$product = Bigcommerce::getProduct(80);

echo $product->name;
echo $product->price;

$count = Bigcommerce::getProductsCount();
echo "<p>" . $count . "</p>";
