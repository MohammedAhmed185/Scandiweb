<?php
require_once 'Product.php';

class BookProduct extends Product {
    private $weight;

    public function __construct($sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function getAttribute() {
        return $this->weight;
    }

    public function getType() {
        return 'book';
    }

    public function getAttributeColumn() {
        return 'weight';
    }

    public function getDisplayAttribute() {
        return 'Weight: ' . $this->weight . ' KG';
    }

    public function setAttribute($attribute) {
        $this->weight = $attribute;
    }
}



?>