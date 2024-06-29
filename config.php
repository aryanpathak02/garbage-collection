<?php

define('PATH' , '/' . trim( strtok($_SERVER["REQUEST_URI"], '?') , '/' ));

define('DB_HOST', 'localhost');
define('DB_NAME', 'garbage_collection');
define('DB_USER', 'gc_user');
define('DB_PASSWORD', 'Password@123');

try {
    
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Enable exceptions for errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Set default fetch mode to associative array
        PDO::ATTR_EMULATE_PREPARES => false,  // Disable emulated prepared statements
    ]);
    
} catch (PDOException $e) {
    echo "Connection to db failed: " . $e->getMessage() . "\n";
    exit;
}