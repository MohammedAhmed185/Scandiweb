<?php
abstract class Product {
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $this->getType();
    }

    abstract public function getAttribute();
    abstract public function getType();
    abstract public function getAttributeColumn();
    abstract public function getDisplayAttribute();
    abstract public function setAttribute($attribute);

    public function save() {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO products (sku, name, price, type, " . $this->getAttributeColumn() . ") VALUES (:sku, :name, :price, :type, :attribute)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':attribute', $this->getAttribute());

        if (!$stmt->execute()) {
            throw new Exception("Error saving product");
        }
    }

    public function delete() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM products WHERE sku = :sku");
        $stmt->bindParam(':sku', $this->sku);
        $stmt->execute();
    }

    public function getSku() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}
?>
