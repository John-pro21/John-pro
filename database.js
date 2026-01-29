const mysql2=require('mysql2');
const con=mysql2.createConnection({
    host:'localhost',
    user:'root',
    password:'',
    database:''
})
//check up mysql connection if it is success or failed
con.connect((err)=>{
    if(err){
    console.log('failed to connect',err)
}
else{
    console.log('connected to mysql database')
}
})
//create database
con.query('CREATE DATABASE IF NOT EXISTS shoppings',(err)=>{
    if(err){
        console.log('failed to create database',err)
    } 
    return console.log('database created successfully')
})