<?php
/**
 * Class Product:
 */

class Product {
    private $id;
    private $name;
    private $price;
    private $description;
    private $quantity;
    
    public function __construct() {
        $this->id = -1;
        $this->name = "";
        $this->price = 0;
        $this->description = "";
        $this->quantity = 0;
    }
    /*
     * Sets and Gets mathods:
     */
    public function setName($name) {
        $this->name = $name;
    }
    public function setPrice($name) {
        $this->name = $name;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
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
}