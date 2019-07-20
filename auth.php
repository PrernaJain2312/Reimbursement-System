<?php
include('session.php'); 

if(($_SESSION['login_user']!= "Admin") || (!isset($_SESSION['login_user'])) ){ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>