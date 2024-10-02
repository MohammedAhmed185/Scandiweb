<?php
require_once 'Product.php';

class ElectronicProduct extends Product {
    private $size;

    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function getAttribute() {
        return $this->size;
    }

    public function getType() {
        return 'electronic';
    }

    public function getAttributeColumn() {
        return 'size';
    }

    public function getDisplayAttribute() {
        return 'Size: ' . $this->size . ' MB';
    }
    public function setAttribute($attribute) {
    $this->size = $attribute;
    }
}
?>
