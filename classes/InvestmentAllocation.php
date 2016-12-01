<?php
class InvestmentAllocation
{
    // property declaration
   	public $allocationRiskLevel = -1;
    public $cashPercentage = -1;
    public $fixedIncomePercentage = -1;
    public $equitiesPercentage = -1;
 
    /*
     * Add the member's personal data
     */
    public function __construct($allocationRiskLevel) {
    	$this->allocationRiskLevel = $allocationRiskLevel;    	
    }
    
    
    /*
     * load investment allocation from DB
     */
    public function load($db) {
    	// Get allocation from DB
    	$allocQuery = "SELECT cashPercent, fixedIncomePercent, equityPercent from InvestmentAllocation where investmentAllocationId = $this->allocationRiskLevel";
    	//Perform the query
    	$result = $db->query($allocQuery);
    	//Fetch single row as an associative array
    	if ($row = $result->fetch_assoc()) {
    		$this->cashPercentage= $row['cashPercent'];
    		$this->fixedIncomePercentage= $row['fixedIncomePercent'];
    		$this->equitiesPercentage = $row['equityPercent'];
    		return true;
    	}
    	
    	return false;
    }
}
?>