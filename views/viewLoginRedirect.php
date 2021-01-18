<?php

//Start session
session_start();

//Create form token in session.
$sec = new Sec;
$newToken = $sec->generateFormToken('viewLogin');

//Initialized failed login variable
$login_failed = "hidden";

if (isset($_POST['try_user_login'])) {

    $sec = new Sec;
    $token_verified = $sec->verifyFormToken('viewRegisterLogin');

    if ($token_verified = true) {

        $user_login = filter_var($_POST['user_login'], FILTER_SANITIZE_STRING);
        $user_password = filter_var($_POST['user_password'], FILTER_SANITIZE_STRING);

        $user = new User;
        $row = $user->loginUser($user_login);

        if (password_verify ($user_password, $row['password']) ) {

            // Login successful: Create a session and redirect to the admin homepage
            $_SESSION['user_logged_in'] = $row['email'];
            $_SESSION['user_level'] = $row['user_level'];

            //hide login_failed span if login successful
            $login_failed = "hidden";

            if(ob_get_length()) { ob_clean(); };
            header("Location: http://localhost/cms5/views/viewFrontPage.php?view=viewMyAccount");
            exit;


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