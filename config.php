<?php

define('PATH' , '/' . trim( strtok($_SERVER["REQUEST_URI"], '?') , '/' ));

define('DB_HOST', 'localhost');
define('DB_NAME', 'garbage_collection');
define('DB_USER', 'gc_user');
define('DB_PASSWORD', 'Password@123');

define('ROLE_RES' , 'resident');
define('ROLE_GC' , 'garbage_collector');
define('ROLE_admin' , 'admin');