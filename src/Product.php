<?php

/*
 * Class Product:
 */
class Product {

    private $id;
    private $name;
    private $price;
    private $description;
    private $quantity;
    private $categoryId;
    private $categoryName;
    private $path;

    public function __construct() {
        $this->id = -1;
        $this->name = "";
        $this->price = 0;
        $this->description = "";
        $this->quantity = 0;
        $this->categoryId = "";
    }

    /*
     * Sets and Gets mathods:
     */

    public function setName($name) {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    public function setPrice($price) {
        if (is_numeric($price)) {
            $this->price = $price;
        }
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setQuantity($quantity) {
        if (is_numeric($quantity)) {
            $this->quantity = $quantity;
        }
    }

    public function setCategoryId($categoryId) {
        if (is_numeric($categoryId)) {
            $this->categoryId = $categoryId;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }

    public function getPath() {
        return $this->path;
    }
    /*
     * Saving a new product to DB
     */

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Product (name, price, description, quantity, categoryId)
                  VALUES ('$this->name','$this->price', '$this->description', '$this->quantity', '$this->categoryId')";

            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE Product SET name = $this->name, price = $this->price, description = $this->description, "
                    . "quantity = $this->quantity, categoryId = $this->categoryId
                    WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        var_dump('Product->saveToDB error: ' . $connection->error);
        var_dump('SQL: ' . $sql);
        return false;
    }

    /*
     * Deleting a product
     */

    public function delete(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Product WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1; //usunelismy obiekt z bazy
                return true;
            }
            return false;
        }
        return true;
    }

    static public function loadProductById(mysqli $connection, $id) {

        $sql = "SELECT p.*, c.categoryName, f.path FROM Product as p JOIN Category as c ON (p.categoryId = c.id)"
                . "LEFT JOIN Photos as f on (p.id=f.productId AND f.photoSeq=0) WHERE p.id=$id";
        

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedProduct = new Product();
            $loadedProduct->id = $row['id'];
            $loadedProduct->name = $row['name'];
            $loadedProduct->price = $row['price'];
            $loadedProduct->description = $row['description'];
            $loadedProduct->quantity = $row['quantity'];
            $loadedProduct->categoryId = $row['categoryId'];
            $loadedProduct->categoryName = $row['categoryName'];
            $loadedProduct->path = $row['path'];

            return $loadedProduct;
        }
        var_dump('Product->loadProductById error: ' . $connection->error);
        var_dump('SQL: ' . $sql);
        return null;
    }
    /*
    static public function loadAllProduct(mysqli $connection) {
        $sql = "SELECT p.*, c.categoryName FROM Product as p, Category as c WHERE p.categoryId = c.id "
                . "ORDER BY p.name ASC";
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedProduct = new Product();
                $loadedProduct->id = $row['id'];
                $loadedProduct->name = $row['name'];
                $loadedProduct->description = $row['description'];
                $loadedProduct->quantity = $row['quantity'];
                $loadedProduct->categoryId = $row['categoryId'];
                $loadedProduct->categoryName = $row['categoryName'];
                $ret[] = $loadedProduct;
            }
        }
        return $ret;
    }
     * 
     */

    static public function searchProducts(mysqli $connection, $categoryId,$productName, $orderBy, $limitFrom, $limitNum) {
 
        $sql = "SELECT p.*, c.categoryName, f.path"
                ." FROM Product as p JOIN Category as c ON (p.categoryId = c.id)"
                . " LEFT JOIN Photos as f on (p.id=f.productId AND f.photoSeq=0) WHERE 1=1";
        
        if ($categoryId != null) {  $sql = $sql." AND p.categoryId = $categoryId"; }       
        if ($productName != null) { $sql = $sql." AND ucase(p.name) LIKE '%". strtoupper($productName)."%'"; }
        
        $sql = $sql." ORDER BY p.categoryId";
        
        switch ($orderBy) {
            case 0: $sql = $sql.", p.Id"; break;
            case 1: $sql = $sql.", p.price ASC"; break;
            case 2: $sql = $sql.", p.price DESC"; break;
            case 3: $sql = $sql.", p.name ASC"; break;
            case 4: $sql = $sql.", p.name DESC"; break;
            default: break;
        }
        
        if ($limitFrom != null && $limitNum != null) {
            $sql = $sql." LIMIT $limitFrom, $limitNum";
        }
                
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedProduct = new Product();
                $loadedProduct->id = $row['id'];
                $loadedProduct->name = $row['name'];
                $loadedProduct->price = $row['price'];
                $loadedProduct->description = $row['description'];
                $loadedProduct->quantity = $row['quantity'];
                $loadedProduct->categoryId = $row['categoryId'];
                $loadedProduct->categoryName = $row['categoryName'];
                $loadedProduct->path = $row['path'];
                $ret[] = $loadedProduct;
            }
        }
        return $ret;
    }
}
