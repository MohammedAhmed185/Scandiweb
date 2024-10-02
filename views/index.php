<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="/public/styles.css">
</head>
<body>
    <header class="header">
        <h1>Product List</h1>
        <div class="button-container">
            <a href="/add-product" id="add-product-btn" class="action-button">ADD</a>
            <form action="/public/index.php?action=delete" method="post" class="inline-form">
                <button id="delete-product-btn" class="action-button">MASS DELETE</button>
        </div>
    </header>
    <form action="/public/index.php?action=delete" method="post" class="product-list-form">
        <div class="product-list">
            <?php if (isset($products) && is_array($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-item">
                        <input type="checkbox" class="delete-checkbox" name="skus[]" value="<?php echo $product->getSku(); ?>">
                        <p><?php echo $product->getSku(); ?></p>
                        <p><?php echo $product->getName(); ?></p>
                        <p><?php echo $product->getPrice(); ?> $</p>
                        <p><?php echo $product->getDisplayAttribute(); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </form>
    <footer class="footer">
        <p>ScandiWeb</p>
    </footer>
</body>
</html>
