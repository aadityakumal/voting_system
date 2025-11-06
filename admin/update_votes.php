<?php
include('dbcon.php');
if (isset($_POST['done'])) {
    $voters_id = $_GET['voter_id'];
    $id_number = $_POST['id_number'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $account = $_POST['account'];
    mysqli_query($conn, "UPDATE voters SET id_number = '$id_number', password = '$password', firstname = '$firstname', lastname = '$lastname', 
account = '$account' WHERE voters_id = '$voters_id'") or die(mysqli_error($conn));
}
header("location: voters.php");
