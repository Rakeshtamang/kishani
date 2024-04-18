<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="signup.css">
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="post" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email Address" name="email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password"  required />
          </div>
          <input type="submit" value="Login" name="signin" class="btn solid" />
         
        </form>
        </body>
        <?php
include("connection.php");

if(isset(($_POST['signin'])))
{


$email=$_POST['email'];

$password=$_POST['password'];

$sql="SELECT * FROM form WHERE Email='$email' && Password='$password'";
$result=mysqli_query($connection,$sql);

  while($row=mysqli_fetch_assoc($result)){
    // echo $row['Name'];
  //  $_SESSION["Type"]=$row['usertype'];
  $_SESSION["user"]=$row['Name'];
  $_SESSION["Id"] = $row['Id'];
  header('location:mainpage.php');
}
}
?>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
<form action="" class="sign-up-form" method="post">
        
        <h2 class="title">Sign up</h2>
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Full Name" name="signup_full_name" required />
        </div>
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="email" placeholder="Email Address" name="signup_email"  required />
        </div>
        <div class="input-field">
          <i class="fas fa-phone"></i>
          <input type="Number" placeholder="Phone number" name="phoneno"  required />
        </div>
        <div class="input-field">
          <i class="fas fa-user"></i>
<select name="utype">
<option >Select user type</option>
  <option value="farmer">Farmer</option>
  <option value="vendor">Vendor</option>
</select>
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Password" name="signup_password"  required />
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Confirm Password" name="signup_cpassword"  required />
        </div>
    
        <input type="submit" class="btn" name="signup" value="Sign up" />
      </form>
    </div>
  </div>

  <div class="panels-container">
    <div class="panel left-panel">
      <div class="content">
        <h3>New here ?</h3>
        <p>
          If you don't have account, You need to sign up first
        </p>
        <button class="btn transparent" id="sign-up-btn">
          Sign up
        </button>
      </div>
      <img src="img/log.svg" class="image" alt="" />
    </div>
    <div class="panel right-panel">
      <div class="content">
        <h3>One of us ?</h3>
        <p>
         If you have already account then youn can login our page
        </p>
        <button class="btn transparent" id="sign-in-btn">
          Sign in
        </button>
      </div>
      <img src="img/register.svg" class="image" alt="" />
    </div>
  </div>
</div>

<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
<script src="login.js"></script>



</body>
</html>
<?php
include("connection.php");

if(isset(($_POST['signup'])))
{
$name=$_POST['signup_full_name'];
$email=$_POST['signup_email'];
$phone=$_POST['phoneno'];
$password=$_POST['signup_password'];
$conpassword=$_POST['signup_cpassword'];
$utype=$_POST['utype'];
$sql="SELECT * FROM form WHERE Email='$email'";
$result=mysqli_query($connection,$sql);
$num=mysqli_num_rows($result);
if($num == 1)
{
  echo"<script>alert('Email already taken!!!')</script>";
}
else{
  $sql1="INSERT INTO form (Name,Email,Phone,Password,usertype) values 
  ('$name','$email','$phone','$password','$utype')";
  mysqli_query($connection,$sql1);
  echo"<script>alert('Sucessfull!!!')</script>";
  //echo"".mysqli_error($connection);
}
}
?>