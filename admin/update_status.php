<?php 
	require_once 'dbcon.php';						
	$conn->query("UPDATE voters SET account = 'Active'")or die(mysqli_error($conn));
	echo "<script> window.location='voters.php' </script>";
?>			