<?php
require_once ('Member.php');
require_once 'classes/InvestmentPortfolio.php';

class InvestmentGoal {
	// property declaration
	public $investmentGoalId = 0;
	public $goalCategory = '';
	public $title = '';
	public $investmentDescription = '';
	public $targetAmount = 0;
	public $timeHorizon = '';
	public $investmentPortfolio = NULL;
	public $member = NULL;
	
	// private $TERM_NAMES = array(1 => 'Short-term', 2 =>)
	public function __construct($investmentGoalId) {
		$this->investmentGoalId = $investmentGoalId;
	}
	
	/*
	 * Add investment goal data
	 */
	public function updateBasicDetails($goalCategory, $title) {
		$this->goalCategory = $goalCategory;
		$this->title = $title;
	}
	
	/*
	 * Add investment goal data
	 */
	public function updateAdditionalDetails($investmentDescription, $targetAmount, $timeHorizon) {
		$this->investmentDescription = $investmentDescription;
		$this->targetAmount = $targetAmount;
		$this->timeHorizon = $timeHorizon;
	}
	
	/*
	 * Returns investment goal title
	 */
	public function getTitle($title) {
		return $this->title;
	}
	
	/*
	 * Add investment portfolio
	 */
	public function addInvestmentPortfolio($portfolio) {
		$this->investmentPortfolio = $portfolio;
	}
	
	/*
	 * Set member goal
	 */
	public function setMember($member) {
		$this->member = $member;
	}
	
	/*
	 * Get the display representation of time horizon
	 */
	public function getTimeHorizon() {
		switch ($this->timeHorizon) {
			case 1 :
				return 'Short-term';
			case 2 :
				return 'Medium-term';
			case 3 :
				return 'Long-term';
		}
		return 'Unknown Time Horizon';
	}
	
	/*
	 * Get % towards goal
	 */
	public function percentTowardsGoal() {
		return ($this->investmentPortfolio->contributionAmount / $this->targetAmount) * 100;		
	}
	
	
	/*
	 * Save investment goal to DB
	 */
	public function save($db) {
		$ipResult = $this->investmentPortfolio->save ( $db );
		
		// Passed in from the user entries
		$goalCategory = mysqli_real_escape_string ( $db, $this->goalCategory );
		$title = mysqli_real_escape_string ( $db, $this->title );
		$investmentDescription = mysqli_real_escape_string ( $db, $this->investmentDescription );
		$targetAmount = mysqli_real_escape_string ( $db, $this->targetAmount );
		$timeHorizon = mysqli_real_escape_string ( $db, $this->timeHorizon );
		
		$portfolioId = $this->investmentPortfolio->investmentPortfolioId;
		$username = $this->member->username;
		// Add new investment goal to db
		$goalInsertQuery = "INSERT into InvestmentGoal (goalCategory, goalName, investmentDescription, targetAmount, timeHorizon, username, investmentPortfolioId)
		values ('$goalCategory', '$title', '$investmentDescription', '$targetAmount', '$timeHorizon', '$username', '$portfolioId')";
		
		// Perform query
		$igResult = $db->query ( $goalInsertQuery );
		if ($igResult) {
			$selectIdQuery = "Select last_insert_id() as last_id";
			$idResult = $db->query ( $selectIdQuery );
			if ($row = $idResult->fetch_assoc ()) {
				$this->investmentGoalId = $row ['last_id'];
			}
		}
		
		return $ipResult && $igResult;
	}
	
	/*
	 * load investment goal from DB
	 */
	public function load($db) {
		// Get goal from DB
		$goalQuery = "select goalCategory, goalName, investmentDescription, targetAmount, timeHorizon, username, investmentPortfolioId from InvestmentGoal where investmentGoalId = '$this->investmentGoalId'";
		// Perform the query
		$result = $db->query ( $goalQuery );
		// Fetch single row as an associative array
		if ($row = $result->fetch_assoc ()) {
			$this->goalCategory = $row ['goalCategory'];
			$this->title = $row ['goalName'];
			$this->investmentDescription = $row ['investmentDescription'];
			$this->targetAmount = $row ['targetAmount'];
			$this->timeHorizon = $row ['timeHorizon'];
			$username = $row ['username'];
			$investmentPortfolioId = $row['investmentPortfolioId'];
			
			$this->member = new Member ( $username );
			$this->member->load ( $db );
			
			$this->investmentPortfolio= new InvestmentPortfolio( $investmentPortfolioId );
			$this->investmentPortfolio->load ( $db );
			
			return true;
		}
		
		return false;
	}
	
	/*
	 * Make a comment on investment goal
	 */
	public function createComment($db) {
		// Check to see if the post method contains any values
		if (isset ( $_POST ['commentBox'] )) {
			
			// Check to see if there is a user in the session
			if (isset ( $_SESSION ['username'] )) {
				
				// Passed in by the user entry
				$comment = mysqli_real_escape_string ( $db, $_POST ['commentBox'] );
				
				// Comment time/date is now
				$now = new DateTime ();
				$commentDate = $now->format ( 'Y-m-d H:i:s' );
				
				$username = $_SESSION ['username'];
				$articleId = $_GET ['articleId'];
				
				// db query
				$commentInsert = "INSERT into Comment (commentText, commentDateTime, username, articleId)
				values ('$comment', '$commentDate', '$username', '$articleId')";
				
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
	}
}
?>