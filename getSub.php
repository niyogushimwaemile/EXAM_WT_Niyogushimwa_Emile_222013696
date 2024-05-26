<?php
	include 'db.php';
	session_start();
	if (!isset($_SESSION['userId'])) {
		header("location: login.php");
	}
	$id = $_SESSION['userId'];

	$day = date('d');
	$month = date('m');
	$year = date('Y');

	$today = $year."-".$month."-".$day;

	$time = $_GET['time'];
	$type = $_GET['type'];

	$row=null;
	$sel=null;
	if ($type == "subs") {
	
		if ($time == 'Today') {
			$sel = mysqli_query($con, "SELECT day(StartDate) as start FROM subscriptions sub JOIN products prod ON sub.productID=prod.productID WHERE prod.vendor_id=$id AND StartDate='$today'");
			$row = mysqli_fetch_array($sel);
		}
		else if ($time == 'This Month') {
			$sel = mysqli_query($con, "SELECT month(StartDate) as start FROM subscriptions sub JOIN products prod ON sub.productID=prod.productID WHERE prod.vendor_id=$id AND month(StartDate)='$month' AND year(StartDate)='$year'");
			$row = mysqli_fetch_array($sel);
		}
		else if ($time == 'This Year') {
			$sel = mysqli_query($con, "SELECT year(StartDate) as start FROM subscriptions sub JOIN products prod ON sub.productID=prod.productID WHERE prod.vendor_id=$id AND year(StartDate)='$year'");
			$row = mysqli_fetch_array($sel);
		}
		echo(mysqli_num_rows($sel));
	}
	
	elseif ($type == "customers") {
		
		if ($time == 'Today') {
			$sel = mysqli_query($con, "SELECT * FROM customer WHERE registerDate='$today'");
			$row = mysqli_fetch_array($sel);
		}
		else if ($time == 'This Month') {
			$sel = mysqli_query($con, "SELECT * FROM customer WHERE year(registerDate)='$year' AND month(registerDate)='$month'");
			$row = mysqli_fetch_array($sel);
		}
		else if ($time == 'This Year') {
			$sel = mysqli_query($con, "SELECT * FROM customer WHERE year(registerDate)='$year' ");
			$row = mysqli_fetch_array($sel);
		}
		echo(mysqli_num_rows($sel));
	}
	 
     
     
     // echo $today;
?>