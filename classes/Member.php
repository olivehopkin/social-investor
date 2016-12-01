<?php
class Member
{
    // property declaration
    public $fName = '';
    public $lName = '';
    public $dateOfBirth = '';
    public $emailAddress = '';
    public $username = '';
    public $password = '';
    public $riskLevel;
 
    /*
     * Constructor for existing member
     */
    public function __construct($username) {
    	$this->username = $username;
    }
    
    /*
     * Constructor -  the member's personal data from registration
     */
    public function addPersonalData($fName, $lName, $emailAddress, $password) {
    	$this->fName = $fName;
    	$this->lName = $lName;
    	$this->emailAddress = $emailAddress;
    	$this->username = $emailAddress;
    	$this->password = $password;
    }

    /*
     * Add the member's risk level
     */
    public function addRiskLevel($riskLevel) {
    	$this->riskLevel = $riskLevel;
    }
    
    
    /*
     * Get the display representation of risk profile
     */
    public function getRiskLevel() {
    	switch ($this->riskLevel) {
    		case 1 :
    			return 'Low risk';
    		case 2 :
    			return 'Medium risk';
    		case 3 :
    			return 'High risk';
    	}
    	return 'Unknown Risk Level';
    }
    
    
    
    /*
     * load member from DB using username
     */
    public function load($db) {
    	// Get member from DB
    	$memberQuery = "select fName, lName, emailAddress, dateOfBirth, riskLevel, passwordHash from Member where username = '$this->username'";
    	// Perform the query
    	$result = $db->query ( $memberQuery );
    	// Fetch single row as an associative array
    	if ($row = $result->fetch_assoc ()) {
    		$this->fName = $row ['fName'];
    		$this->lName = $row ['lName'];
    		$this->emailAddress = $row ['emailAddress'];
    		$this->dateOfBirth = $row ['dateOfBirth'];
    		$this->password = $row ['passwordHash'];
			$this->riskLevel = $row ['riskLevel'];
			
			return true;
		}
		
		return false;
	}
}
?>