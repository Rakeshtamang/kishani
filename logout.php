<?php   
// SELECT product.pid, product.photo, product.pname, form.Name, auction.Amount from product INNER JOIN bid ON bid.P_Id = product.pid INNER JOIN form ON product.U_Id = form.Id INNER JOIN auction ON bid.A_Id = auction.A_ID WHERE product.U_Id = 1;
session_start(); 
session_destroy();
header("location:home.php"); 
exit();
?>