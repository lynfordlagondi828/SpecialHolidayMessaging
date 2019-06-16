<?php


ini_set('display_errors',1);

require_once '../includes/DbFunctions.php';

require_once '../libs/Slim/Slim.php';

//\Slim\Slim::registerAutoloader();

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

function echoResponse($status_code,$response){

    $app = \Slim\Slim::getInstance();

    $app->status($status_code);

    $app->contentType('application/json');
    echo json_encode($response);
}

/**
 * User Login 
 */
$app->post('/Login', function() use($app){

    $response = array("error" => FALSE);
    $database = new DbFunctions();

    $username = $app->request->post('username');
    $password = $app->request->post('password');

    $user = $database->user_authentication($username,$password);

    if($user != false){

        $response["error"] = FALSE;
        $response["message"]="User authentication success.";
        echo json_encode($response);

    }else{
        $response["error"] = TRUE;
        $response["message"]="User was unable to authenticate! Because username or password not found. Please try again.";
        echo json_encode($response);
    }
});



/**
 * Get all users
 */
$app->get('/get_all_users', function () use ($app){

    $response = array();
    $database = new DbFunctions();
    $result = $database->get_users();
    
    $response["error"] = FALSE;
    $response["users"] = array();

    foreach($result as $res){
        
        $tmp = array();

        $tmp["id"] = $res["id"];
        $tmp["firstname"] = $res["firstname"];

        array_push($response["users"],$tmp);

    }

    echoResponse(200,$response);
});

$app->run();




































