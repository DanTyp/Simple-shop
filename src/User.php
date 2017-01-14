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
    private $deleteStatus;

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
        $this->deleteStatus = 0;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
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

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    public function getStreet() {
        return $this->street;
    }

    public function setHouseNo($houseNo) {
        $this->houseNo = $houseNo;
        return $this;
    }

    public function getHouseNo() {
        return $this->houseNo;
    }

    public function setApartmentNo($apartmentNo) {
        $this->apartmentNo = $apartmentNo;
        return $this;
    }

    public function getApartmentNo() {
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

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function setDeleteStatus($int) {
        $this->deleteStatus = $int;
        return $this;
    }

    public function getDeleteStatus() {
        return $this->deleteStatus;
    }

    public function saveUserToDB(mysqli $connection) {
        if ($this->id == -1) {
            $query = "INSERT INTO User(name, surname, country, city, postalCode, street, houseNo, apartmentNo, email, hashedPassword, deleteStatus)"
                    . "Values ('$this->name', '$this->surname', '$this->country', '$this->city', '$this->postalCode', '$this->street',"
                    . "'$this->houseNo', '$this->apartmentNo', '$this->email', '$this->hashedPassword', '$this->deleteStatus')";

            $result = $connection->query($query);
            if ($result == true) {
                $this->id = $connection->insert_id;
                echo 'User saved to DB!';
                return true;
            } else {
                echo 'Saving failure!';
                return false;
            }
        } else {

            $query = "UPDATE User SET name = '$this->name', "
                    . "surname  ='$this->surname', "
                    . "country = '$this->country', "
                    . "city = '$this->city', "
                    . "postalCode = '$this->postalCode', "
                    . "street = '$this->street', "
                    . "houseNo = '$this->houseNo', "
                    . "apartmentNo = '$this->apartmentNo', "
                    . "email = '$this->email', "
                    . "hashedPassword = '$this->hashedPassword', "
                    . "deleteStatus = '$this->deleteStatus' "
                    . "WHERE id = $this->id";

            $result = $connection->query($query);

            if ($result == true) {
                echo 'Update of User succesful';
                return true;
            } else {
                echo 'Update failure';
                return false;
            }
        }
    }

    static public function loadUserById(mysqli $connection, $id) {
        $query = "SELECT * FROM User WHERE id=$id";
        $result = $connection->query($query); //zapytanie select zwróci obiekt
        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->surname = $row['surname'];
            $loadedUser->country = $row['country'];
            $loadedUser->city = $row['city'];
            $loadedUser->postalCode = $row['postalCode'];
            $loadedUser->street = $row['street'];
            $loadedUser->houseNo = $row['houseNo'];
            $loadedUser->apartmentNo = $row['apartmentNo'];
            $loadedUser->email = $row['email'];
            $loadedUser->hashedPassword = $row['hashedPassword'];
            $loadedUser->deleteStatus = $row['deleteStatus'];

            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(mysqli $connection) {
        $query = "SELECT * FROM User";
        $ret = [];

        $result = $connection->query($query);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->name = $row['name'];
                $loadedUser->surname = $row['surname'];
                $loadedUser->country = $row['country'];
                $loadedUser->city = $row['city'];
                $loadedUser->postalCode = $row['postalCode'];
                $loadedUser->street = $row['street'];
                $loadedUser->houseNo = $row['houseNo'];
                $loadedUser->apartmentNo = $row['apartmentNo'];
                $loadedUser->email = $row['email'];
                $loadedUser->hashedPassword = $row['hashedPassword'];
                $loadedUser->deleteStatus = $row['deleteStatus'];

                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    static public function loadUserByEmail(mysqli $connection, $email) {
        $query = "SELECT * FROM User WHERE email='$email'";
        $result = $connection->query($query);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->surname = $row['surname'];
            $loadedUser->country = $row['country'];
            $loadedUser->city = $row['city'];
            $loadedUser->postalCode = $row['postalCode'];
            $loadedUser->street = $row['street'];
            $loadedUser->houseNo = $row['houseNo'];
            $loadedUser->apartmentNo = $row['apartmentNo'];
            $loadedUser->email = $row['email'];
            $loadedUser->hashedPassword = $row['hashedPassword'];
            $loadedUser->deleteStatus = $row['deleteStatus'];

            return $loadedUser;
        }
        return null;
    }

    public function deleteUser(mysqli $connection) {
        if ($this->id != -1) {
            $query = "DELETE FROM User WHERE id=$this->id";
            $result = $connection->query($query);
            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
    
    static public function verifyEmailsAvailability(mysqli $connection, $email) {
        $query = "SELECT * FROM User WHERE email='$email'";
        $result = $connection->query($query);
        
        if ($result == true && $result->num_rows == 0){
            return true;
        } else{
            return false;
        }
    }

    static public function verifyEmailAndPassword(mysqli $connection, $email, $password) {
        $query = "SELECT * FROM User WHERE email='$email'";
        $result = $connection->query($query);
        
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['hashedPassword'])){
                return $row['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



}
