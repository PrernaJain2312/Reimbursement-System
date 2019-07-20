<?php
session_start();

if(isset($_SESSION['login_user']) && $_SESSION['login_user']== "Admin" ){
    header("location: admin.php"); // Redirecting To Admin Panel Page 
}
if(isset($_SESSION['login_user']) && $_SESSION['login_user']!= "Admin"){
    header("location: home.php"); // Redirecting To Profile Page
}

?>
<?php
include 'mysqli_connect.php';
session_start(); // Starting Session 
date_default_timezone_set(Asia/Kolkata);
$success = "";
$error = ''; // Variable To Store Error Message
if(!empty($_POST["submit_email"])) {
    $username = $_POST['username']; 
    $email = $_POST['email']; 
    $inputEmail = "SELECT * FROM login WHERE (username='".$username."' AND email='".$email."') ";
    $result = mysqli_query($dbc,$inputEmail);
    $count  = mysqli_num_rows($result);
        if($count>0) {
        // generate OTP
            $otp = rand(100000,999999);
            // Send OTP
            require_once("mail_function.php");
            $mail_status = sendOTP($email,$otp);
            if($mail_status == 1) {
                $query = "INSERT INTO otp_expiry(id,username,otp,is_expired,create_at) VALUES (NULL, '" . $username . "', '" . $otp . "', 0, '" . date("Y-m-d H:i:s"). "')";
                $result = mysqli_query($dbc, $query);
                $current_id = mysqli_insert_id($dbc);
                if(!empty($current_id)) {
                        $success=1;
                }
            }   
        } else {
            $error_message = "Email does not exists!";
        }
}
if(!empty($_POST["submit_otp"])) {
    $result = mysqli_query($dbc,"SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)");
    $count  = mysqli_num_rows($result);
    if(!empty($count)) { 
        $result1 = mysqli_query($dbc,"UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'");
        while($row1 = mysqli_fetch_array($result)){
            echo 'cdscsdc';
            $_SESSION['login_user'] = $row1["username"];
            header("location: home.php");
        }
    } else {
        $success =1;
        $error_message = "Invalid OTP!";
    }	
}
?>

<html>
<head>
<title>User Login</title>
<style>
body{
	font-family: calibri;
}
.tblLogin {
    border: #95bee6 1px solid;
    background: #337ab7;
    border-radius: 4px;
    max-width: 300px;
    height: 300px;
    padding:20px 30px 30px;
    text-align:center;
    margin: auto;
}
.tableheader { 
    font-size: 40px;
    color: white;
    padding-top: 3%
}
.tablerow { padding:40px 20px 10px 20px; }
.error_message {
    margin: auto;
    color: #641C1C;
    background: #ffb5b5;
    border: #c76969 1px solid;
    text-align: center;
}
.message {
    width: 100%;
    max-width: 300px;
    padding: 10px 30px;
    border-radius: 4px;
    margin-bottom: 5px;    
}
.login-input {
    border: #CCC 1px solid;
    padding: 10px 20px;
    border-radius:4px;
    width: 220px;
}
.btnSubmit {
    padding: 10px 20px;
    background: white;
    border: #d1e8ff 1px solid;
    color: black;
    border-radius:4px;
    margin-top: 12%;
    border-color: navy;
}
</style>
</head>
<body>
    <div style=" background-color: #337ab7; height: 30%">
        <p style="text-align: center; font-size: 50px; color: white; padding-top: 5%">
            SSPL BILL REIMBURSEMENT SYSTEM
        </p>
    </div><hr>
    <div style=" background-color: #F9F9F9; height: 63%; padding-top: 2%">
	<?php
		if(!empty($error_message)) {
	?>
	<div class="message error_message"><?php echo $error_message; ?></div>
	<?php
		}
	?>

        <form name="frmUser" method="post" action="">
                <div class="tblLogin">
                        <?php 
                                if(!empty($success == 1)) { 
                        ?>
                        <div class="tableheader">Enter OTP</div>
                        <p style="color:black; font-size: 20px">**Check your email for the OTP**</p>

                        <div class="tablerow">
                                <input type="text" name="otp" placeholder="One Time Password" class="login-input" required>
                        </div>
                        <div class="tableheader"><input type="submit" name="submit_otp" value="Submit" class="btnSubmit"></div>
                        <?php
                                }
                                else {
                        ?>

                        <div class="tableheader">Login</div>
                        <div class="tablerow"><input class="login-input" name="username" placeholder="Username" type="text" required></div>
                        <div class="tablerow"><input type="text" name="email" placeholder="Email" class="login-input" required></div>
                        <div class="tableheader"><input type="submit" name="submit_email" value="Submit" class="btnSubmit"></div>
                        <?php 
                                }
                        ?>
                </div>
        </form>
    </div>
</body>
</html>