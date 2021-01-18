<?php

//Start session
session_start();

//Set money format
setlocale(LC_MONETARY, 'en_US');

//Get user_logged_in and user_level from Session
(isset($_SESSION['user_logged_in'])) ? $user_logged_in = $_SESSION['user_logged_in'] : "";
(isset($_SESSION['user_level'])) ? $user_level = $_SESSION['user_level'] : "";

$user = new User;
$user_id = $user->getUserID($user_logged_in);

//Get user id from array
$user_id = $user_id[0]['user_id'];
//Cast to an integer
$user_id = (int)$user_id;

$today = date('Y-m-d');
$tomorrow = date('Y-m-d', strtotime(' +1 day'));

$product = new Product;
$transaction_id = $product->getOrderConfirmation($user_id,$today,$tomorrow);

$transaction_id = $transaction_id[0]['transaction_id'];

//Get User Session
$user_session_id = session_id();

//Remove All Cart Items By Session
$product->deleteAllCartItemsBySession($user_session_id);

?>