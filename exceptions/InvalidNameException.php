<?php

class InvalidNameException extends Exception {
    public function __construct($message = "Name must have between 3 and 20 alphanumeric characters!", $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

