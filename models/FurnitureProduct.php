<?php
require_once 'Product.php';

class FurnitureProduct extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getAttribute() {
        return $this->height . 'x' . $this->width . 'x' . $this->length;
    }

    public function getType() {
        return 'furniture';
    }

    public function getAttributeColumn() {
        return 'dimensions';
    }

    public function getDisplayAttribute() {
        return 'Dimensions: ' . $this->height . 'x' . $this->width . 'x' . $this->length;
    }

    public function setAttribute($attribute) {
        list($this->height, $this->width, $this->length) = explode('x', $attribute);
    }
}
?>
