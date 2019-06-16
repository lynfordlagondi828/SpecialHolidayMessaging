<?php

session_start();

$so_name =  $_SESSION["so_name"];

if(!isset($_SESSION["success"])){

}



require_once  'inc/DbFunctions.php';
$database = new DbFunctions();

$result = $database->get_all_employee();

foreach($result as $row){
   
    $contact_number = $row["emp_contact_num"];
    
}

require  'vendor/autoload.php';
use Twilio\Rest\Client;
$result = '';

if(isset($_POST["submit"])){

   // $contact_number = $_POST["contact_number"];
    //$message = $_POST["message"];

     // Your Account SID and Auth Token from twilio.com/console
     $account_sid = 'AC7a87bebc089b99f28aef6cd8ad64ef24';
     $auth_token = '152f033a4e029015cbd69dd3b2553441';
     // In production, these should be environment variables. E.g.:
     // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
 
     // A Twilio number you own with SMS capabilities
     $twilio_number = "+12565008442";
 
     $client = new Client($account_sid, $auth_token);
     $client->messages->create(
         // Where to send a text message (your cell phone?)
        '+639053485381',
         array(
             'from' => $twilio_number,
             'body' => $so_name
         )
     );
     echo"SMS sent";
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
</head>
<body>
<div id="container">
    <h1>Send SMS to Employee.</h1>
    <form action="" method="post">
        <input type="submit" name="submit"  value="Confirm" />      
    </form>
</div>
</body>
</html>