<?php
include('dbcon.php');
$voters_id = $_GET['voters_id'];
mysqli_query($conn, "delete from voters where voters_id='$voters_id'") or die(mysqli_error($conn));
header('location:voters.php');
