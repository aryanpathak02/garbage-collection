<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/common.php';


//api ( might move to another file later )
if (IS_GET &&  '/check_number_exists' == PATH && array_key_exists('number', $_GET)) {

    header('Content-Type: application/json');

    echo json_encode(['number_exists' => number_exists($_GET['number'])]);
    die;
}




//routing
if ('/signup' == PATH) {

    if (IS_POST) {

        if (

            ($number = post_var('number')) &&
            ($name = post_var('name')) &&
            $password = post_var('password')

        ) {


            if (number_exists($number)) {

                echo $twig->render('signup.html', [
                    'name' => $name,
                    'email' => post_var('email') ?? '',
                    'number' => $number,
                    'number_exists' => true
                ]);
                die;
            }

            // id INT AUTO_INCREMENT NOT NULL,
            // name VARCHAR(30) NOT NULL,
            // email VARCHAR(50) NULL,
            // password VARCHAR(60) NOT NULL,
            // number varchar(15) unique not null ,
            // role ENUM('resident', 'garbage_collector', 'admin') NOT NULL,
            // PRIMARY KEY (id)

            $hashed_pw = password_hash($password, PASSWORD_BCRYPT);

            $query = $pdo->prepare('insert into users ( name , email , password , number , role ) values ( :name , :email , :pw , :num , :role )');
            $query->execute(['name' => $name, 'email' => post_var('email'), 'pw' => $hashed_pw, 'num' => $number, 'role' => ROLE_RES]);        }
    } else {

        echo $twig->render('signup.html');
        die;

    }


    // email , mobile , name , address , pincode

}
