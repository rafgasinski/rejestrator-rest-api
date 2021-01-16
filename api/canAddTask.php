<?php
     // Connection variable used to communicate with DB
     $conn = new mysqli('localhost', 'root', '', 'rejestrator');

     if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(400);
        exit();
     }

    //POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if( isset($_POST['employeeID']) && 
            isset($_POST['task']) ) {
            $employeeID = $conn->real_escape_string($_POST['employeeID']);
            $task = $conn->real_escape_string($_POST['task']);

            $test = $conn->query("SELECT COUNT(*) FROM tasks WHERE employeeID='$employeeID' AND task='$task");
            $testResult = $test->fetch_assoc();
        
            // Check if employee exists
            if ( $testResult['COUNT(*)'] != 0 ) {
                http_response_code(404);
                exit();
            }

            // Success
            http_response_code(200);
            exit();
        }
        else {
            http_response_code(400);
            exit();
        }
    }
?>