<?php

if (isset($_POST['vid']) && isset($_POST['jobId']))
{
    apply($_POST['vid'], $_POST['jobId']);
    
    echo 'Ansökan skickad!';
   
    session_start();
}


function sendQuery($query) {
    
    require_once 'dbConnection.php';

    $db = new dbConnection();
    
    $connect = $db->connect();

    if ($connect->connect_error) {
        echo "Connection failed: " . $connect->connect_error;
    }

    $result = $connect->query($query);

    $connect->close();
    
    
    return $result;
}

function hasApplied($vid, $jobId) {
    $query = "SELECT * FROM JOBAPPLY WHERE USERID = " . $vid . " AND JOBPOSTID = " . $jobId;

    $result = sendQuery($query);

    if ($result->num_rows > 0) {

        return true;
    } else {

        return false;
    }
}

function apply($vid, $jobId) {
    
    session_start();
    
    $query = "INSERT INTO JOBAPPLY (USERID, JOBPOSTID, STATUS) VALUES ($vid, $jobId, 'Applied')";
    
    require_once 'dbConnection.php';
    require_once 'TaskHandler.php';

    $taskHandler = new TaskHandler();
    $db = new dbConnection();
    $connect = $db->connect();
    
    require_once("blogHandler.php");
    $api = new BlogHandler();
    $job = $api->getBlogPost($jobId);
    
    $jobName = $job['title'];
    $applicantName = $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'];
    
    if ($connect->connect_error) {
        echo "Connection failed: " . $connect->connect_error;
    }

     if ($connect->query($query) === true) {
         
        $taskHandler->createTask($vid, $jobName, $applicantName);
         
         $connect->close();
         
         header("location: job.php");
         
     }
     
     else {
            echo "Error: " . $query . "<br>" . $connect->error;

            $connect->close();
     }

    
}
?>

