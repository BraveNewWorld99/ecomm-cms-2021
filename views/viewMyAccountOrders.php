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

$product = new Product;
$transaction_ids = $product->getTransactionIDs($user_id);

echo "<div class=\cart_container\">";

echo "<table>";

echo "<tr><th><div class=\"product_title\">Product</div></th><th><div class=\"empty_title\"></div></div></th><th><div class=\"price_title\">Price</div></th><th><div class=\"quantity_title\">Quantity</div></th><th><div class=\"total_title\">Total</div></th></tr>";

foreach ($transaction_ids as $row) {


    if (isset($row)) {

        $orders = $product->getOrdersbyTransactionID($row['transaction_id']);

        $grand_total = 0;


        if (isset($orders)) {

            //TODO orders is coming back NULL from PDO.
            foreach ($orders as $value) {

                echo "<tr><td><div class=\"column_product_image\"><img class=\"cart_img\" src=\"" .
                    BASE_URI . $value['midsize'] . "\" alt=\"" . $value['mini_description'] . "\"></div></td>";

                echo "<td><div class=\"column_product_information\">" .
                    "<p class=\"cart_item_name\">Transaction ID: " . $value['transaction_id'] . "</p>" .
                    "<p class=\"cart_item_artist\"><b>Description: </b>" . $value['mini_description'] . "</p>" .
                    "<p class=\"cart_item_style\"><b>Artist: </b>" . $value['artist'] . "</p>" .
                    "<p class=\"cart_item_medium\"><b>Style: </b>" . $value['style'] . "</p>" .
                    "</div></td>";

                $price_calc = $value['price'];
                $quantity_calc = $value['quantity'];
                $total_price = $price_calc * $quantity_calc;
                $grand_total = $grand_total + $total_price;

                echo "<td><div class=\"column_price\">" . $product->money_format('%i', $price_calc / 100) . "</div></td>";

                echo "<td><div class=\"column_quantity\">" . $value['quantity'] . "</div></td>";

                echo "<td><div class=\"column_total_price\">" . $product->money_format('%i', $total_price / 100) . "</div></td>";

            }

        }

    }

}

?>