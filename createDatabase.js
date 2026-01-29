const dbConnection = require('./dbconnection');

// Create tables
const createTablesQuery = `
-- Create customers table
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15),
    address VARCHAR(255),
    city VARCHAR(50),
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    category VARCHAR(50),
    stock INT DEFAULT 0,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2),
    status VARCHAR(20) DEFAULT 'pending',
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

-- Create order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
`;

// Execute multiple statements - split and execute individually
const statements = createTablesQuery.split(';').filter(stmt => stmt.trim());

let completed = 0;
statements.forEach((statement) => {
    if (statement.trim()) {
        dbConnection.query(statement, (err) => {
            if (err) {
                console.log('Error:', err);
            } else {
                completed++;
                if (completed === statements.length) {
                    console.log('All tables created successfully');
                    insertSampleProducts();
                }
            }
        });
    }
});

// Insert sample products
function insertSampleProducts() {
    const productsQuery = `
    INSERT INTO products (name, description, price, category, stock) VALUES
    ('Laptop', 'High performance laptop for work and gaming', 999.99, 'Electronics', 10),
    ('Smartphone', 'Latest smartphone with great features', 599.99, 'Electronics', 20),
    ('Headphones', 'Wireless headphones with noise cancellation', 199.99, 'Electronics', 15),
    ('T-Shirt', 'Cotton t-shirt available in multiple colors', 29.99, 'Clothing', 50),
    ('Jeans', 'Comfortable denim jeans', 49.99, 'Clothing', 30),
    ('Running Shoes', 'Professional running shoes', 89.99, 'Footwear', 25),
    ('Coffee Maker', 'Automatic coffee maker with timer', 79.99, 'Home Appliances', 12),
    ('USB Cable', 'High-speed USB-C cable', 9.99, 'Accessories', 100)
    `;

    dbConnection.query(productsQuery, (err) => {
        if (err) {
            console.log('Products may already exist or error:', err.message);
        } else {
            console.log('Sample products inserted successfully');
        }
        dbConnection.end();
    });
}
