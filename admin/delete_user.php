<?php
	require_once 'dbcon.php';
	$user_id=$_GET['user_id'];
	$conn->query("DELETE FROM user WHERE user_id='$user_id'") or die(mysqli_error($conn));
	header('location:user.php');
?>