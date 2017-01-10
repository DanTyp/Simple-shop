<?php

class Admin {

    private $id;
    private $email;
    private $hashedPassword;
    

    public function __construct() {
        $this->id = -1;
        $this->email = '';
        $this->hashedPassword = '';
        
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setHashedPassword($pass) {
        $newHashedPass = password_hash($pass, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPass;
    }

    
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    
}
    