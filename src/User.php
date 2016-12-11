<?php

class User {

    private $id;
    private $name;
    private $surname;
    private $hashedPassword;
    private $email;

    public function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->surname = '';
        $this->hashedPassword = '';
        $this->email = '';
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setHashedPassword($pass) {
        $newHashedPass = password_hash($pass, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPass;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getSurname() {
        return $this->surname;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function getEmail() {
        return $this->email;
    }
}
    