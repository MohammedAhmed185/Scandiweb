<?php
require_once 'ElectronicProduct.php';
require_once 'BookProduct.php';
require_once 'FurnitureProduct.php';

interface ProductStrategy {
    public function create($sku, $name, $price, $attribute);
    public function extractAttribute($postData);
}

class ElectronicProductStrategy implements ProductStrategy {
    public function create($sku, $name, $price, $size) {
        return new ElectronicProduct($sku, $name, $price, $size);
    }

    public function extractAttribute($postData) {
        return isset($postData['size']) ? floatval($postData['size']) : null;
    }
}

class BookProductStrategy implements ProductStrategy {
    public function create($sku, $name, $price, $weight) {
        return new BookProduct($sku, $name, $price, $weight);
    }

    public function extractAttribute($postData) {
        return isset($postData['weight']) ? floatval($postData['weight']) : null;
    }
}

class FurnitureProductStrategy implements ProductStrategy {
    public function create($sku, $name, $price, $attribute) {
        if ($attribute === null) {
            $dimensions = [null, null, null];
        } else {
            $dimensions = explode('x', $attribute);
        }
        $height = isset($dimensions[0]) ? $dimensions[0] : null;
        $width = isset($dimensions[1]) ? $dimensions[1] : null;
        $length = isset($dimensions[2]) ? $dimensions[2] : null;
        return new FurnitureProduct($sku, $name, $price, $height, $width, $length);
    }

    public function extractAttribute($postData) {
        $height = isset($postData['height']) ? $postData['height'] : null;
        $width = isset($postData['width']) ? $postData['width'] : null;
        $length = isset($postData['length']) ? $postData['length'] : null;
        if ($height !== null && $width !== null && $length !== null) {
            return $height . 'x' . $width . 'x' . $length;
        }
        return null;
    }
}

class ProductFactory {
    private $strategies = [];

    public function __construct() {
        $this->strategies = [
            'electronic' => new ElectronicProductStrategy(),
            'book' => new BookProductStrategy(),
            'furniture' => new FurnitureProductStrategy()
        ];
    }

    public function createProduct($type, $sku, $name, $price, $attribute) {
        if (!isset($this->strategies[strtolower($type)])) {
            throw new Exception("Invalid product type: $type");
        }

        return $this->strategies[strtolower($type)]->create($sku, $name, $price, $attribute);
    }

    public function extractAttribute($type, $postData) {
        if (!isset($this->strategies[strtolower($type)])) {
            throw new Exception("Invalid product type: $type");
        }

        return $this->strategies[strtolower($type)]->extractAttribute($postData);
    }
}
?>
