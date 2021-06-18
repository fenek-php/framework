<?php

namespace Framework;

class Request {
  function getMethod() {
    return $_SERVER['REQUEST_METHOD'];
  }
}

?>