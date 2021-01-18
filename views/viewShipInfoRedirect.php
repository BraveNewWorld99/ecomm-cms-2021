<?php

//Start session
session_start();

//Set money format
setlocale(LC_MONETARY, 'en_US');

//Get user_logged_in and user_level from Session
(isset($_SESSION['user_logged_in'])) ? $user_logged_in = $_SESSION['user_logged_in'] : "";
(isset($_SESSION['user_level'])) ? $user_level = $_SESSION['user_level'] : "";

// initialize some session variables to prevent PHP throwing Notices
if (!isset($_SESSION['values']))
{
    $_SESSION['values']['ship_first_name'] = '';
    $_SESSION['values']['ship_last_name'] = '';
    $_SESSION['values']['ship_address1'] = '';
    $_SESSION['values']['ship_address2'] = '';
    $_SESSION['values']['ship_city'] = '';
    $_SESSION['values']['ship_country'] = '';
    $_SESSION['values']['ship_state'] = '';
    $_SESSION['values']['ship_zip_code_post_code'] = '';

}

if (!isset($_SESSION['errors']))
{
    $_SESSION['errors']['ship_first_name'] = 'hidden';
    $_SESSION['errors']['ship_last_name'] = 'hidden';
    $_SESSION['errors']['ship_address1'] = 'hidden';
    $_SESSION['errors']['ship_address2'] = 'hidden';
    $_SESSION['errors']['ship_city'] = 'hidden';
    $_SESSION['errors']['ship_country'] = 'hidden';
    $_SESSION['errors']['ship_state'] = 'hidden';
    $_SESSION['errors']['ship_zip_code_post_code'] = 'hidden';

}


if (isset($_SESSION['post-data']['insert_ship_info'])) {


    $sec = new Sec;
    $token_verified = $sec->verifyFormToken('viewShipInfo');

    if ($token_verified = true) {

        //Sanitize inputs
        $ship_first_name = filter_var($_SESSION["post-data"]["ship_first_name"], FILTER_SANITIZE_STRING);
        $ship_last_name = filter_var($_SESSION["post-data"]["ship_last_name"], FILTER_SANITIZE_STRING);
        $ship_address1 = filter_var($_SESSION["post-data"]["ship_address1"], FILTER_SANITIZE_STRING);
        $ship_address2 = filter_var($_SESSION["post-data"]["ship_address2"], FILTER_SANITIZE_STRING);
        $ship_city = filter_var($_SESSION["post-data"]["ship_city"], FILTER_SANITIZE_STRING);
        $ship_state = filter_var($_SESSION["post-data"]["ship_state"], FILTER_SANITIZE_STRING);
        $ship_country = filter_var($_SESSION["post-data"]["ship_country"], FILTER_SANITIZE_STRING);
        $ship_zip_code_post_code = filter_var($_SESSION["post-data"]["ship_zip_code_post_code"], FILTER_SANITIZE_STRING);
        $date_modified = date("Y-m-d H:i:s");



        //Insert User Ship To Addresss Info
        $user = new User;
        $user->insertUserShipInfo($user_logged_in, $ship_first_name, $ship_last_name, $ship_address1, $ship_address2, $ship_city, $ship_state, $ship_country, $ship_zip_code_post_code, $date_modified);

        //Clear post data from session
        $_SESSION["post-data"] = [];

        if(ob_get_length()) { ob_clean(); };
        header("Location: http://localhost/cms5/views/viewFrontPage.php?view=viewBillInfo");
        exit;

    }

    else {

        echo "Site down for maintenance";

    }
}

?>