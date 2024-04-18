<?php
session_start();
?>
<html>
    <head> 
        <title>Display</title>
        <link rel="stylesheet" href="admin.css">
        <style>
            .button-approve{
	width: 30%;
	padding: 8px;
	color: #ffffff;
	background: none #70db70;
	border: none;
	border-radius: 6px;
	font-size: 18px;
	cursor: pointer;
	margin: 12px 0;
}

.button-decline{
	width: 30%;
	padding: 8px;
	color: #ffffff;
	background: none #d21f3c;
	border: none;
	border-radius: 6px;
	font-size: 18px;
	cursor: pointer;
	margin: 12px 0;
}
        </style>
    </head>

<?php
include("../connection.php");

$sql="SELECT auction.A_Id, product.pid, product.photo,form.Name, product.pname, auction.Amount from product INNER JOIN bid ON bid.P_Id = product.pid INNER JOIN form ON product.U_Id = form.Id INNER JOIN auction ON bid.A_Id = auction.A_ID WHERE auction.STATUS='Pending'";
$data=mysqli_query($connection,$sql);


if(mysqli_num_rows($data)>0)

{
    ?>
  <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
         <th >Product ID</th>
        <th >Photo</th>
        <th >Product Name</th>
        <th >User Name</th>
        <th >Bid Price</th>
        <th>Status
            
        </th>
         </thead>
       
    <?php
   
   while($row=mysqli_fetch_assoc($data))

   {
       echo  "
       <tr>
       
       <td>".$row['pid']."</td>
       <td><img src=".$row['photo']." height=60px; width=60px></td>
       <td>".$row['pname']."</td>
       <td>".$row['Name']."</td>
       <td>".$row['Amount']."</td>
        <td>
            <a href='approve.php?aid=".$row['A_Id']."'><button type='submit' name='submit' class='button-approve' value=".$row['A_Id'].">Apporove</button></a>
            <a href='delete.php?aid=".$row['A_Id']."'><button value=".$row['A_Id']." class='button-decline'>Delete</button></a>
        </td>
       </tr>
       
         ";
     
   }
}

?>

