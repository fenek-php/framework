<?php

namespace Fenek\Exceptions;

class NotFoundException extends \Exception {
  function __construct() {
    parent::__construct("NOT_FOUND", 404);
  }
}

?>