<?php

/*
 * Class Order:
 * składanie zamówienia, edycja zamówienia
 */
class Order {

    private $id;
    private $userId;
    private $statusId;
    private $creatingDate;
    private $productOrder;

    public function __construct() {
        $this->id = -1;
        $this->userId = 0;
        $this->statusId = 0;
        $this->creatingDate = "";
        $this->productOrder = []; //przechowywane będą id, productId, quantity, productName, price
    }

    /*
     * Sets and Gets mathods:
     */

    public function setUserId($userId) {
        if (is_numeric($userId)) {
            $this->userId = $userId;
        }
    }

    public function setStatusId($statusId) {
        if (is_numeric($statusId)) {
            $this->statusId = $statusId;
        }
    }

    public function setCreatingDate($creatingDate) {
        if(is_integer($creatingDate)) {
            $this->creatingDate = $creatingDate;
        }
    }

    
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getStatusId() {
        return $this->statusId;
    }

    public function getCreatingDate() {
        return $this->creatingDate;
    }
    
    public function getProductOrder() {
        return $this->productOrder;
    }

    
    /*
     * Saving a new order to DB
     */
    /*
    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            $sql1 = "INSERT INTO Order (userId, statusId, creatingDate)
                  VALUES ('$this->userId','$this->statusId', '$this->creatingDate')";

            $result = $connection->query($sql1);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
                
            
            $sql2 = "INSERT INTO Product_Order (productId, orderId, price, quantity)
                  VALUES ('$this->productId','$this->statusId', '$this->creatingDate')";

            $result = $connection->query($sql2);

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
    }
    /*
     * Deleting a product
    
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
        
    }
   
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
    */
    static public function getCartByUserId(mysqli $connection, $userId) {

        $sql = "SELECT * FROM `Order` WHERE userId=$userId AND statusId = 0";
        
        $resOrder = $connection->query($sql);

        if ($resOrder == true && $resOrder->num_rows == 1) {
            $row = $resOrder->fetch_assoc();
            $loadedOrder = new Order();
            $loadedOrder->id = $row['id'];
            $loadedOrder->userId = $row['userId'];
            $loadedOrder->statusId = $row['statusId'];
            $loadedOrder->creatingDate = $row['creatingDate'];
    
            $sql = "SELECT p.*, p_o.id FROM Product as p, Product_Order as p_o WHERE p.id=p_o.productId AND p_o.orderId = ".$loadedOrder->getId();
            
            $resOrderProd = $connection->query($sql);

            if ($resOrderProd == true && $resOrderProd->num_rows > 0) {
                $i=0;
                foreach ($resOrderProd as $row) {
                    $loadedOrder->productOrder[$i]['id']=$row['id'];
                    $loadedOrder->productOrder[$i]['name']=$row['name'];
                    $loadedOrder->productOrder[$i]['price']=$row['price'];
                    $loadedOrder->productOrder[$i]['quantity']=$row['quantity'];
                    $i++;
                }
            }
            
            return $loadedOrder;
            
        } else {
            //funkcja zapisująca koszyk do bazy...
        } 
    }
    
}
