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
    $_SESSION['values']['bill_first_name'] = '';
    $_SESSION['values']['bill_last_name'] = '';
    $_SESSION['values']['bill_address1'] = '';
    $_SESSION['values']['bill_address2'] = '';
    $_SESSION['values']['bill_city'] = '';
    $_SESSION['values']['bill_country'] = '';
    $_SESSION['values']['bill_state'] = '';
    $_SESSION['values']['bill_zip_code_post_code'] = '';

}

if (!isset($_SESSION['errors']))
{
    $_SESSION['errors']['bill_first_name'] = 'hidden';
    $_SESSION['errors']['bill_last_name'] = 'hidden';
    $_SESSION['errors']['bill_address1'] = 'hidden';
    $_SESSION['errors']['bill_address2'] = 'hidden';
    $_SESSION['errors']['bill_city'] = 'hidden';
    $_SESSION['errors']['bill_country'] = 'hidden';
    $_SESSION['errors']['bill_state'] = 'hidden';
    $_SESSION['errors']['bill_zip_code_post_code'] = 'hidden';

}


if (isset($_SESSION['post-data']['insert_bill_info'])) {


    $sec = new Sec;
    $token_verified = $sec->verifyFormToken('viewBillInfo');

    if ($token_verified = true) {

        //Sanitize inputs
        $bill_first_name = filter_var($_SESSION["post-data"]["bill_first_name"], FILTER_SANITIZE_STRING);
        $bill_last_name = filter_var($_SESSION["post-data"]["bill_last_name"], FILTER_SANITIZE_STRING);
        $bill_address1 = filter_var($_SESSION["post-data"]["bill_address1"], FILTER_SANITIZE_STRING);
        $bill_address2 = filter_var($_SESSION["post-data"]["bill_address2"], FILTER_SANITIZE_STRING);
        $bill_city = filter_var($_SESSION["post-data"]["bill_city"], FILTER_SANITIZE_STRING);
        $bill_state = filter_var($_SESSION["post-data"]["bill_state"], FILTER_SANITIZE_STRING);
        $bill_country = filter_var($_SESSION["post-data"]["bill_country"], FILTER_SANITIZE_STRING);
        $bill_zip_code_post_code = filter_var($_SESSION["post-data"]["bill_zip_code_post_code"], FILTER_SANITIZE_STRING);
        $date_modified = date("Y-m-d H:i:s");


        //Insert User Ship To Addresss Info
        $user = new User;
        $user->insertUserBillInfo($user_logged_in, $bill_first_name, $bill_last_name, $bill_address1, $bill_address2, $bill_city, $bill_state, $bill_country, $bill_zip_code_post_code, $date_modified);

        //Clear post data from session
        $_SESSION["post-data"] = [];

        if(ob_get_length()) { ob_clean(); };

        //Redirect
        $payment_info_redirect = BASE_URI . "views/viewFrontPage.php?view=viewPaymentInfo";

        //Create sec object and redirect method
        $sec = new Sec;
        $sec->redirect($payment_info_redirect);

    }

    else {

        echo "Site down for maintenance";

    }
}

?>