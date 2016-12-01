<!DOCTYPE HTML>
<html>
<!-- Page Header  -->
<head>
<title>The Definitive Place To Save Socially</title>
<?php
require_once ("classes/InvestmentAllocation.php");
require_once ("classes/InvestmentGoal.php");
require_once ("classes/InvestmentPortfolio.php");
require_once ('constants.php');
require_once 'session_config.php';
require_once ('dbconnection.php');

$investmentGoalId = -1;
$investmentGoal = NULL;
// check to see if there is anything in the GET method
if (isset ( $_GET ['goalId'] )) {
	$investmentGoalId = $_GET ['goalId'];
	// passed in from the previous page
	$goalId = mysqli_real_escape_string ( $db, $_GET ['goalId'] );
	$investmentGoal = new InvestmentGoal ( $goalId );
	$investmentGoal->load ( $db );
	$goalImage = $GOAL_TYPES_TO_IMAGES [$investmentGoal->goalCategory];
} else {
	echo "No goal ID provided in Get parameters";
}

// Header script
require_once "header.php";
?>
	<div id="feature" class="txt-center">
	<h1><?php echo $investmentGoal->title?></h1>
	<p>By <?php echo $investmentGoal->member->fName?></p>
</div>
<div class="goal_section_left column1 border">
	<h2><?php echo $investmentGoal->goalCategory?></h2>
	<div class="clear"></div>
	<div class="goal_profile_photo">
		<img src="images/<?php echo $goalImage?>" alt=""></a>
	</div>
	<div class="clear"></div>
	<div class="desc">
		<div class="clear"></div>
		<p><?php echo $investmentGoal->investmentDescription?></p>
	</div>
</div>
<div class="goal_section column2 border">
	<h2>Investment Details</h2>
	<div class="clear"></div>
	<div class="col_1_of_2 left_small_col">

		<img
			src="images/portfolio_<?php echo $investmentGoal->investmentPortfolio->investmentAllocation->allocationRiskLevel?>.png"
			alt="pie chart">
	</div>

	<!-- Investment information -->
	<div class="col_1_of_2">
		<p>
			<b>Risk Level: </b><?php echo $investmentGoal->member->getRiskLevel()?>
			</p>
		<p>
			<b>Time Horizon: </b><?php echo $investmentGoal->getTimeHorizon()?>
			</p>
			<?php
			$percentTowardsGoal = round ( $investmentGoal->percentTowardsGoal (), 0, PHP_ROUND_HALF_UP );
			;
			?>			
			<input type="range" id="myRange"
			value="<?php echo $percentTowardsGoal?>"> <br> <br>
		<p><?php echo $percentTowardsGoal?>% towards goal</p>
	</div>
</div>


<!-- Similar goals -->
<div class="goal_section column2 border">
<h2>Similar goals</h2>

<!--  SQL to display similar goals from db -->
<?php 

$goalQuery = "select m.fName, m.lName, ig.goalName, ig.investmentGoalId from Member m, InvestmentGoal ig where m.username = ig.username and ig.goalCategory = '$investmentGoal->goalCategory' and ig.investmentGoalId != $investmentGoalId LIMIT 3";

// Perform the query
$result = $db->query ( $goalQuery );

if ($result->num_rows > 0) {
	// output data of each row
	while ( $row = $result->fetch_assoc () ) {
		
		$fName = $row ["fName"];
		$lName = $row ["lName"];
		$goalName = $row ["goalName"];
		$similarInvestmentGoalId = $row ["investmentGoalId"];
		
		echo
		"<div class=\"clear\"></div>
		<div class=\"center width70\">
			<div class=\"col_1_of_3\">
				<img class=\"float-lt\" alt=\"$fName\" src=\"images/no-avatar.png\" height='30' width='30' />
			</div>
			<div class=\"col_1_of_3\">$fName $lName</div>
			<div class=\"col_1_of_3\"><a href=\"financial_goal.php?goalId=$similarInvestmentGoalId\">$goalName</a></div>
		</div>";
	}
}
else {
	echo "<div class=\"center width70\">There are no similar goals on Social Investor</div>";
}

?>
</div>
<div class="clear"></div>
	
<?php

$msg = 'Share your experience and advice about how to reach a goal';


// Check to see if the post method contains any values
if (isset ( $_POST ['commentBox'] )) {
	
	// Check to see if there is a user in the session
	if (isset ( $_SESSION ['loggedInMember'] )) {
		
		// Passed in by the user entry
		$comment = mysqli_real_escape_string ( $db, $_POST ['commentBox'] );
		
		// Comment time/date is now
		$now = new DateTime ();
		$commentDate = $now->format ( 'Y-m-d H:i:s' );
		
		$member = $_SESSION ['loggedInMember'];
		$username = $member->username;
		
		// db query
		$commentInsert = "INSERT into Comment (commentText, commentDateTime, username, investmentGoalId)
		values ('$comment', '$commentDate', '$username', '$investmentGoalId')";
		
		// Perform insert query
		$result = $db->query ( $commentInsert );
		
		if (! $result) {
			// Database query error
			$msg = "SQL Error: " . $db->error;
		}
	} else {
		// Entered here if the user is not logged in
		$msg = 'Please sign in to comment';
	}
}

?>
	
<!-- Comment section -->
<div class="subtitle">
	<span class="left_line1"> </span>Leave a comment<span
		class="right_line1"></span>
</div>
<p class="preamble_message"><?php echo $msg;?>
</p>

<!-- Holds comment box -->

<div class="form_container">
	<form name="commentForm" method="post">
		<div>
			<textarea name="commentBox" class="text"
				placeholder="Join the discussion..."></textarea>
		</div>
		<div class="clear"></div>
		<div>
			<input type="submit" class="button" value="Submit">
		</div>
		<div class="clear"></div>
	</form>
</div>

<!--  SQL to display comments from db -->
<?php

$commentQuery = "SELECT m.fName, m.lName, c.commentText, c.commentDateTime from Comment c, InvestmentGoal ig, Member m where c.investmentGoalId = ig.investmentGoalId and ig.investmentGoalId = $investmentGoalId and m.username = c.username";

// Perform the query
$result = $db->query ( $commentQuery );

if ($result->num_rows > 0) {
	// output data of each row
	while ( $row = $result->fetch_assoc () ) {
		$fName = $row ["fName"];
		$lName = $row ["lName"];
		$commentText = $row ["commentText"];
		$commentDateTime = new DateTime ( $row ["commentDateTime"] );
		$commentDateString = $commentDateTime->format ( "F j, Y \A\T h:i A" );
		
		echo "<div class=\"commments_container\">
	<div class=\"comment\">
		<div class=\"comment-author\">		
			<a href=\"https://css-tricks.com/forums/users/chrisburton/\"
				title=\"$fName $lName\" class=\"bbp-author-avatar\"
				rel=\"nofollow\"><img alt=\"$fName $lName\"
				src=\"images/no-avatar.png\"
				height='160' width='160' /></a>
		</div>
		<!-- .comment-author -->
		<div class=\"comment-content\">
			<div class=\"author-name\">
				<span class=\"author-name\" rel=\"nofollow\">$fName $lName</span>
			</div>
			<div class=\"comment-date\">
				$commentDateString
			</div>
			<p>
				$commentText
			</p>
		</div>
		<!-- .comment-content -->
	</div>
	<!-- .comment -->
</div>";
	}
} else {
	// There are no comments for this investment goal
}
?>

<?php require_once "footer.php"; ?>
			<?php require_once "footer.php"; ?>