

<?php
// Session config, db connection & header scripts loaded on every page
require_once 'classes/Member.php';
require_once 'session_config.php';
require_once ('dbconnection.php');
require_once 'constants.php';

require_once "header.php";
?>
<!DOCTYPE HTML>
<html>
<!-- Page Header  -->
<head>
<title>Social Investor - Investment Goal Results: <?php echo $goalCategory?></title>

<div class="results">
<?php
$goalImage = '';

// SQL query to retrieve commentCount on investmentGoal
if (isset ( $_GET ['category'] )) {
	$goalCategory = $_GET ['category'];
	if (! empty ( $goalCategory ) && $goalCategory != '') {
		
		if ($goalCategory == 'myGoals') {
			$username = $_SESSION['loggedInMember']->username;
			$investmentGoalResultsQuery = "select ig.investmentGoalId,  ig.goalCategory,  ig.goalName, ig.investmentDescription, count(commentId) as commentCount 
from InvestmentGoal ig LEFT join Comment c on ig.investmentGoalId=c.investmentGoalId where ig.username = '$username' group by ig.investmentGoalId";		
			
		} else {
			$investmentGoalResultsQuery = "select ig.investmentGoalId,  ig.goalCategory,  ig.goalName, ig.investmentDescription, count(commentId) as commentCount 
from InvestmentGoal ig LEFT join Comment c on ig.investmentGoalId=c.investmentGoalId where ig.goalCategory = '$goalCategory' group by ig.investmentGoalId";		
			
		}
	}

}

// Perform the query
$result = $db->query ( $investmentGoalResultsQuery );

if ($result->num_rows > 0) {
	// output data of each row
	while ( $row = $result->fetch_assoc () ) {
		$goalId = $row ["investmentGoalId"];
		$goalName = $row ["goalName"];
		$investmentDescription = $row ["investmentDescription"];
		$commentCount = $row ["commentCount"];
		$goalCategory = $row ["goalCategory"];
		$goalImage = 'images/' . $GOAL_TYPES_TO_IMAGES [$goalCategory];
		
		// displays list of investment goals
		echo "
		  <div class=\"table_row\">
		  	<div class=\"results_col_1\">
				<a href=\"financial_goal.php?goalId=$goalId\"><img src=\"$goalImage\" alt=\"\"></a>
				<div class=\"article-summary-info\">
					<ul>
						<li><i class=\"comment-count\"> </i><a href=\"#\"><span> </span>$commentCount Comments</a></li>
					</ul>
			    </div>
			</div>
		    <div class=\"results_col_2 \">
		    	<div class=\"article-summary\">
					<h3><a href=\"financial_goal.php?goalId=$goalId\">$goalName</a></h3>
					<p>$investmentDescription...</p>
					<div><a class=\"button\" href=\"financial_goal.php?goalId=$goalId\">View Goal</a></div>
				</div>
			</div>
		</div>
		<div class=\"clear\">
		</div>
		<hr>";
	}
} else {
	// There are no comments for this article
	// echo "0 results";
}
?>
</div>
<?php require_once "footer.php"; ?>