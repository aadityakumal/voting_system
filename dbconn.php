<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting";

// $conn = new mysqli('localhost', 'root', '', 'voting');

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo "connection failed";
} else {
}
