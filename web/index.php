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
    // Here I defined a new twig path to point to my project folder which has it's own views // inside - twig.path is a property of the TwigServiceProvider() class
    // 'twig.path' => __DIR__.'/../nataleyffl/app/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

/*
// this will respond with a static twig page within Nataleyffl/app/views/{twig_page}
*/
$app->get('/twigdisplay/{twig_page}', function($twig_page) use($app) {
  $twigdisplay = new twigdisplay;
  return $app['twig']->render($twigdisplay->display($twig_page));  
});



$app->get('/api/', function() use ($app) {
    $app['monolog']->addDebug('logging output.');
    $bc_api_test = new bc_api_test;
    return $bc_api_test->test();
});

$app->get('/bootloader/', function() use ($app){
    $nataleyffl = new nataleyffl\bootloader;
    return $nataleyffl->returnSomeString();
});

$app->get('/functiontest/', function() use ($app){
	return sayHello();
});

$app->get('/helloworld/', function() use ($app){
	return new \Symfony\Component\HttpFoundation\Response("this is a hello world for 'yall.");
});


$app->run();




