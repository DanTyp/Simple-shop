<?php

class InvalidPasswordException extends Exception {
    public function __construct($message = "Password must have between 8 and 20 characters!", $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}