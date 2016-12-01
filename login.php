<!DOCTYPE HTML>
<html>
<!-- Page Header  --> 
<head>
<title>Social Investor - Login</title>
<?php 
require ("classes/Member.php");
require_once 'session_config.php';
require_once('dbconnection.php');
$msg = 'Please enter your username (email address) and password below';

// check to see if there is anything in the POST method
if (isset ( $_POST ['username'] ) && ! empty ( $_POST ['password'] )) {
	
	// Passed in from the user entries
	$username = $_POST ['username'];
	$passwordHash = sha1($_POST ['password']);
	//$passwordHash = $_POST ['password'];
	
	// db query 
	$userQuery = "SELECT passwordHash FROM Member where username='$username'";
	//Perform the query
	$result = $db->query($userQuery);
	 //Fetch single row as an associative array 
	if ($row = $result->fetch_assoc()) {
		$dbPassword = $row['passwordHash'];
		
		 // Check user details match
		if ($passwordHash == $dbPassword) { 
			
			// Create Member
			$member = new Member($username);
			$member->load($db);
			
			// Save Member as logged in
			$_SESSION ['loggedInMember'] = $member;
			
			 //Successfully logged in - forward to Homepage
			header ( 'Location: index.php' );
			exit();
		}
		else {
			// Entered here if the password & db password didn't match
			$msg = 'Incorrect password';
		}
	}
	else {
		 // Entered here if the query returned no data
		$msg = 'The username does not exist';
	
	}
}
else
{
	// Logout functionality -logout button actioned
	session_unset();
	session_destroy();
}


require_once 'header.php';
?>
 
 <!-- JavaScript to validate that data has been input into the required fields when submitted -->
<script>

function validateLoginForm() {
	console.log("validateLoginForm");
	return validateEmail("loginForm", "username") && 
		validateInputContentByName("loginForm", "password", "Password"); 
}

</script>


<div class="subtitle">
	<span class="left_line1"> </span>Welcome<span class="right_line1"></span>
</div>
<p class="preamble_message"><?php echo $msg; ?></p>
<!-- Login form -->
<div class="form_container">
	<form name="loginForm" method="post" action="login.php" onsubmit="return validateLoginForm()">
		<div>
			<input type="text" class="text" name="username" placeholder="Email">
		</div>
		<div>
			<div class="clear"></div>
			<input type="password" name="password" placeholder="Password">
			<div class="clear"></div>
			<div>
				<input type="submit" class="button" value="Log me in">
			</div>
		</div>
	</form>
</div>
<?php require_once "footer.php"; ?>


