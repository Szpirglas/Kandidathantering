<?php

require_once 'dbConnection.php';

class JobApply {

    protected $db;


    private function sendQuery($query) {
        
        $connect = $this->db->connect();

        if ($connect->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        }
        
        $result = $connect->query($query);
        
        $connect->close();
        
        return $result;
    }
    
    function hasApplied($vid, $jobId)
    {
        $query = "SELECT * FROM JOBAPPLY WHERE USERID = " . $vid . " AND JOBPOSTID = " . $jobId;
        
        $result = $this->sendQuery($query);
        
        if ($result->num_rows > 0)
        {
            
            return true;
            
        }
        
        else {
            
            return false;
            
        }
        
        function Apply($vid, $jobId)
        {
            $query = "INSERT INTO JOBAPPLY (USERID, JOBPOSTID, STATUS) VALUES (" . $vid . ", " . $jobId . ", 'Applied')";
            
            $this->sendQuery($query);
        }
        
        
    }

}
?>

