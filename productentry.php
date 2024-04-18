<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCT ENTRY</title>
  <link rel="stylesheet" href="productentry2.css">


</head>

<body>
   <div class="content">
    <div class="form">
   <center> <h2>PRODUCT ENTRY</h2></center>  
    <form action="#" method="POST" enctype="multipart/form-data">
      <div class="input">
        <label for="">Enter Product name</label>
        <input type="text" name="pname" placeholder="Enter Product Name" size="15" required />
      </div>

      <div class="input">
          <label>Enter Product Base Price</label>
          <input type="text" name="pprice" placeholder="Enter Product Base Price" size="15" required />
          </div>

          <div class="input">
            <label>Choose a Category:</label>
            <div class="custom_select">
            <select name="category">
              <option>Choose a Category</option>
              <option value="cereals">Cereals</option>
              <option value="pulses">Pulses</option>
              <option value="oilseeds"> Oilseeds</option>
              <option value="spices">Spices</option>
              <option value="spices">Others</option>
            </select>
          </div>
          </div>
          <div class="input">
            <label>Quantity:</label>
            <input type="text" name="weight" placeholder="Weight in Kg"

          </div>
          

          <div class="input">
            <label>Upload Photo:</label>
            <input type="file" name="photo">
            </div>

          </div class="input">
      <center> <input type="submit" value="Add Product" class="btn" name="addproduct" /></center>
        </div>
    </form>
    </div>
  </div>
  </div> 
  
</body>

</html>
<?php
include("connection.php");
if(isset(($_POST['addproduct'])))
{

    $pname=$_POST['pname'];
    $pprice=$_POST['pprice'];
    $category=$_POST['category'];
    $weight=$_POST['weight'];
    $filename=$_FILES["photo"]["name"];
    $tempname=$_FILES["photo"]["tmp_name"];
    $folder="images/".$filename;
    $uid = $_SESSION["Id"];
    move_uploaded_file($tempname,$folder);

    $sql="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE Table_schema='kishani' AND TABLE_NAME='product'";
    $result = $connection->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $pid=$row["AUTO_INCREMENT"];
  }
}
  $sql="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE Table_schema='kishani' AND TABLE_NAME='auction'";
  $result = $connection->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
  $aid=$row["AUTO_INCREMENT"];
}
}


    $sql="INSERT INTO product (pname,pprice,category,Weight,photo,U_Id) 
     values('$pname','$pprice','$category','$weight','$folder','$uid')";
      if(mysqli_query($connection,$sql))
      {
        //  echo"<script>('Inserted Sucessfully!!!.')</script>";
        // header("location: mainpage.php");
      }
      else{
        header("location: productentry.php");
      }
      $sql="INSERT INTO auction(Amount,P_Id,Status) values('$pprice','$pid','pending')";
      if(mysqli_query($connection,$sql))
      {
        // echo"<script>alert('Inserted Sucessfully!!!.')</script>";
        // header("location: mainpage.php");
      }
      else{
        header("location: productentry.php");

      }
      $sql="INSERT INTO bid(A_Id,P_Id,U_Id) values('$aid','$pid','$uid')";
      if(mysqli_query($connection,$sql))
      {
         echo"<script>alert('Inserted Sucessfully!!!.')</script>";
        header("location: mainpage.php");
      }
      else{
        header("location: productentry.php");

      }
      
}

?>