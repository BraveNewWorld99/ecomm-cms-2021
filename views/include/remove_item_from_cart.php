<?php
//TODO move this code to viewCart and use if statement using form value
require ("../../config.php");

//Start new session
session_start();

// Session ID for the user
$user_session_id = session_id();

$art_id = isset( $_POST['art_id'] ) ? $_POST['art_id'] : "";

$product = new Product;
$product->removeCartItemBySession($user_session_id,$art_id);

header("Location: " . BASE_URI . "views/viewFrontPage.php?view=viewCart");

?>