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
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setHashedPassword($password) {
        $newHashedPass = password_hash($password, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPass;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }
    
    public function saveAdminToDB(mysqli $connection) {
        if ($this->id == -1) {
            $query = "INSERT INTO Admin(email, hashedPassword)"
                    . "Values ('$this->email', '$this->hashedPassword')";

            $result = $connection->query($query);
            if ($result == true) {
                $this->id = $connection->insert_id;
                echo 'Admin saved to DB!';
                return true;
            } else {
                echo 'Saving failure!';
                return false;
            }
        } else {

            $query = "UPDATE Admin SET email = '$this->email', "
                    . "hashedPassword = '$this->hashedPassword'"
                    . "WHERE id = $this->id";

            $result = $connection->query($query);

            if ($result == true) {
                echo 'Update of Admin succesful';
                return true;
            } else {
                echo 'Update failure';
                return false;
            }
        }
    }
    
    static public function verifyEmailsAvailability(mysqli $connection, $email) {
        $query = "SELECT * FROM Admin WHERE email='$email'";
        $result = $connection->query($query);
        
        if ($result == true && $result->num_rows == 0){
            return true;
        } else{
            return false;
        }
    }

    static public function verifyEmailAndPassword(mysqli $connection, $email, $password) {
        $query = "SELECT * FROM Admin WHERE email='$email'";
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

