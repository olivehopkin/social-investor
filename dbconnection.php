<?php
    // Uni db connection
   $db = new mysqli('localhost','acnf576','150046456', 'acnf576');
    // local db connection
    //$db = new mysqli('127.0.0.1:3306','olive','Londoncity18!', 'acnf576');
    
    if ($db->connect_error) {
      echo "Connect failed: " . $db->connect_error;
      exit();
    }
 ?>