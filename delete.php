<?php
include 'mysqli_connect.php';
include('auth.php');

$id=$_REQUEST['id'];
$query = "DELETE FROM login WHERE id=$id"; 
$result = mysqli_query($dbc,$query) or die ( mysqli_error());
header("Location: admin.php"); 
?>