<!DOCTYPE html>
<html>
<head>
    <title>Product Add</title>
    <link rel="stylesheet" type="text/css" href="/public/styles.css">
    <script>
        function toggleAttributes() {
            var productType = document.getElementById('productType').value;
            var attributeSections = document.querySelectorAll('.attribute-section');
            attributeSections.forEach(function(section) {
                section.style.display = 'none';
                var inputs = section.querySelectorAll('input');
                inputs.forEach(function(input) {
                    input.removeAttribute('required');
                });
            });
            var selectedSection = document.querySelector('.attribute-section[data-type="' + productType + '"]');
            if (selectedSection) {
                selectedSection.style.display = 'block';
                var inputs = selectedSection.querySelectorAll('input');
                inputs.forEach(function(input) {
                    input.setAttribute('required', 'required');
                });
            }
        }
    </script>
</head>
<body>
    <header class="header">
        <h1>Product Add</h1>
        <div class="button-container">
            <button type="submit" id="save-product-btn" form="product_form" class="action-button">Save</button>
            <button type="button" onclick="window.location.href='/public/index.php';" class="action-button cancel-button">Cancel</button>
        </div>
    </header>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="form-container">
        <form id="product_form" action="/public/index.php?action=save" method="post" class="product-form">
            <label for="sku">SKU:</label>
            <input type="text" id="sku" name="sku" required>
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="price">Price ($):</label>
            <input type="number" id="price" name="price" step="0.01" required>
            
            <label for="productType">Type Switcher:</label>
            <select id="productType" name="type" onchange="toggleAttributes()" required>
                <option value="" disabled selected>Select Type</option>
                <option value="electronic">DVD</option>
                <option value="furniture">Furniture</option>
                <option value="book">Book</option>
            </select>
            
            <div id="dvdAttributes" class="attribute-section" data-type="electronic" style="display: none;">
                <label for="size">Size (MB):</label>
                <input type="number" id="size" name="size" step="0.01">
                <p>Product description: Please provide the size in MB.</p>
            </div>
            
            <div id="furnitureAttributes" class="attribute-section" data-type="furniture" style="display: none;">
                <label for="height">Height (CM):</label>
                <input type="number" id="height" name="height" class="attribute-field">
                <label for="width">Width (CM):</label>
                <input type="number" id="width" name="width" class="attribute-field">
                <label for="length">Length (CM):</label>
                <input type="number" id="length" name="length" class="attribute-field">
                <p>Product description: Please provide dimensions in HxWxL format.</p>
            </div>
            
            <div id="bookAttributes" class="attribute-section" data-type="book" style="display: none;">
                <label for="weight">Weight (KG):</label>
                <input type="number" id="weight" name="weight" step="0.01">
                <p>Product description: Please provide the weight in KG.</p>
            </div>
        </form>
    </div>
    <footer class="footer">
        <p>Scandiweb</p>
    </footer>
</body>
</html>
