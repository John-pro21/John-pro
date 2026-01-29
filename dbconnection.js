const mysql2 = require('mysql2');

const dbConnection = mysql2.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'shoppings'
});

dbConnection.connect((err) => {
    if (err) {
        console.log('Failed to connect to MySQL:', err);
        process.exit(1);
    } else {
        console.log('Connected to MySQL database successfully');
    }
});

module.exports = dbConnection;

