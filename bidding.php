<?php
session_start();
include("connection.php");
if(isset($_POST["bid"])){
    $id = $_POST["product_id"];
    $previous_price = $_POST["bid_Amount"];
    $bid_price = $_POST["bid1"];
    $auction_id = $_POST["auction_Id"];
    $userid=$_SESSION['Id'];
    
    if($bid_price<=$previous_price){
        header("location: mainpage.php");
        echo "<script>alert('bid amount must be greather than bidding Price!')</script>";
    } else{
        // $sql="INSERT INTO  (pname,pprice,category,Weight,photo) 
        // values('$pname','$pprice','$category','$weight','$folder')";

        $autoIncrementQuery = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE Table_schema='kishani' AND TABLE_NAME='auction'";
        $auto = mysqli_query($connection,$autoIncrementQuery);
        if($roow=mysqli_fetch_assoc($auto)){
            $autoIncrement = $roow['AUTO_INCREMENT'];
        }


        $sql = "INSERT INTO auction (Amount,P_Id)
        values('$bid_price','$id')";
        if(mysqli_query($connection,$sql)){
            echo "Sucess!";
            
        } else {
            echo $userid;
            die();
            
        }

        $query="INSERT INTO bid(A_Id,P_Id,U_Id)
        values('$autoIncrement','$id','$userid')";
        if(mysqli_query($connection,$query)){
            
            echo "<script>alert('Bid is Successful!')</script>";
            header("Location: mainpage.php");
        } else {
            echo "<script>alert('Something went wrong!')</script>";
            header("Location: mainpage.php");
        }


        // SELECT auction.Amount, bid.U_Id from product INNER JOIN bid ON product.pid = bid.P_Id INNER JOIN auction ON auction.A_Id = bid.A_Id WHERE auction.Amount=(SELECT MAX(Amount) FROM auction);


    }
}
?>