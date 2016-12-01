<!DOCTYPE HTML>
<html>
<!-- Page Header  -->
<head>
<title>Social Investor - Register</title>
<?php
require ("lib/PHPMailer_5.2.0/class.phpmailer.php");
require ("email.php");
require ("classes/MembershipApplication.php");

require_once 'session_config.php';
require_once ('dbconnection.php');


$msg = "Your own personal risk score is a method of calculating your propensity to risk";


if (isset ( $_POST ['riskLevel'] )) {
	
	$memApp = $_SESSION ['memApp'];	
	$memApp->addRiskLevel( $_POST ['riskLevel'] );
	
	//echo 'DB: ' . $db;
	
	if (!$memApp->submit($db)) {
		// Database query error
		$msg = "SQL Error: " . $db->error;		
	}
	else {
		// Successfully completed the first stage of regristratiohn - forward to the risk score page
		header ( 'Location: register_confirmation.php' );
		exit ();
	}
}

require_once "header.php";
?>

<div class="subtitle">
	<span class="left_line1"> </span>Risk Appetite<span class="right_line1">
	</span>
</div>

<!--  Create script to upload data to database -->
<p class="preamble_message"><?php echo $msg; ?> </p>
<div class="form_container">
	<!-- Needs entering and correct parameters put in -->
	<form name="registrationForm" method="post" action="register_2.php"
		onsubmit="returnvalidateRegistrationForm()">
		<div class="clear"></div>
		<div>
			<input type="range" name="riskLevel" id="time_horizon" min="1" max="3" value="1">
		</div>
		<div>
		<!-- need to create a div that holds brief explanation about what each individual risk score means -->
			<div class="time_horizon_1_of_3 txt-lt">
				Low-risk<br>
			</div>
			<div class="time_horizon_1_of_3 txt-center">
				Medium-risk<br>
			</div>
			<div class="time_horizon_1_of_3 txt-rt">
				High-risk<br>
			</div>
		</div>
		<div class="clear"></div>
		<div>
			<input type="submit" class="button" value="Complete">
		</div>
	</form>
</div>











<?php require_once "footer.php"; ?>
