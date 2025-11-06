<?php
require 'admin/dbcon.php';
session_start();

if (!isset($_SESSION['voters_id'])) {
	//header("location:index.php");
} else {
	$session_id = $_SESSION['voters_id'];
	$user_query = $conn->query("SELECT * FROM voters WHERE voters_id = '$session_id'") or die(mysqli_errno($conn));
	$user_row = $user_query->fetch_array();
	// var_dump($user_row);
	$user_username = $user_row['firstname'] . " " . $user_row['lastname'];
}
