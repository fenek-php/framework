<?php

include(__DIR__ . '/../vendor/autoload.php');

use Fenek\Application;
use Fenek\Exceptions\NotFoundException;
use Fenek\Response;
use Fenek\Request;

$app = new Application();

$app->get('/test/:paramName/testowo', function(Request $request, Response $response) {
  return $response
    ->json([
      'test' => $request->getParam('paramName'),
      'query' => $request->getQueryParam('paramName')
    ]);
});

$app->get('/', function(Response $response) {
  return $response
    ->json([
      'test' => 'TEST'
    ]);
});

$app->catch(NotFoundException::class, function(Response $response) {
  return $response->json([
    'error' => 'NOT_FOUND'
  ]);
});

$app->run();

?>