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


$msg = "Track your financial goals all in one place, and work with others to make them become a reality";

if (isset ( $_POST ['fName'] ) && ! empty ( $_POST ['email'] ) && 
		! empty ( $_POST ['password'] ) && ! empty ( $_POST ['dateOfBirth'] )) {
	
	$memApp = new MembershipApplication ();	
	$memApp->addMemberPersonalData ( $_POST ['fName'], $_POST ['lName'],
			$_POST ['dateOfBirth'], $_POST ['email'], $_POST ['password'] );
		
	if ($memApp->usernameAlreadyExists($db)) {		
		$msg = "This username exists, please use a different one";
	} 
	else {
		$_SESSION ['memApp'] = $memApp;
		// Successfully completed the first stage of regristratiohn - forward to the risk score page
		header ( 'Location: register_2.php' );
		exit ();
	}
}
// ******************* close connection ****************************/

require_once "header.php";
?>
<script>

/*Function to validate every field in the registration form*/
function validateRegistrationForm() {
	console.log("validateRegistrationForm");
	return validateInputContentByName("registrationForm", "fName", "First Name") && 
		validateInputContentByName("registrationForm", "lName", "Last Name") &&
		validateEmail("registrationForm", "email") && 
		validateInputContentByName("registrationForm", "password", "Password") && 
		validateInputContentByName("registrationForm", "dateOfBirth", "Date of Birth");		
}


</script>

<div class="subtitle">
	<span class="left_line1"> </span>Register<span class="right_line1"> </span>
</div>

<!--  Create script to upload data to database -->
<p class="preamble_message"><?php echo $msg; ?> </p>
<div class="form_container">

	<form name="registrationForm" method="post" action="register.php"
		onsubmit="return validateRegistrationForm()">
		<div>
			<input type="text" class="text" name="fName" placeholder="First Name">
		</div>
		<div class="clear"></div>
		<div>
			<input type="text" class="text" name="lName" placeholder="Last Name">
		</div>
		<div class="clear"></div>
		<div>
			<input type="text" class="text" name="email" required placeholder="Email & Username"
			value"Email & Username"
					onfocus="toggleInputTypeValueOnFocus(this, 'text', '')\"
					onblur="validateInputContent(this, 'Email & Username'); toggleInputTypeValueOnBlur(this, 'text', 'Email & Username')">
		</div>
		<div class="clear"></div>
		<div>
			<input type="password" name="password" placeholder="Password">
		</div>
		<div class="clear"></div>
		<div>
			<input type="date" class="text" name="dateOfBirth" placeholder="Date of Birth">
			<div class="clear"></div>
			<br>To sign up, you must be 18 years or older.</br>
		</div>
		<div class="clear"></div>
		<div>
			<input type="submit" class="button" value="Continue">
		</div>
	</form>

</div>
<?php require_once "footer.php"; ?>