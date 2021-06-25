<?php

namespace Fenek;

class Request {

  static $params = [];

  function getMethod() {
    return $_SERVER['REQUEST_METHOD'];
  }

  function getQueryParam($key) {
    if(isset($_GET[$key])) {
      return $_GET[$key];
    } else {
      return null; 
    }
  }

  function getParam($key) {
    if(isset(Request::$params[$key])) {
      return Request::$params[$key];
    } else {
      return null;
    }
  }

  function getPath() {
    return $_SERVER['REQUEST_URI'];
  }

  static function setParams($params) {
    Request::$params = $params;
  }
}

?>