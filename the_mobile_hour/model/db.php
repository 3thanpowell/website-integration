<?php

// database credentials
$host = 'localhost' ;
$db = 'the-mobile-hour';
$db_user = 'admin';
$db_password = 'themobilehour';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// error and exception handling
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  // the above line ensures an error is thrown when something goes wrong 
  
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  // the above line ensures that the data is returned as an array(access columns by their names instead of number)
  
  PDO::ATTR_EMULATE_PREPARES => false,
  // the above line protects from SQL injections by disabling emulated prepared statements.
];



// try catch block to connect to database
try {
  $pdo = new PDO($dsn, $db_user, $db_password, $options);

} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
} 
