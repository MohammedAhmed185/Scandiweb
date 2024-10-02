CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sku VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    type ENUM('electronic', 'book', 'furniture') NOT NULL,
    size DECIMAL(10,2) NULL,
    weight DECIMAL(10,2) NULL,
    dimensions VARCHAR(50) NULL
);
