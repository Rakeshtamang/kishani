<?php
session_start();
?>

<html>
    <head>
        <title>Display</title>
        <link rel="stylesheet" href="display1.css">
    </head>
    <body>
    <?php
include("connection.php");
$sql="SELECT product.pid, product.photo, product.pname, form.Name, auction.Amount, auction.STATUS from product INNER JOIN bid ON bid.P_Id = product.pid INNER JOIN form ON product.U_Id = form.Id INNER JOIN auction ON bid.A_Id = auction.A_ID WHERE form.Id = ".$_SESSION["Id"]."";
$data=mysqli_query($connection,$sql);


if(mysqli_num_rows($data)>0)

{
    ?>
    <h1 class="heading">bidding <span>list</span></h1>

  <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
         <th >Product ID</th>
        <th >Photo</th>
        <th >Product Name</th>
        <th >User Name</th>
        <th >Bid Price</th>
        <th>Status</th>
         </tr>
         </thead>
         <?php
    while($row=mysqli_fetch_assoc($data))
    //below the name should be same as the database row name 
    {
        echo  "
        <tr>
        
        <td>".$row['pid']."</td>
        <td><img src='".$row['photo']."' height=60px; width=60px></td>
        <td>".$row['pname']."</td>
        <td>".$row['Name']."</td>
        <td>".$row['Amount']."</td>
       <td>".$row['STATUS']."</td>

        </tr>
        
        ";
      
    }
}

?>
 
</table>
</body>
</html>