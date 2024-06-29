<?php



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

define('IS_POST' , 'POST' ===  $_SERVER['REQUEST_METHOD']);
define('IS_GET' , 'GET' ===  $_SERVER['REQUEST_METHOD']);

function get_var( string $key ) {
    
    if( array_key_exists( $key , $_GET ) ) {
        return $_GET[$key];
    } else {
        return null;
    }

}

function post_var( string $key ) {
    
    if( array_key_exists( $key , $_POST ) ) {
        return $_POST[$key];
    } else {
        return null;
    }

}
