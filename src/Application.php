<?php

namespace Framework;

use ReflectionFunction;

class Application {
  
  private $routes = [
    'GET' => [],
    'POST' => [],
    'PUT' => [],
    'DELETE' => []
  ];

  private $factories = [];

  function run() {
    if(isset($this->routes[$_SERVER['REQUEST_METHOD']][$_SERVER['REQUEST_URI']])) {

      $reflection = new ReflectionFunction($this->routes[$_SERVER['REQUEST_METHOD']][$_SERVER['REQUEST_URI']]);

      $parameters = array_map(function($paramReflection) {
        $type = $paramReflection->getType()->getName();
        if(isset($this->factories[$type])) {
          return $this->factories[$type]();
        }
        return new $type();
      }, $reflection->getParameters());

      $response = $reflection->invoke(...$parameters);

      foreach($response->getHeaders() as $header) {
        header($header);
      }

      echo $response->getContent();
    }
  }

  function factory($key, $factoryMethod) {
    $this->factories[$key] = $factoryMethod;
  }

  function get($path, $handler) {
    $this->routes['GET'][$path] = $handler;
  }

  function post($path, $handler) {
    $this->routes['POST'][$path] = $handler;
  }

  function put($path, $handler) {
    $this->routes['PUT'][$path] = $handler;
  }

  function delete($path, $handler) {
    $this->routes['DELETE'][$path] = $handler;
  }
}

?>