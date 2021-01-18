<?php

//TODO Stop echoing everything in this page, remove echo php when possible
//Set money format
setlocale(LC_MONETARY, 'en_US');

//Get user session
$user_session_id = session_id();

//Get Cart Items By User Session ID
$product = new Product;
$rows = $product->getCartBySession($user_session_id);


echo "<!-- This is the shopping cart where you can remove items from the cart, update quantities, and proceed to ordering -->";

echo "<div class=\"row\">";

if (!empty($rows)) {

    echo "<div class=\"shopping_cart_title\"><h1>";

    echo "your shopping cart";

    echo "</h1></div>"; // End shopping_cart_title

    echo "<div class=\"cart_container\">";

    echo "<table>";

    echo "<tr><th><div class=\"product_title\">Product</div></th><th><div class=\"empty_title\"></div></div></th><th><div class=\"price_title\">Price</div></th><th><div class=\"quantity_title\">Quantity</div></th><th><div class=\"total_title\">Total</div></th></tr>";

    $grand_total = 0;

    foreach ($rows as $value) {

        echo "<tr><td><div class=\"column_product_image\"><img class=\"cart_img\" src=\"" .
            BASE_URI . $value['midsize'] . "\" alt=\"" . $value['mini_description'] . "\"></div></td>";

        echo "<td><div class=\"column_product_info\">" .
            "<p class=\"cart_item_name\">" . $value['mini_description'] . "</p>" .
            "<p class=\"cart_item_artist\"><b>Artist: </b>" . $value['artist'] . "</p>" .
            "<p class=\"cart_item_style\"><b>Style: </b>" . $value['style'] . "</p>" .
            "<p class=\"cart_item_medium\"><b>Medium: </b>" . $value['medium'] . "</p>" .
            "</div>";

        //Todo need form tokens
        echo "<form action=\"include/remove_item_from_cart.php\" method=\"POST\" id=\"remove_item_from_cart\">";
        echo "<input type=\"hidden\" id=\"art_id\" name=\"art_id\" value=\"" . $value['art_id'] . "\">";
        echo "<button type=\"submit\" id=\"remove_item_from_cart\" form=\"remove_item_from_cart\" value=\"remove\">Remove</button>";
        echo "</form>";

            echo "</td>";

        $price_calc = $value['price'];
        $quantity_calc = $value['quantity'];
        $total_price = $price_calc * $quantity_calc;
        $grand_total = $grand_total + $total_price;

        echo "<td><div class=\"column_price\">" . $product->money_format('%i', $price_calc / 100) . "</div></td>";

        echo "<td><div class=\"column_quantity\">";

        echo "<div class=\"quantity_box\">";

        //TODO These Awesome Font icons don't work if Javasccript is disabled, replace with images.
        echo "<span class=\"quantity_down\">";
        echo "<i class=\"fas fa-minus\"></i>";
        echo "</span>";


        echo "<input class=\"single_product_quantity_input\" form=\"update_item_quantity_cart\" type=\"text\" name=\"quantity\" value=\"" .
            $value['quantity'] . "\">";




        echo "<span class=\"quantity_up\">";
        echo "<i class=\"fas fa-plus\"></i>";
        echo "</span>";

        //Todo need form tokens
        echo "<form action=\"include/update_item_quantity_cart.php\" method=\"POST\" id=\"update_item_quantity_cart\">";
        echo "<input type=\"hidden\" id=\"art_id\" name=\"art_id\" value=\"" . $value['art_id'] . "\">";
        echo "<button type=\"submit\" id=\"update_item_quantity_cart\" form=\"update_item_quantity_cart\" value=\"update\">Update</button>";
        echo "</form>";


        echo "</div>";  //End quantity_box
        echo "</div></td>";  //End column_quantity


        echo "<td><div class=\"column_total_price\">" . $product->money_format('%i', $total_price / 100) . "</div></td>";

    }


    echo "<tr><td><div class=\"grand_total_title\">total price</div></td><td></td><td></td><td></td><td><div class=\"grand_total_money\">" . $product->money_format('%i', $grand_total / 100) . "</div></td></tr>";

    echo "<tr><td></td><td></td><td></td><td></td><td><a href=\"" . BASE_URI .  "views/viewFrontPage.php?view=viewShipInfo\" id=\"proceed_to_checkout\">Proceed to Checkout</a></td></tr>";


    echo "</table>";

    echo "</div>"; // End cart_container
}

else {

    echo "<div class=\"empty_cart_message\"><h1>";

    echo "your shopping cart is empty";

    echo "</h1></div>"; //End empty_cart_message


}



echo "</div>"; // End row
echo "<!-- End of row -->";

?>