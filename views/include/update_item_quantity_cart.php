<?php
//TODO move this code to viewCart and use if statement using form value
require ("../../config.php");

//Start new session
session_start();

// Session ID for the user
$user_session_id = session_id();

//Art ID
$art_id = isset( $_POST['art_id'] ) ? $_POST['art_id'] : "";

//Quantity from input field
$quantity = isset( $_POST['quantity'] ) ? $_POST['quantity'] : "";

//Datetime created is now
$date_created = date("Y-m-d H:i:s");

//Datetime modified is now
$date_modified = date("Y-m-d H:i:s");

$product = new Product;
$product->updateCartItemQuantity($user_session_id,$art_id,$quantity,$date_created,$date_modified);

header("Location: " . BASE_URI . "views/viewFrontPage.php?view=viewCart");

?>