# Shopping Website

A complete e-commerce shopping website built with Node.js, Express, and MySQL.

## Features

- **Home Page**: Welcome page with featured sections
- **Products Page**: Display all products from database
- **Customer Registration**: Register new customers with address info
- **Shopping Cart**: Add and manage products
- **Checkout**: Complete purchase with payment details
- **Contact Page**: Get in touch with customer support
- **Database**: Store customers, products, and orders

## Installation

1. Install dependencies:
```bash
npm install ejs
```

2. Create the database and tables:
```bash
node createDatabase.js
```

3. Start the server:
```bash
node app.js
```

4. Open browser and visit:
```
http://localhost:3000
```

## Database Tables

- **customers**: Store customer information
- **products**: Store product details
- **orders**: Store order information
- **order_items**: Store items in each order

## File Structure

```
john-pro/
├── app.js                 # Main Express app
├── createDatabase.js      # Database setup script
├── dbconnection.js        # MySQL connection
├── package.json           # Dependencies
├── views/                 # EJS templates
│   ├── index.ejs         # Home page
│   ├── products.ejs      # Products page
│   ├── register.ejs      # Registration form
│   ├── cart.ejs          # Shopping cart
│   ├── checkout.ejs      # Checkout page
│   └── contact.ejs       # Contact page
└── public/               # Static files
    └── css/
        └── style.css     # Styling
```

## Next Steps

- Add user authentication
- Implement payment gateway integration
- Add product search and filtering
- Create admin panel
- Add order tracking
