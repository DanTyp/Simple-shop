<?php

class InvalidEmailException extends Exception {
    public function __construct($message = "Please enter a valid e-mail!", $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}