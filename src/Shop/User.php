<?php
require_once __DIR__ . '/../ExceptionClasses/InvalidNameException.php';
require_once __DIR__ . '/../ExceptionClasses/InvalidSurnameException.php';
require_once __DIR__ . '/../ExceptionClasses/InvalidAddressException.php';
require_once __DIR__ . '/../ExceptionClasses/InvalidEmailException.php';
require_once __DIR__ . '/../ExceptionClasses/InvalidPasswordException.php';
require_once __DIR__ . '/../ExceptionClasses/DifferentPasswordsException.php';

class User {

    private $id;
    private $name;
    private $surname;
    private $address;
    private $email;
    private $hashedPassword;

    public function __construct($name = '', $surname = '', $address = '', $email = '', $password = '') {
        $this->id = -1;
        $this->setName($name);
        $this->setSurname($surname);
        $this->setAddress($address);
        $this->setEmail($email);
        $this->setHashedPassword($password);
    }

    public function setName($name) {
        if (is_string($name) && strlen(trim($name)) >= 3 && strlen(trim($name)) <= 20) {
            $this->name = trim($name);
        } else {
            $allIsRight = false;
            throw new InvalidNameException();
        }
    }

    public function setSurname($surname) {
        if (is_string($surname) && strlen(trim($surname)) >= 3 && strlen(trim($surname)) <= 20 && ctype_alnum($surname)) {
            $this->surname = trim($surname);
        } else {
            $allIsRight = false;
            throw new InvalidSurnameException();
        }
    }

    public function setAddress($address) {
        if (is_string($address) && strlen(trim($address)) >= 10) {
            $this->address = trim($address);
        } else {
            $allIsRight = false;
            throw new InvalidAddressException();
        }
    }

    public function setEmail($email) {
        if (is_string($email)) {
            $firstEmail = $email;
            $secondEmail = filter_var($firstEmail, FILTER_SANITIZE_EMAIL);
            if (filter_var($secondEmail, FILTER_VALIDATE_EMAIL) == true && ($secondEmail == $email)) {
                $this->email = $email;
            }
        } else {
            $allIsRight = false;
            throw new InvalidEmailException();
        }
    }
    
    /*

    public function setHashedPassword($password) {

        if (strlen($password) >= 8 && strlen($password) <= 20) {
            $newHashedPass = password_hash($password, PASSWORD_BCRYPT);
            $this->hashedPassword = $newHashedPass;
        } else {
            throw new InvalidPasswordException();
        }
    }

    public function compareTwoPasswords($pass1, $pass2) {
        if ($pass1 === $pass2) {
            return true;
        } else {
            throw new DifferentPasswordsException();
        }
    }
     * 
     */
    
    public function setHashedPassword($password1, $password2) {
        if(is_string($password1) && strlen($password1) >= 8 && strlen($password1) <= 20){
            if($password1 === $password2) {
            $newHashedPass = password_hash($password, PASSWORD_BCRYPT);
            $this->hashedPassword = $newHashedPass;
            } else {
                $allIsRight = false;
                throw new DifferentPasswordsException();
            }
        } else {
            $allIsRight = false;
            throw new InvalidPasswordException();
        }
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

    public function getAddress() {
        return $this->address;
    }

}
