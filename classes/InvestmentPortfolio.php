<?php
require_once 'classes/InvestmentAllocation.php';


class InvestmentPortfolio {
	// property declaration
	public $investmentPortfolioId = 0;
	public $contributionAmount = 0;
	public $cashAmount = 0;
	public $fixedIncomeAmount = 0;
	public $equityAmount = 0;
	public $investmentAllocation = NULL;


	/*
	 * constructor for portfolio
	 */
	public function __construct($investmentPortfolioId) {
		$this->investmentPortfolioId = $investmentPortfolioId;
	}
	
	
	/*
	 * Add contribution amount to portfolio
	 */
	public function updateContributionAmount($contributionAmount){
		$this->contributionAmount = $contributionAmount;
	}
	
	/*
	 * Add allocation to portfolio
	 */
	public function addAllocation($allocation){
		$this->investmentAllocation = $allocation;
	}
	
	/*
	 * Save investment portfolio to DB
	 */
	public function save($db) {
		$contributionAmount = mysqli_real_escape_string ( $db, $this->contributionAmount );
		$cashAmount = mysqli_real_escape_string ( $db, $this->cashAmount );
		$fixedIncomeAmount = mysqli_real_escape_string ( $db, $this->fixedIncomeAmount);
		$equityAmount = mysqli_real_escape_string ( $db, $this->equityAmount );		
		
		$allocationId = $this->investmentAllocation->allocationRiskLevel;
		// Add new investment portfolio to DB
		$portfolioInsertQuery = "INSERT into InvestmentPortfolio (contributionAmount, cashAmount, fixedIncomeAmount, equityAmount, investmentAllocationId)
		values ('$contributionAmount', '$cashAmount', '$fixedIncomeAmount', '$equityAmount', '$allocationId')";
		
		// Perform query
		$result = $db->query ( $portfolioInsertQuery);
		if ($result) {
			$selectIdQuery = "Select last_insert_id() as last_id";
			$idResult = $db->query ( $selectIdQuery );
			if ($row = $idResult->fetch_assoc ()) {
				$this->investmentPortfolioId = $row ['last_id'];
			}
		}
		
		return $result;		
	}
	
	/*
	 * load portfolio from DB
	 */
	public function load($db) {
		// Get portfolio from DB
		$portfolioQuery = "select contributionAmount, cashAmount, fixedIncomeAmount, equityAmount, investmentPortfolioId, investmentAllocationId from InvestmentPortfolio where investmentportfolioId= '$this->investmentPortfolioId'";
		// Perform the query
		$result = $db->query ( $portfolioQuery );
		// Fetch single row as an associative array
		if ($row = $result->fetch_assoc ()) {
			$this->contributionAmount= $row ['contributionAmount'];
			$this->cashAmount = $row ['cashAmount'];
			$this->fixedIncomeAmount = $row ['equityAmount'];
			$investmentAllocationId= $row ['investmentAllocationId'];
			
			$this->investmentAllocation = new InvestmentAllocation( $investmentAllocationId );
			$this->investmentAllocation->load ( $db );
			
			return true;
		}
		return false;
	}
}
	?>