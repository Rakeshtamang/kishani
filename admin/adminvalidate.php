<?php

include("adminconnection.php");

function test_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$servername = "localhost";
	$dbname = "kishani";
	$user = "root";
	$pass = "";
	$conn = new PDO(
		"mysql:host=$servername; dbname=kishani",
		$user, $pass
	);
	$stmt = $conn->prepare("SELECT * FROM admin2");
	$stmt->execute();
	$users = $stmt->fetchAll();
	
	foreach($users as $user) {
		
		if(($user['username'] == $username) &&
			($user['password'] == $password)) {
				header("location: adminpage.php");
				echo("Done");
		}
		else {
			echo "<script language='javascript'>";
			echo "alert('WRONG INFORMATION')";
			echo "</script>";
			header("location:/home.php"); 
			die();
			
		}
	}
}

?>
