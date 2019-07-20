<?php
// Include the database configuration file
include 'mysqli_connect.php';
include('auth.php');

if(isset($_POST["submit"])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $level = $_POST['level'];

    $insert = "INSERT INTO login (id, username, email, designation, level) VALUES (NULL, '".$username."', '".$email."', '".$designation."', '".$level."')";
    $result = mysqli_query($dbc,$insert);
    if($result){
        $status = "New Record Inserted Successfully.";
        echo "<script type='text/javascript'>alert('User Created!');
            window.location='index.php';
        </script>";
        mysqli_close($dbc);

    } else {
        $status = "Error Occurred";
        echo mysqli_error();
        mysqli_close($dbc);

    }
}
?>