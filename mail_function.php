<?php	
	function sendOTP($email,$otp) {

		require('phpmailer.php');
		require('smtp.php');
		require('Exception.php');

		// require('phpmailer/class.smtp.php');
		// require_once("./phpmailer.php");
		
	
		$message_body = "One Time Password for PHP login authentication is:<br/><br/>" . $otp;
		$mail = new PHPMailer\PHPMailer\PHPMailer();
	


	
$mail->SMTPDebug = 2;                              // Enable verbose debug output
     $mail->Port = '587';
// $mail->Port ='25';
      $mail->isSMTP();                                      // Set mailer to use SMTP // Specify main and backup SMTP servers              
                        // Set mailer to use SMTP
     // $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
     $mail->Host = gethostbyname('smtp.gmail.com');

// $mail->SMTPAuth = false;
// $mail->SMTPSecure = 'ssl';
      $mail->SMTPAuth = true; // Authentication must be disabled
      $mail->Username = 'hariharan0907@gmail.com';
      $mail->Password = 'liveandletlive';
      $mail->SMTPSecure= 'tls';
      $mail->Mailer = 'smtp'; 
    
		$mail->SetFrom('hariharan0907@gmail.com','hari');
		$mail->AddAddress($email);
		$mail->Subject = 'OTP to Login';
		$mail->MsgHTML($message_body);
		$mail->IsHTML(true);		
		$result = $mail->Send();
		
		return $result;
	}
?>