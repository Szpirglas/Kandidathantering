<?php

if (isset($_POST['vid']) && isset($_POST['jobId'])) {
    apply($_POST['vid'], $_POST['jobId']);
}

function sendQuery($query) {

    require_once 'dbConnection.php';

    $db = new dbConnection();

         try {
            $con = $db->connect();
            
             if ($con->connect_error) {
            throw new Exception("Connection failed: " . $con->connect_error);
        }
        
        } catch (Exception $e) {
            require_once 'exceptionHandler.php';

            $exHandler = new ExceptionHandler();
            $exHandler->addException($vid, $url, $e);
        }

    $result = $con->query($query);

    $con->close();


    return $result;
}

function hasApplied($vid, $jobId) {
    $query = "SELECT * FROM JOBAPPLY WHERE USERID = " . $vid . " AND JOBPOSTID = " . $jobId;

    try {
        $result = sendQuery($query);
    } catch (Exception $e) {
        require_once 'exceptionHandler.php';

        $exHandler = new ExceptionHandler();
        $exHandler->addException($vid, $url, $e);
    }
    if ($result->num_rows > 0) {

        return true;
    } else {

        return false;
    }
}

function apply($vid, $jobId) {

    session_start();

    $query = "INSERT INTO JOBAPPLY (USERID, JOBPOSTID, STATUS) VALUES ($vid, $jobId, 'Applied')";

    require_once 'blogHandler.php';
    require_once 'TaskHandler.php';

    $taskHandler = new TaskHandler();



    $api = new BlogHandler();
    $job = $api->getBlogPost($jobId);

    $jobName = $job['title'];

    $applicantName = $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'];

    try {
        $result = sendQuery($query);
    } catch (Exception $e) {
        require_once 'exceptionHandler.php';

        $exHandler = new ExceptionHandler();
        $exHandler->addException($vid, $url, $e);
    }

    if ($result === true) {

        $taskHandler->createTask($vid, $jobName, $applicantName);
    } 
}
?>

