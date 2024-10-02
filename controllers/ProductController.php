<?php
require_once '../db.php';
require_once '../models/Product.php';
require_once '../models/ProductFactory.php';

class ProductController {
    private $factory;

    public function __construct() {
        $this->factory = new ProductFactory();
    }

    public function index() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM products ORDER BY id");
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($productsData as $productData) {
            try {
                $type = $productData['type'];
                $sku = $productData['sku'];
                $name = $productData['name'];
                $price = $productData['price'];

                // Use the factory to create the product without the attribute first
                $product = $this->factory->createProduct($type, $sku, $name, $price, null);

                // Retrieve the attribute column dynamically
                $attributeColumn = $product->getAttributeColumn();
                $attribute = $productData[$attributeColumn];

                // Set the attribute value
                $product->setAttribute($attribute);

                $products[] = $product;
            } catch (Exception $e) {
               
            }
        }

        require '../views/index.php';
    }

    public function add() {
        require '../views/add.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $_POST['sku'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $price = $_POST['price'];

            try {
                $attribute = $this->factory->extractAttribute($type, $_POST);
                if ($attribute === null) {
                    throw new Exception("Attribute not found or incomplete for type: $type");
                }
            } catch (Exception $e) {
                $error = 'Invalid product attribute';
                require '../views/add.php';
                return;
            }

            // Check if SKU already exists
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT COUNT(*) FROM products WHERE sku = :sku");
            $stmt->bindParam(':sku', $sku);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $error = 'SKU already exists';
                require '../views/add.php';
                return;
            }

            try {
                $product = $this->factory->createProduct($type, $sku, $name, $price, $attribute);
                $product->save();
                header('Location: /'); // Redirect to the product list
                exit();
            } catch (Exception $e) {
                $error = $e->getMessage();
                require '../views/add.php';
            }
        } else {
            require '../views/add.php';
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $skus = $_POST['skus'];

            $db = Database::getInstance()->getConnection();

            try {
                $db->beginTransaction();
                foreach ($skus as $sku) {
                    $stmt = $db->prepare("DELETE FROM products WHERE sku = :sku");
                    $stmt->bindParam(':sku', $sku);
                    $stmt->execute();
                }
                $db->commit();
                header('Location: /'); // Redirect to the product list
                exit();
            } catch (Exception $e) {
                $db->rollBack();
                $error = $e->getMessage();
                $this->index(); // Reload the product list with error message
            }
        } else {
            $this->index(); // Reload the product list
        }
    }
}
?>
