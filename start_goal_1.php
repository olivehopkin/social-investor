<!DOCTYPE HTML>
<html>
<!-- Page Header  -->
<head>
<title>Social Investor - Start a goal</title>
<?php
require_once ("classes/InvestmentGoal.php");
require_once 'session_config.php';
require_once ('dbconnection.php');

$msg = 'What are you saving for?';

if (! empty ( $_POST ['goal_category'] ) && ! empty ( $_POST ['goal_name'] )) {
	
	$investmentGoal = new InvestmentGoal ();
	$investmentGoal->updateBasicDetails ( $_POST ['goal_category'], $_POST ['goal_name'] );
	$investmentGoal->setMember($_SESSION['loggedInMember']);
	// TODO: check if user has existing goal with same goal_name
	$_SESSION ['goalApp'] = $investmentGoal;
	
	$myOwnSession['loggedInMember'] = 'blah';
	
	// Successfully completed the first stage of investment goal creation - forward to additional details page
	header ( 'Location: start_goal_2.php' );
	exit ();
}

// Header script
require_once "header.php";
?>


<div class="subtitle">
	<span class="left_line1"> </span>Let's get started<span
		class="right_line1"></span>
</div>
<p class="preamble_message"><?php echo $msg; ?></p>

<div class="form_container">
	<form name="goalDetails1" method="post" action="start_goal_1.php"
		onsubmit="return validateLoginForm()">
		<div class="form_text">Choose a category:</div>
		<div>
			<select name="goal_category" id>
				<option value="Car">Car</option>
				<option value="Children">Children</option>
				<option value="Education">Education</option>
				<option value="Emergencies">Emergencies</option>
				<option value="Debt">Debt</option>
				<option value="Holiday">Holiday</option>
				<option value="House">House</option>
				<option value="Pets">Pets</option>
				<option value="Retirement">Retirement</option>
				<option value="Wedding">Wedding</option>
			</select>
		</div>
		<div class="clear"></div>
		<div class="form_text">Give your investment goal a title:</div>
		<div>
			<input name="goal_name" placeholder="Name your goal..." type="text" />
		</div>
		<div class="clear"></div>
		<div>
			<input type="submit" class="button" value="Continue">
		</div>
	</form>
</div>


	<?php require_once "footer.php"; ?>