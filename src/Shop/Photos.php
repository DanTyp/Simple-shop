<?php

class Photos {

    private $id;
    private $path;
    private $productId;

    public function __construct() {
        $this->id = -1;
        $this->path = '';
        $this->productId = 0;
    }

    public function setPath($path) {
        if (is_string($path)) {
           $this->path = $path; 
        }
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function getId() {
        return $this->id;
    }

    public function getPath() {
        return $this->path;
    }

    public function getProductId() {
        return $this->productId;
    }

    /*
     * Saving a new photos to DB
     */

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Photos (path, productId)
                  VALUES ('$this->path', '$this->productId')";
            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE Photos SET path = $this->path, productId = $this->productId
                    WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    /*
     * Deleting a category
     */

    public function delete(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Photos WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1; //usunelismy obiekt z bazy
                return true;
            }
            return false;
        }
        return true;
    }

    static public function loadPhotosById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Photos WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedPhoto = new Photos();
            $loadedPhoto->id = $row['id'];
            $loadedPhoto->path = $row['path'];
            $loadedPhoto->productId = $row['productId'];
            return $loadedPhoto;
        }

        return null;
    }
    
    static public function loadAllCategory(mysqli $connection) {
        $sql = "SELECT * FROM Photos";
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedPhoto = new Photos();
                $loadedPhoto->id = $row['id'];
                $loadedPhoto->path = $row['path'];
                $loadedPhoto->productId = $row['productId'];
                $ret[] = $loadedPhoto;
            }
        }
        return $ret;
    }

}
