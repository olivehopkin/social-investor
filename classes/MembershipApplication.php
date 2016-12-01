<?php
class MembershipApplication
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
     * Add the member's personal data
     */
    public function addMemberPersonalData($fName, $lName, $dateOfBirth, $emailAddress, $password) {
        $this->fName = $fName;
        $this->lName = $lName;
        $this->dateOfBirth = $dateOfBirth;
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
    
    public function usernameAlreadyExists($db) {
    	// check whether a user exists
    	$userQuery = "SELECT COUNT(*) AS count FROM Member WHERE username = '" . $this->username . "'";
    	echo $userQuery;
    	$result = $db->query ( $userQuery );
    	$row = $result->fetch_assoc ();
    	// if there is a user with this username already, don't add a new one
    	if ($row ['count'] > 0) {
    		return true;
    	}
    	return false;
    }
    
    /*
     * Submit membership application details to DB
     */
    public function submit($db) {
    	// Passed in from the user entries
    	$password = mysqli_real_escape_string($db, $this->password);
    	$firstName = mysqli_real_escape_string($db, $this->fName);
    	$lastName = mysqli_real_escape_string($db,  $this->lName);
    	$username = mysqli_real_escape_string($db, $this->emailAddress);
    	$passwordHash = sha1 ( $password );
    	$email = mysqli_real_escape_string($db, $this->emailAddress);
    	$dob = $this->dateOfBirth;
		$riskLevel = $this->riskLevel;
		
		// Add new user to db
		$userQuery = "INSERT into Member (username, passwordHash, fName, lName, emailAddress, dateOfBirth, riskLevel)
    		values ('$username', '$passwordHash', '$firstName', '$lastName', '$email', '$dob', '$riskLevel')";

		echo $userQuery;
		// Perform query
		$result = $db->query ( $userQuery );
		
		if ($result) {
			// Send registration email
			/*$emailMsg = "$msg<br>First Name: $firstName<br>Last Name: $lastName<br>Username: $username<br>Password: $password";
			phpMail ( $email, "Welcome to Social Investor!", $emailMsg, "admin@si.com" );*/		
		}
    	    	
    	return $result;
    }
    
    
    
}

?>