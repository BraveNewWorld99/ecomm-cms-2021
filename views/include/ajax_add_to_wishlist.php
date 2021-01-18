<?php

/**
 * Art House Live by Adam Hott
 * Copyright 2020
 * ajax_add_to_wishlist.php
 */


require ("../../config.php");

//Start new session
session_start();

// Session ID for the user
$user_session_id = session_id();

//art_id in art table for the product added to the cart
$art_id = isset( $_GET['art_id'] ) ? $_GET['art_id'] : "";

//Quantity of art item added to the cart
$quantity = isset( $_GET['quantity'] ) ? $_GET['quantity'] : "";

//Validation Type
$validation_type = isset( $_GET['validation_type'] ) ? $_GET['validation_type'] : "";

//Datetime created is now
$date_created = date("Y-m-d H:i:s");

//Datetime modified is now
$date_modified = date("Y-m-d H:i:s");

$product = new Product();
$product->insertWishlist($user_session_id,$art_id,$quantity,$date_created,$date_modified);

if ($validation_type == "ajax") {

// show a message of success and provide a true success variable
    $data['success'] = true;

// return all our data to an AJAX call
    echo json_encode($data);

}

else {
    header("Location: http://localhost/cms5/views/viewFrontPage.php?view=viewProduct&productID=" . $art_id);
}
?>

