<?php
//Set money format
setlocale(LC_MONETARY, 'en_US');

include "include/left_product_menu.php";

$art_id = isset( $_GET['productID'] ) ? $_GET['productID'] : "";
$art_id = filter_var($art_id, FILTER_SANITIZE_NUMBER_INT);

$product = new Product();
$row = $product->getProductsByID($art_id);

//var_dump($row);

echo "<div class=\"primary_img_container\">";

echo "<img class=\"primary_img\" src=\"../" . $row->large . "\" alt=\"" . $row->mini_description .  "\">";

echo "</div>"; //End primary_img


echo "<div class=\"single_product_info\">";

    echo  "<h2 id=\"single_product_title\">" . $row->mini_description . "</h2>";


        echo "<div class=\"single_product_details\">";


            echo "<form action=\"include/ajax_add_to_cart.php\" method=\"get\" id=\"form_add_to_cart\">";

                echo "<input type=\"hidden\" name=\"validation_type\" value=\"php\"/>";

                echo "<input type=\"hidden\" id=\"art_id\" name=\"art_id\" value=\"" . $row->art_id .  "\">";

                echo "<div class\"details_wrapper\">";

                echo "<p class=\"single_product_availability\">";

                    echo "<b>Availability: </b>";
                    echo "<span id=\"single_product_availability_span\">"; //$row->stock
                    echo "</span>";

                echo "</p>";

                echo "<p class=\"single_product_sku\">";

                    echo "<b>SKU: </b>";
                    echo "<span id=\"single_product_sku_span\">";
                    echo $row->sku;
                    echo "</span>";

                echo "</p>";

                echo "<p class=\"single_product_artist\">";

                    echo "<b>Artist: </b>";
                    echo "<span id=\"single_product_artist_span\">";
                    echo $row->artist;
                    echo "</span>";

                echo "</p>";

                echo "<p class=\"single_product_style\">";

                    echo "<b>Style: </b>";
                    echo "<span id=\"single_product_style_span\">";
                    echo $row->style;
                    echo "</span>";

                echo "</p>";

                echo "<p class=\"single_product_medium\">";

                    echo "<b>Medium: </b>";
                    echo "<span id=\"single_product_medium_span\">";
                    echo $row->medium;
                    echo "</span>";

                echo "</p>";

                echo "<div class=\"price_and_quantity\">";

                    echo "<div class=\"single_product_money\">";

                        echo "<p class=\"single_product_price\">";

                            echo "<span id=\"money\">";
                            echo $product->money_format('%i', $row->price/100);
                            echo "</span>";

                        echo "</p>";

                    echo "</div>"; // End single_product_money

                    echo "<div class=\"single_product_quantity\">";


                            echo "<div class=\"quantity_box\">";

                            echo "<label for=\"single_product_quantity_label\">";
                            echo "Quantity:";
                            echo "</label>";

                            //TODO These Awesome Font icons don't work if Javasccript is disabled, replace with images.
                            echo "<span class=\"quantity_down\">";
                            echo "<i class=\"fas fa-minus\"></i>";
                            echo "</span>";


                            echo "<input class=\"single_product_quantity_input\" type=\"text\" name=\"quantity\" value=\"1\">";

                            echo "<span class=\"quantity_up\">";
                            echo "<i class=\"fas fa-plus\"></i>";
                            echo "</span>";

                            echo "</div>";  //End quantity_box

                    echo "</div>"; //End single_product_quantity

                echo "</div>"; // End price_and_quantity

                echo "<div class=\"button_block\">";

                    echo "<button type=\"submit\" name=\"add\" class=\"btn\" id=\"single_product_add_to_cart\">Add to cart</button>";
                    echo "<p class=\"wishlist_section\" >";
                        echo "<a href=\"include/ajax_add_to_wishlist.php?validation_type=php&art_id=" . $row->art_id . "&quantity=1\" class=\"wishlist_form\"><i class=\"fas fa-heart\"></i>Add to wishlist</a>";
                    echo "</p>";

                echo "</div>"; //End button_block

                echo "</div>";  //End details_wrapper

            echo "</form>"; //End form

        echo "</div>"; //End single_product_details

echo "</div>"; //End product_info

echo "</div>"; //End row

?>