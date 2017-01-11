<?php

class User {

    private $id;
    private $name;
    private $surname;
    private $country;
    private $city;
    private $postalCode;
    private $street;
    private $houseNo;
    private $apartmentNo;
    private $email;
    private $hashedPassword;

    public function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->surname = '';
        $this->country = '';
        $this->city = '';
        $this->postalCode = '';
        $this->street = '';
        $this->houseNo = '';
        $this->apartmentNo = '';
        $this->email = '';
        $this->hashedPassword = '';
    }

    
    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
        return $this;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function getCity() {
        return $this->city;
    }
    
    public function setPostalCode($postalCode){
        $this->postalCode = $postalCode;
        return $this;
    }
    
    public function getPostalCode(){
        return $this->postalCode;
    }
    
    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }
    
    public function getStreet(){
        return $this->street;
    }
    
    public function setHouseNo($houseNo){
        $this->houseNo = $houseNo;
        return $this;
    }
    
    public function getHouseNo(){
        return $this->houseNo;
    }
    
    public function setApartmentNo($apartmentNo){
        $this->apartmentNo = $apartmentNo;
        return $this;
    }
    
    public function getApartmentNo(){
        return $this->apartmentNo;
    }
    
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setHashedPassword($password) {
        $newHashedPass = password_hash($password, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPass;
        return $this;
    }
    
    public function getHashedPassword(){
        return $this->hashedPassword;
    }

}
