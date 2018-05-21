
<?php
/**
 * Dessa funktioner används för att hantera jobbansökningar. När en användare söker
 * jobb så registreras detta i både den lokala databasen (StrategDB) och det registreras
 * även på användares profil i HubSpot, vilket gör att rekryteraren får en notis därigenom.
 */

if (isset($_POST['vid']) && isset($_POST['jobId'])) {
    apply($_POST['vid'], $_POST['jobId']);
}

function sendQuery($query) {

    require_once __DIR__ . '/../connections/dbConnection.php';

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


/**
 * Denna funktion kontrollerar om användaren redan har sökt tjänsten i fråga
 * 
 * @param type $vid = användarens ID
 * @param type $jobId = tjänstens ID
 * @return boolean = true om tjänsten finns i databasen, annars false.
 */
function hasApplied($vid, $jobId) {
    $query = "SELECT * FROM JOBAPPLY WHERE USERID = " . $vid . " AND JOBPOSTID = " . $jobId;

    try {
        $result = sendQuery($query);
    } catch (Exception $e) {
        require_once __DIR__ . '/../handlers/exceptionHandler.php';

        $exHandler = new ExceptionHandler();
        $exHandler->addException($vid, $url, $e);
    }
    if ($result->num_rows > 0) {

        return true;
    } else {

        return false;
    }
}

/**
 * Denna funktion används för att registrera att en användare sökt en tjänst.
 * Funktionen registrerar användarens ID och tjänstens ID i StrategDB och 
 * skapar även en "Task" i Hubspot som notifierar rekryteraren.
 * 
 * @param type $vid
 * @param type $jobId
 */

function apply($vid, $jobId) {

    session_start();

    $query = "INSERT INTO JOBAPPLY (USERID, JOBPOSTID, STATUS) VALUES ($vid, $jobId, 'Applied')";

    require_once __DIR__ . '/../handlers/blogHandler.php';
    require_once __DIR__ . '/../handlers/taskHandler.php';

    $taskHandler = new TaskHandler();



    $api = new BlogHandler();
    $job = $api->getBlogPost($jobId);

    $jobName = $job['title'];

    $applicantName = $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'];

    try {
        $result = sendQuery($query);
    } catch (Exception $e) {
        require_once __DIR__ . '/../handlers/exceptionHandler.php';

        $exHandler = new ExceptionHandler();
        $exHandler->addException($vid, $url, $e);
    }

    if ($result === true) {

        $taskHandler->createTask($vid, $jobName, $applicantName);
    } 
}
?>

