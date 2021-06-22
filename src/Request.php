<?php

namespace Framework;

class Request {

  static $params = [];

  function getMethod() {
    return $_SERVER['REQUEST_METHOD'];
  }

  function getParam($key) {
    if(isset(Request::$params[$key])) {
      return Request::$params[$key];
    } else {
      return null;
    }
  }

  static function setParams($params) {
    Request::$params = $params;
  }
}

?>