<?php
include("../connection.php");
    $sql = "UPDATE auction SET STATUS = 'approved' WHERE A_Id='".$_GET['aid']."'";
    $query = mysqli_query($connection,$sql);
    header('Location: adminpage.php');
?>
