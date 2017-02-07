<?php

require('../vendor/autoload.php');

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

$app->get('/web/', function() use ($app) {
	return 'hello, you\'e at web!';
});


$app->get('/api/', function() use ($app) {
    $app['monolog']->addDebug('logging output.');
    $bc_api_test = new bc_api_test;
    return $bc_api_test->test();


    // return 'howdie';
});

$app->get('/bootloader/', function() use ($app){
    $nataleyffl = new nataleyffl\bootloader;
    return $nataleyffl->returnSomeString();
});

$app->get('/functiontest/', function() use ($app){
	return sayHello();
});


$app->run();




