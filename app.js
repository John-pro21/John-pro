const express = require('express');
const path = require('path');
const dbConnection = require('./dbconnection');

const app = express();

// Middleware
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.urlencoded({ extended: true }));
app.use(express.json());

// Set view engine
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// Routes
app.get('/', (req, res) => {
    res.render('index');
});

app.get('/products', (req, res) => {
    const query = 'SELECT * FROM products';
    dbConnection.query(query, (err, results) => {
        if (err) {
            console.log('Error fetching products:', err);
            res.render('products', { products: [] });
        } else {
            res.render('products', { products: results });
        }
    });
});

app.get('/customer-register', (req, res) => {
    res.render('register');
});

app.post('/customer-register', (req, res) => {
    const { name, email, phone, address, city, password } = req.body;
    const query = 'INSERT INTO customers (name, email, phone, address, city, password) VALUES (?, ?, ?, ?, ?, ?)';
    
    dbConnection.query(query, [name, email, phone, address, city, password], (err) => {
        if (err) {
            console.log('Error registering customer:', err);
            res.send('Registration failed. Email might already exist.');
        } else {
            res.send('Customer registered successfully! <a href="/">Back to Home</a>');
        }
    });
});

app.get('/cart', (req, res) => {
    res.render('cart');
});

app.get('/checkout', (req, res) => {
    res.render('checkout');
});

app.get('/contact', (req, res) => {
    res.render('contact');
});

// Start server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Shopping website running on port ${PORT}`);
});
