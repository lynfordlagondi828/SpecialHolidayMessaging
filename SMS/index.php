<?php
    require_once 'inc/DbFunctions.php';
    $database = new DbFunctions();
    $message = "";

    require  'vendor/autoload.php';
    use Twilio\Rest\Client;
                    


    if(isset($_POST["submit"])){

        $so_name = trim($_POST["so_name"]);
        $so_acr = trim($_POST["so_acr"]);
        $so_date_start = trim($_POST["so_date_start"]);
        $so_date_end = trim($_POST["so_date_end"]);


        if($database->check_occasion($so_name)){

            $message = "" .$so_name . " exists.";

        } else {

            $error_result = $database->add_special_occasions($so_name,$so_acr,$so_date_start,$so_date_end);

            if($error_result != TRUE){

                $message = "" . $so_name  . " added.";
               // $_SESSION["success"] = TRUE;
               // $_SESSION["so_name"] = $so_name;
               // header('location:send-sms.php');
               // exit();
               
                $result = $database->get_all_employee();

                foreach($result as $row){
                
                    $contact_number = $row["emp_contact_num"];
                    //echo $contact_number;
                }

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
                        '++639053485381',
                        array(
                            'from' => $twilio_number,
                            'body' => $so_name
                        )
                    );

            } else {
                $message = "" . $so_name  . " not added.";
            }
        }

        
    }
    
?>
<html>
    <head>
        <title> 
             Adding Special Occasions
        </title>
        <link href="style.css" rel="stylesheet"> 
    </head>
    <body>
        <div id="container">
            <p align="center">
                <img src="img/logo.png" width="50" height="50">
            </p>
            <h4  align="center"style="font-family:'Times New Roman'">
                 Negros Oriental State University
            </h4>
            <h3 style="font-family:'Times New Roman'">
                Add new Special Occasions
            </h3>
            <h4>
            <?php echo $message; ?>
            </h4>
            <form method="post">
                <label>Special Occasions Name</label>
                <input type="text"  name="so_name" placeholder="Special Occasions Name">

                <label>Special Occasions Acronym </label>
                <input type="text"  name="so_acr" placeholder="Special Occasions Acronym ">

                <label>Special Occasions Date Start </label>
                <input type="datetime-local"  name="so_date_start" placeholder="Special Occasions Date Start">

               

                <label>Special Occasions Date End </label>
                <input type="datetime-local"  name="so_date_end" placeholder="Special Occasions Date End">
                <br><button class="button button4" name="submit">Submit</button>
              
            </form>
        </div>
    </body>
</html>