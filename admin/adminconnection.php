<?php

$conn = "";

try {
	$servername = "localhost";
	$dbname = "kishani";
	$username = "root";
	$password = "";

	$conn = new PDO(
		"mysql:host=$servername; dbname=kishani",
		$username, $password
	);
	
$conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>