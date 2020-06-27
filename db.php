<?php

define('DB_USER','root');
define('DB_PASS','tiger');
define('DB_HOST','database');
define('DB_BASE','docker');

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);

if($connect){
    //  echo "Connect Success";
}