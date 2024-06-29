<?php

require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__. '/templates');
$twig = new \Twig\Environment($loader, [
    // 'cache' => __DIR__ . '/twig_co',
]);

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

function number_exists( $number ) :bool {

    global $pdo;

    $q = $pdo->prepare('select id from users where number = :number limit 1');
    $q->execute(['number' => $number]);

   return (bool)($q->rowCount());
}
