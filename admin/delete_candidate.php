<?php
	require_once 'dbcon.php';
	$candidate_id=$_GET['candidate_id'];
	$conn->query("delete from candidate where candidate_id='$candidate_id'") or die(mysqli_error($conn));
	header('location:candidate.php');
?>