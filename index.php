<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);   

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/common.php';


//api ( might move to another file later )
if( IS_GET &&  '/check_number_exists' == PATH && array_key_exists('number' , $_GET) ) {

    header('Content-Type: application/json');
    $q = $pdo->prepare('select id from users where email = :email limit 1');
    $q->execute(['email' => $_GET['number']]);

    echo json_encode(['email_exists' => (bool)($q->rowCount())]);
    die;

}




//routing
if( IS_POST && '/signup' == PATH ) {

    if( 

        $number = post_var('number') &&
        $name = post_var('name') &&
        $password = post_var('password')

    ) {



    }

    // email , mobile , name , address , pincode

}

