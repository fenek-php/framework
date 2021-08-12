<?php

namespace Fenek;

class Response {
  private $content = '';

  private $code = 200;

  private $headers = [
    'Content-Type: text/html'
  ];

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

  function body($content) {
    $this->content = $content;

    return $this;
  }

  function file($path) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($path).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path));
    flush(); // Flush system output buffer
    readfile($path);
    die();
  }
}

?>