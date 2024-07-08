<?php

if (!defined('DB_NAME')) {
    define('DB_NAME', 'lpkshop');
}
if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}

try{

    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    mysqli_set_charset($con, 'utf8');


}catch (Exception $ex){
    print "An Exception occurred. Message: " . $ex->getMessage();
} catch (Error $e){
    print "The system is busy please try later";
}