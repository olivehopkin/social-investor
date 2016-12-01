<!DOCTYPE HTML>
<html>
<!-- Page Header  -->
<head>
<title>Social Investor - Start a goal</title>
<?php
require_once ("classes/InvestmentAllocation.php");
require_once ("classes/Member.php");
require_once ("classes/InvestmentGoal.php");
require_once ("classes/InvestmentPortfolio.php");
require_once 'session_config.php';
require_once ('dbconnection.php');

$msg = 'How much do you need and by when?';

if ( !empty( $_POST ['goal_desc'] ) && ! empty ( $_POST ['saving_target'] )  
		&& ! empty ( $_POST ['contribution_amount'] )&& ! empty ( $_POST ['time_horizon'] )) {

	$investmentGoal = $_SESSION ['goalApp'];
	$investmentGoal->updateAdditionalDetails( $_POST ['goal_desc'], $_POST ['saving_target'], $_POST ['time_horizon'] );
	
	// get risk level for logged in member
	$riskLevel = $_SESSION ['loggedInMember']->riskLevel;
	
	// calculate allocation
	$allocationLevel = ($riskLevel + $_POST ['time_horizon']) - 1;
	
	$investmentAllocation = new InvestmentAllocation($allocationLevel);	
	if(!$investmentAllocation->load($db)) {
		$msg = 'Fatal error: Allocation unavailable for risk profile';		
	}
	
	// Create Portfolio
	$portfolio = new InvestmentPortfolio();
	$portfolio->updateContributionAmount( $_POST ['contribution_amount']);
	
	// Add allocation to portfolio
	$portfolio->addAllocation($investmentAllocation);
	$investmentGoal->addInvestmentPortfolio($portfolio);
	
	// Successfully completed the first stage of investment goal creation - forward to additional details page
	header ( 'Location: start_goal_3.php' );
	exit ();
} 
 
 
// Header script
require_once "header.php";

?>


<div class="subtitle">
	<span class="left_line1"> </span>Define your goal<span class="right_line1"></span>
</div>
<p class="preamble_message"><?php echo $msg; ?></p>
<div class="form_container">
	<form name="goalDetails1" method="post" action="start_goal_2.php"
		onsubmit="return validateLoginForm()">
		<div class="form_text">Why are you saving for this goal?</div>
		<div>
			<textarea name="goal_desc" placeholder="Describe your goal..." type="text"
				maxlength="750"></textarea>
		</div>
		<div class="clear"></div>
		<!-- TODO: Need to convert the numbers or implement it into decimals -->
		<div class="form_text">How much do you want to save?</div>
		<div>
			<input name="saving_target" type="number" step="0.01" placeholder="&pound">
		</div>
		<div class="clear"></div>
		<div class="form_text">How much have you saved?</div>
		<div>
			<input name="contribution_amount" type="number" step="0.01" placeholder="&pound">
		</div>
		<div class="clear"></div>
		<div class="form_text">How long do you want to save for?</div>
		<div>
			<input type="range" name="time_horizon" min="1" max="3" value="1">
		</div>
		<div>
			<div class="time_horizon_1_of_3 txt-lt">Short<br>(1-3yrs)</div>
			<div class="time_horizon_1_of_3 txt-center">Medium<br>(4-10yrs)</div>
			<div class="time_horizon_1_of_3 txt-rt">Long<br>(10+yrs)</div>
		</div>
		<div class="clear"></div>
		<div>
			<input type="submit" class="button" value="Continue">
		</div>
	</form>
</div>


<?php require_once "footer.php"; ?>