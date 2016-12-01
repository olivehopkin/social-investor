<?php 
	function phpMail($to, $subject, $msg, $from) {
		// print_r(error_get_last());
	
		$mail = new PHPMailer();
	
		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = "smtp.mail.me.com";  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = "olivehopkin@icloud.com";  // SMTP username
		$mail->Password = "Southwarkengland18"; // SMTP password
		$mail->Port = 587;
		$mail-> SMTPSecure = "tls";
	
		$mail->From = "olivehopkin@icloud.com";
		$mail->FromName = "Mailer";
		$mail->AddAddress($to);
		$mail->AddReplyTo("olivehopkin@icloud.com", "Mailer");
	
		$mail->WordWrap = 50;                                 // set word wrap to 50 characters
		                                // set email format to HTML
	
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail->AltBody = $msg;
	
		if(!$mail->Send())
		{
			echo "Message could not be sent. <p>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			exit;
		}
	
	}
	
?>