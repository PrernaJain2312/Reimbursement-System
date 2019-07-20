<?php
include 'mysqli_connect.php';
include('auth.php');

$id=$_REQUEST['id'];
$query = "update bills set status='Rejected' where bill_id='".$id."'"; 
$result = mysqli_query($dbc, $query) or die ( mysqli_error());
header("Location: admin.php"); 
?>