<?php	
	function sendOTP($email,$otp) {
		require('phpmailer/phpmailer/class.phpmailer.php');
		require('phpmailer/phpmailer/class.smtp.php');
	
		$mail = new PHPMailer(TRUE);
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = 'ssl'; // tls or ssl
		$mail->Port     = "465";
		$mail->Username = "prernajain2312@gmail.com";
		$mail->Password = "always keep smiling";
		$mail->Host     = "smtp.gmail.com";
		$mail->Mailer   = "smtp";
                
		$mail->SetFrom("prernajain2312@gmail.com", "Prerna JAin");
		$mail->AddAddress($email);
               
                $mail->IsHTML(true);	
                
		$mail->Subject = "OTP to Login";
                $message_body = "One Time Password for PHP login authentication is:<br/><br/>" . $otp;
		$mail->Body = $message_body;
			
		$result = $mail->Send();
		
		return $result;
	}
?>