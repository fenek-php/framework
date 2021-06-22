<?php

namespace Framework;

use Framework\Request;

class Application {
  
  private $routes = [
    'GET' => [],
    'POST' => [],
    'PUT' => [],
    'DELETE' => []
  ];

  private $factories = [];

  function run() {
    foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $path => $route) {
      $pattern = str_replace("/", "\/", preg_replace("/\:([a-z]+)/im", "(?<$1>.+)", $path));
      preg_match("/^" . $pattern . "$/im", $_SERVER['REQUEST_URI'], $matches);

      $uriParams = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);

      Request::setParams($uriParams);

      if(isset($matches[0])) {
        $reflection = new \ReflectionFunction($route);

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
        return;
      }
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