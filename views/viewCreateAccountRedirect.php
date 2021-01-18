<?php

//Start Session
session_start();

//Initialize token
$newToken = "";

//Create form token in session.
$sec = new Sec;
$newToken = $sec->generateFormToken('viewCreateAccount');

//Set passwords_no_match span class to hidden
$passwords_no_match = "hidden";

// initialize some session variables to prevent PHP throwing Notices
if (!isset($_SESSION['values']))
{
    $_SESSION['values']['user_first_name'] = '';
    $_SESSION['values']['user_last_name'] = '';
    $_SESSION['values']['user_login'] = '';
    $_SESSION['values']['user_password'] = '';
    $_SESSION['values']['user_password_confirm'] = '';
}

if (!isset($_SESSION['errors']))
{
    $_SESSION['errors']['user_first_name'] = 'hidden';
    $_SESSION['errors']['user_last_name'] = 'hidden';
    $_SESSION['errors']['user_login'] = 'hidden';
    $_SESSION['errors']['user_password'] = 'hidden';
    $_SESSION['errors']['user_password_confirm'] = 'hidden';

}

if (isset($_SESSION['post-data']['create_user_account'])) {


    $sec = new Sec;
    $token_verified = $sec->verifyFormToken('viewCreateAccount');

    if ($token_verified = true) {

        //Sanitize inputs
        $user_first_name = filter_var($_SESSION["post-data"]["user_first_name"], FILTER_SANITIZE_STRING);
        $user_last_name = filter_var($_SESSION["post-data"]["user_last_name"], FILTER_SANITIZE_STRING);
        $user_login = filter_var($_SESSION["post-data"]["user_login"], FILTER_SANITIZE_STRING);
        $user_password = filter_var($_SESSION["post-data"]["user_password"], FILTER_SANITIZE_STRING);
        $user_password_confirm = filter_var($_SESSION["post-data"]["user_password_confirm"], FILTER_SANITIZE_STRING);
        $registration_date = date("Y-m-d H:i:s");
        $date_modified = date("Y-m-d H:i:s");
        $user_level = 0;

        //check if passwords match

        if ($user_password != $user_password_confirm) {

            //Sets passwords_no_match span class
            $passwords_no_match = "no_match";

        }

        //passwords match, set passwords_no_match span class to hidden, insert user, check user was inserted and redirect.
        else {

            $passwords_no_match = "hidden";

            $user_password = password_hash($user_password, PASSWORD_BCRYPT);

            $user = new User;
            $user->insertUser('', $user_first_name, $user_last_name, $user_login, $user_password, $registration_date,'','','','','','','','','','','','','','','','','', $user_level, $date_modified);

            $user_inserted = $user->checkUserLoginExists($user_login);

            if ($user_inserted['email'] == $user_login) {

                //Clear post data from session
                $_SESSION["post-data"] = [];

                if(ob_get_length()) { ob_clean(); };
                header("Location: http://localhost/cms5/views/viewFrontPage.php?view=viewMyAccount");
                exit;

            }

            else {

                //Error handling
            }

        }


    }

    else {

        echo "Site down for maintenance";
    }



}

elseif ( isset( $_POST['cancel_create_account'] ) ){

    $sec = new Sec;
    $token_verified = $sec->verifyFormToken('viewCreateAccount');

    if ($token_verified = true) {

        //TODO this is not working, headers already sent error.
        //User cancelled registration, return to homepage
        //header("Location: " . BASE_URI);

    } else {

        echo "Site down for maintenance";

    }

}

?>