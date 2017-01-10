<?php

class Category {

    private $id;
    private $categoryName;
    private $description;

    public function __construct() {
        $this->id = -1;
        $this->categoryName = '';
        $this->description = '';
    }

    public function setCategoryName($categoryName) {
        if (is_string($categoryName)) {
           $this->categoryName = $categoryName; 
        }
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }

    public function getDescription() {
        return $this->description;
    }

    /*
     * Saving a new category to DB
     */

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Category (categoryName, description)
                  VALUES ('$this->categoryName', '$this->description')";
            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE Category SET categoryName = $this->categoryName, description = $this->description
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
            $sql = "DELETE FROM Category WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1; //usunelismy obiekt z bazy
                return true;
            }
            return false;
        }
        return true;
    }

    static public function loadCategoryById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Category WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedCategory = new Category();
            $loadedCategory->id = $row['id'];
            $loadedCategory->categoryName = $row['categoryName'];
            $loadedCategory->description = $row['description'];
            return $loadedCategory;
        }

        return null;
    }
    
    static public function loadAllCategory(mysqli $connection) {
        $sql = "SELECT * FROM Category ORDER BY categoryName ASC";
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedCategory = new Category();
                $loadedCategory->id = $row['id'];
                $loadedCategory->categoryName = $row['categoryName'];
                $loadedCategory->description = $row['description'];
                $ret[] = $loadedCategory;
            }
        }
        return $ret;
    }

}
