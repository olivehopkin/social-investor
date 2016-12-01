<!DOCTYPE HTML>
<html>
<!-- Page Header  -->
<head>
<title>The Definitive Place To Save Socially</title>
<?php
// Header script
require_once "header.php";
require_once 'classes/InvestmentGoal.php';
require_once 'dbconnection.php';


$investmentGoal = new InvestmentGoal ( 2 );
$investmentGoal->load ( $db );
?>
	<div class="table_row border">
		<div class="left_col">
			<a href="article.php?articleId=1"><img src="images/user.svg" alt=""></a>
		</div>
		<div class="col_1_of_2">
			<div class="article-summary">
				<h3>
					<a href="register.php">Community</a>
				</h3>
				<p>
				
				
				<p>Join a like-minded community who are there to motivate you and
					inspire you towards your financial goal in life</p>
				<div>
					<a class="button" href="register.php">Register here</a>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="clear"></div>
	<div class="table_row border">
		<div class="left_col">
			<a href="start_goal_1.php"><img src="images/pie_chart.png"
				alt=""></a>
		</div>
		<div class="col_1_of_2">
			<div class="article-summary">
				<h3>
					<a href="article.php?articleId=1">Financial Goals</a>
				</h3>
				<p>
				
				
				<p>Take charge of your financial goals and make them a reality</p>
				<div>
					<a class="button" href="start_goal_1.php">Start a goal</a>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="table_row border">
		<div class="left_col">
			<a href="financial_goal.php"><img src="images/car.png"
				alt=""></a>
		</div>
		<div class="col_1_of_2">
			<div class="article-summary">
				<h3>
					<a href="financial_goal.php?goalId=<?php echo $investmentGoal->investmentGoalId?>">Investment Goals We Love: <br><?php echo $investmentGoal->goalCategory?></a>
				</h3>
				<p>
				
	
				<p><?php echo $investmentGoal->title?></p>
				<div>
					<a class="button" href="financial_goal.php?goalId=<?php echo $investmentGoal->investmentGoalId?>">Check it out</a>
				</div>
			</div>
		</div>
	</div>

	<?php require_once "footer.php"; ?>