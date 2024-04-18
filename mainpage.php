<?php
session_start();
if(!isset($_SESSION['user']))
{

    header("Location:signup.php");
}
$id= $_SESSION['Id'];
$user=$_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture Product Management System</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
   
   <link rel="stylesheet" href="mainpage4.css">

</head>
<body>

<!-- header section starts  -->

<header>

    <div class="header-1">

        <img src="images/kisane.png" class="logo">

   
    </div>

    <div class="header-2">

        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="#home">home</a>
            <?php
            include("connection.php");
            $sql = "SELECT * FROM form WHERE Id = ".$_SESSION["Id"]."";
            $result=mysqli_query($connection,$sql);
            while($row=$row=mysqli_fetch_assoc($result)){
                $usertype = $row["usertype"];
            }

            if($usertype=="farmer")
            {

           
            ?>
            <a href="#product">Market Place</a>
            <a href="productentry.php">Product Entry</a>
            <a href="display.php">Bidder List</a>
            <?php
            }
            else{

            
            ?>
            <a href="#product">Market Place</a>
            
            <?php
            }
            ?>
           <!-- <a href="productdisplay.php">contact</a>  -->
        </nav>
  

        <div class="navbar">
            <!-- <a href="#" class="fas fa-shopping-cart"></a> -->
            <!-- <a href="#" class="fas fa-user-circle"></a> -->
            <a href="logout.php">Log Out</a> 
        </div>

    </div>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

 
    <div class="content">
        
       <center><h3>Welcome to our auction site</h3></center> 
       <head>
       <style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 500px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
</head>
<body>



<div class="slideshow-container">

<div class="mySlides fade">
  <!-- <div class="numbertext">1 / 3</div> -->
  <img src="images/front-1.png" style="width:100%">

</div>

<div class="mySlides fade">
  <!-- <div class="numbertext">2 / 3</div> -->
  <img src="images/front-2.jpg" style="width:100%">
  
</div>

<div class="mySlides fade">
  <!-- <div class="numbertext">3 / 3</div> -->
  <img src="images/front-3.jpg" style="width:100%">
  
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

</div>
<br>


    

</body>
</section>
<!-- home section ends -->





<!-- product section starts  -->

<section class="product" id="product">



    <h1 class="heading">latest <span>products</span></h1>

    <div class="box-container">

    
<?php
include("connection.php");

$sql="SELECT * FROM product INNER JOIN auction on auction.P_Id=product.pid WHERE auction.STATUS= 'approved'";
$data=mysqli_query($connection,$sql);



    while($row=mysqli_fetch_assoc($data)) { 
        $query="SELECT MAX(Amount) AS Max_Amount FROM auction where P_Id='".$row["pid"]."'";
        $dataa=mysqli_query($connection,$query);
        if($roow=mysqli_fetch_assoc($dataa)){
            $bid_amount = $roow['Max_Amount'];
        }
        ?>

        <div class="box">
                
         
            <img src=<?php echo $row['photo']?> alt="">
            <h3><?php echo $row['pname']?></h3>
           <div class="price">Product Id: <?php echo $row["pid"]?></div>
            <div class="price">Base Price: Rs <?php echo $row['pprice']?> </div>
            <div class="price">Bidding Price: Rs <?php if($bid_amount==0){
                                                            echo $row['pprice'];
                                                        }else{
                                                            echo $bid_amount;
                                                        }?></div>
            <?php
            $bid_amount= 0;
            ?>
            <div class="quantity">
                <h3>Quantiy: <?php echo $row['Weight']?></h3>
                <h3>KG</h3>
            </div>


         <?php
            if($usertype=="farmer")
            {

           
            ?>
          
            <?php
            }
            else{

            
            ?>
            <form action="bidding.php" method="POST">
              <div class="input-field">
                <input type="name" name="bid1" placeholder="Bid">
            </div>
            <input type="hidden" name="product_id" value="<?php echo $row["pid"]?>">
            <input type="hidden" name="bid_Amount" value="<?php echo $bid_amount?>">
            <input type="hidden" name="auction_Id" value="<?php echo $auction_id?>">
            <input type="hidden" name="product_Amount" value="<?php echo $row["pprice"]?>">
       <center>   <input type="submit" class="btn" name="bid" value="Bid"> </center> 
            </form>
            <?php
            }
            ?>
         </div>
    <?php
    }
    ?>
        

    </div>

   
 

</section>

<!-- product section ends -->



<!-- custom js file link  -->
<script src="home1.js"></script>
    
</body>
</html>