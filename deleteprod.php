<?php
	include 'db.php';
	session_start();
	if (!isset($_SESSION['userId'])) {
		header("location: login.php");
	}
	
	$id = $_GET['id'];

	$del = mysqli_query($con, "DELETE FROM products WHERE ProductID=$id");
	
	if ($del) {
		header("location: myproducts.php");
	}
?>