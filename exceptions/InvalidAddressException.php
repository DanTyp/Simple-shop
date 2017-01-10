<?php

class InvalidAddressException extends Exception {
    public function __construct($message = "Please enter a valid address!", $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
