<?php

class DifferentPasswordsException extends Exception {
    public function __construct($message = "Passwords do not match!", $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}