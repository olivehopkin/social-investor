<!DOCTYPE HTML>
<html>
<!-- Page Header  -->
<head>
<title>Social Investor - Start a goal</title>
<?php
require_once ("classes/InvestmentAllocation.php");
require_once ("classes/InvestmentGoal.php");
require_once ("classes/InvestmentPortfolio.php");
require_once 'session_config.php';
require_once ('dbconnection.php');

$msg = 'How you should invest to reach your goal';
	
$investmentGoal = $_SESSION ['goalApp'];

if (! empty ( $_POST ['confirmation'] )) {
	
	if (! $investmentGoal->save($db)) {
		// Database query error
		$msg = "SQL Error: " . $db->error;
	} else {
		// Successfully completed the first stage of investment goal creation - forward to additional details page
		header ( 'Location: financial_goal.php?goalId='.$investmentGoal->investmentGoalId);
		exit ();
	}
}
// Header script
require_once "header.php";

?>


<div class="subtitle">
	<span class="left_line1"> </span>Start a Goal<span class="right_line1"></span>
</div>
<p class="preamble_message"><?php echo $msg; ?></p>
<div id="content">
	<div class="goal_section column1 border">
		<div class="goal_info_container  txt-center">
			<p>
				<b>Contribution Amount:</b>&nbsp;&nbsp;  &pound<?php echo $investmentGoal->investmentPortfolio->contributionAmount?>
			</p>
		</div>
		<div class="clear"></div>
		<div class="goal_info_container txt-center">
			<p>
				<b>Target Amount:</b>&nbsp;&nbsp; &pound;<?php echo $investmentGoal->targetAmount?>
			</p>
		</div>
		<div class="clear"></div>
		<div class="goal_info_container txt-center">
			<p>
				<b>Time Horizon:</b>&nbsp;&nbsp;  <?php echo $investmentGoal->getTimeHorizon()?>
			</p>
		</div>
	</div>
	<div class="goal_section column2 border">
		<div class="clear"></div>
		<div class="col_1_of_2 left_small_col">

			<img src="images/portfolio_<?php echo $investmentGoal->investmentPortfolio->investmentAllocation->allocationRiskLevel?>.png" alt="pie chart">
		</div>

		<!-- Investment information -->
		<div class="col_1_of_2">
			<div class="percent_info_container txt-rt">
				<p>
					<b>Cash - <?php echo $investmentGoal->investmentPortfolio->investmentAllocation->cashPercentage?>%</b>
				</p>
			</div>
			<div class="box_colour_info_container txt-rt">
				<div class="colour_box green_standard"></div>
			</div>
			<div class="clear"></div>
			<div class="percent_info_container txt-rt">
				<p>
					<b>Fixed Income - <?php echo $investmentGoal->investmentPortfolio->investmentAllocation->fixedIncomePercentage?>%</b>
				</p>
			</div>
			<div class="box_colour_info_container txt-rt">
				<div class="colour_box green_light"></div>
			</div>
			<div class="clear"></div>
			<div class="percent_info_container txt-rt">
				<p>
					<b>Equities - <?php echo $investmentGoal->investmentPortfolio->investmentAllocation->equitiesPercentage?>%</b>
				</p>
			</div>
			<div class="box_colour_info_container txt-rt">
				<div class="colour_box green_lighter"></div>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="form_container">
	<!-- Need to edit this to reflect correct page it goes to -->
	<form name="goalDetails1" method="post" action="start_goal_3.php">
		<input type="hidden" name="confirmation" value="confirmed"> </input>
		<div>
			<input type="submit" class="button" value="Accept">
		</div>
	</form>
</div>
	<?php require_once "footer.php"; ?>