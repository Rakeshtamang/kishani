<?php
$servername="localhost";
$username="root";
$password="";
$database="kishani";
//cretaing connection
$connection=mysqli_connect($servername,$username,$password,$database);
//checking connection
if(!$connection)
{
    die("Connection failed:".mysqli_connect_error());
}
else{
    //echo("Database connection sucessfull");
}
?>