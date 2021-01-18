<?php

//Start session
session_start();

// initialize some session variables to prevent PHP throwing Notices
if (!isset($_SESSION['values']))
{
    $_SESSION['values']['user_login'] = '';
    $_SESSION['values']['user_password'] = '';
}

if (!isset($_SESSION['errors']))
{
    $_SESSION['errors']['user_login'] = 'hidden';
    $_SESSION['errors']['user_password'] = 'hidden';
}


//Create form token in session.
$sec = new Sec;
$newToken = $sec->generateFormToken('viewRegisterLogin');


//TODO Can't find where I set this session data, need to find this and replicate below for bill_info_login_redirect
if (isset($_SESSION['post-data']['ship_info_login_redirect'])) {

    $ship_info_referrer_url = filter_var($_SESSION['post-data']['ship_info_referrer_url'], FILTER_SANITIZE_STRING);

}

//TODO this is not working properly.
if (isset($_SESSION['post-data']['ship_info_login_redirect'])) {

    $bill_info_referrer_url = filter_var($_SESSION['post-data']['bill_info_referrer_url'], FILTER_SANITIZE_STRING);

}


if (isset($_SESSION['post-data']['try_user_login'])) {

    $sec = new Sec;
    $token_verified = $sec->verifyFormToken('viewRegisterLogin');

    if ($token_verified = true) {

        $user_login = filter_var($_SESSION['post-data']['user_login'], FILTER_SANITIZE_STRING);
        $user_password = filter_var($_SESSION['post-data']['user_password'], FILTER_SANITIZE_STRING);


        $user = new User;
        $row = $user->loginUser($user_login);

        if (password_verify ($user_password, $row['password']) ) {

            // Login successful: Create a session and redirect to the admin homepage
            $_SESSION['user_logged_in'] = $row['email'];
            $_SESSION['user_level'] = $row['user_level'];

            //For redirection if user didn't come from another page.
            $viewMyAccount = "http://localhost/cms5/views/viewFrontPage.php?view=viewMyAccount";

            //Create sec object
            $sec = new Sec();

            //If we were directed to this page by a referrer url, redirect back to that page after login.
            //TODO need to replicate this functionality on viewCreateAccount.php and viewLogin.php
            if (!empty($_SESSION['post-data']['ship_info_login_redirect'])) {

                //Clear post data from session
                $_SESSION["post-data"] = [];

                if(ob_get_length()) { ob_clean(); };
                $sec->redirect($ship_info_referrer_url);

            }

            //TODO this is not working properly.
            //If we were directed tot his page by a referrer url, redirect back to that page after login.
            elseif(!empty($_SESSION['post-data']['bill_info_login_redirect'])) {

                //Clear post data from session
                $_SESSION["post-data"] = [];

                if(ob_get_length()) { ob_clean(); };
                $sec->redirect($bill_info_referrer_url);

            }

            //If we were directed to this page by clicking the My Account Link, redirect to viewMyAccount.php
            else {

                //Clear post data from session
                $_SESSION["post-data"] = [];

                if(ob_get_length()) { ob_clean(); };
                $sec->redirect($viewMyAccount);

            }



        } else {

            //show login_failed span if login unsuccessful
            $login_failed = "error";

        }


    }

    else {

        echo "Site down for maintenance";

    }
}

?>