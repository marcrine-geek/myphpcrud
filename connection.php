<?php


$server="localhost";
$user="root";
$password="";
$dbname="phpcrud";

//creating the connection
$connection=mysqli_connect($server, $user, $password, $dbname);

//check connection
if (!$connection){
    die("conection has failed. ". mysqli_connect_error());
}


?>
