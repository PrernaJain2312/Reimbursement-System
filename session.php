<?php

include 'mysqli_connect.php';

session_start();// Starting Session 
// Storing Session 
$user_check = $_SESSION['login_user']; 
// SQL Query To Fetch Complete Information Of User 
$query = "SELECT username from login where username = '$user_check'"; 
$ses_sql = mysqli_query($dbc, $query); 
$row = mysqli_fetch_assoc($ses_sql); 
$login_session = $row['username'];
?>