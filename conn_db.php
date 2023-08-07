<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "data";
try{

    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    //echo "sucess";
}catch(Exception $e){
    echo $e->getMessage();
    exit();
}


?>