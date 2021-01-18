<?php

//Start session
session_start();

//Set money format
setlocale(LC_MONETARY, 'en_US');

//Set terms not accepted to hidden
$terms_not_accepted = "hidden";

//Get user_logged_in and user_level from Session
(isset($_SESSION['user_logged_in'])) ? $user_logged_in = $_SESSION['user_logged_in'] : "";
(isset($_SESSION['user_level'])) ? $user_level = $_SESSION['user_level'] : "";

//Get User Session
$user_session_id = session_id();

//Get Cart Items By User Session ID
$product = new Product;
$rows = $product->getCartBySession($user_session_id);

if(isset($_POST['place_order'])) {

    if(isset($_POST['ts_and_cs'])) {

        $user = new User;
        $user_id = $user->getUserID($user_logged_in);

        //Get user id from array
        $user_id = $user_id[0]['user_id'];
        //Cast to an integer
        $user_id = (int)$user_id;

        //Transaction ID is random selection of numbers and characters.
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $transaction_id = substr(str_shuffle($permitted_chars), 0, 45);

        //Not handling real transactions for demo site.
        $payment_status = "FAKE";
        //Not handling shipping amounts for demo site.
        $shipping_amount = 0;
        //Now
        $date_created = date("Y-m-d H:i:s");



        foreach ($rows as $value) {

            $price = $value['price'];
            $quantity = $value['quantity'];
            $payment_amount = $price * $quantity;

            $product = new Product;
            $product->insertOrder($user_id,$value['art_id'],$value['quantity'],$transaction_id,$payment_status,$payment_amount,$shipping_amount,$date_created);

            //Redirect
            $order_confirm_redirect = BASE_URI . "views/viewFrontPage.php?view=viewOrderConfirm";

            //Create new sec object and use redirect method
            $sec = new Sec;
            $sec->redirect($order_confirm_redirect);
            (exit);

        }


    } else {

        $terms_not_accepted = "error";

    }

}

?>