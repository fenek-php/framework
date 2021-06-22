<?php

include(__DIR__ . '/../vendor/autoload.php');

use Framework\Application;
use Framework\Response;
use Framework\Request;

$app = new Application();

$app->get('/test/:paramName/testowo', function(Request $request, Response $response) {
  return $response
    ->json([
      'test' => $request->getParam('paramName')
    ]);
});


$app->get('/', function(Response $response) {
  return $response
    ->json([
      'test' => 'TEST'
    ]);
});

$app->run();

?>