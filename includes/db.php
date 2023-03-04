<?php 

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "cms");

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$connection->set_charset('utf8');

// if($connection) {
//     echo "We are connected";
// } else {
//     echo "Connection ERROR";
// }