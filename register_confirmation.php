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

require_once "header.php";
	
$memApp = $_SESSION ['memApp'];	
?>

<div class="subtitle">
	<span class="left_line1"> </span>Confirmation<span class="right_line1">
	</span>
</div>

<!--  Create script to upload data to database -->
<p class="preamble_message">Congratulations, you're now part of Social Investor</p>
<div class="form_container">
	<div class="details_list_row">
		<span class="label">First Name:</span><span class="value"><?php echo $memApp->fName;?></span>
	</div>
	<div class="clear"></div>
	<div class="details_list_row">
		<span class="label">Last Name:</span><span class="value"><?php echo $memApp->lName;?></span>
	</div>
	<div class="clear"></div>
	<div class="details_list_row">
		<span class="label">Username/Email:</span><span class="value"><?php echo $memApp->username;?></span>
	</div>
	<div class="clear"></div>
	<div class="details_list_row">
		<span class="label">Date of Birth:</span><span class="value"><?php echo $memApp->dateOfBirth;?></span>
	</div>
	<div class="clear"></div>
	<div class="details_list_row">
		<span class="label">Risk Appetite:</span><span class="value"><?php echo $memApp->riskLevel;?></span>
	</div>
</div>











<?php require_once "footer.php"; ?>
