<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'ajaxFunction.php');

    $received_api_key = isset($_POST['api_key']) ? $_POST['api_key'] : die('Invalid Request');

    if($received_api_key != API_KEY){
        die('Invalid API Key!');
    }

    $request_type = isset($_POST['request_type']) ? $_POST['request_type'] : die('Invalid Request Type');
    // $with_files = isset($_POST['with_files']) ? 'yes' : 'no';
    
    if(function_exists($request_type)){
        $response = $request_type($_POST);
        $response = json_encode($response);
        echo $response;
    } else {
        die('Requested API Not Found');
    }


?>