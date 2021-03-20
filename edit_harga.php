<?php
 
$servername = "178.128.208.156";
//$servername = "localhost";
$username = "rizkyaddon";
$password = "Jakarta123!";
$dbname = "mede_mama";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$new_harga = $_POST['harga'];

$sql = "UPDATE product SET price=".$new_harga." WHERE id=" . $id;

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>