<?php

namespace Fenek;

class Response {
  private $content = '';

  private $code = 200;

  private $headers = [];

  function getContent() {
    return $this->content;
  }

  function getHeaders() {
    return $this->headers;
  }

  function getCode() {
    return $this->code;
  }

  function header($header) {
    $this->headers[] = $header;

    return $this;
  }

  function code($code) {
    $this->code = $code;

    return $this;
  }

  function json($content) {
    $this->header('Content-Type: application/json');
    $this->content = json_encode($content);

    return $this;
  }
}

?>