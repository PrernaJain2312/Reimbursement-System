<?php
include('login.php'); // Includes Login Script
if(isset($_SESSION['login_user']) && $_SESSION['login_user']== "Admin" ){
    header("location: admin.php"); // Redirecting To Admin Panel Page 
}

if(isset($_SESSION['login_user']) && $_SESSION['login_user']!= "Admin"){
    header("location: home.php"); // Redirecting To Profile Page
}
?> 
<!DOCTYPE html>
<html>
<head>
  <title>Login Form in PHP with Session</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
 <div id="login">
  <h2>Login Form</h2>
  <form action="" method="post">
   <label>UserName :</label>
   <input id="name" name="username" placeholder="username" type="text">
   <label>Password :</label>
   <input id="password" name="password" placeholder="**********" type="password"><br><br>
   <input name="submit" type="submit" value=" Login ">
   <span><?php echo $error; ?></span>
  </form>
 </div>
</body>
</html>