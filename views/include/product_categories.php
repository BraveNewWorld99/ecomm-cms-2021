<?php

echo "<div class=\"category_display\">";

$product = new Product;
$rows = $product->getActiveProductCategories();

if (!empty($rows)) {

    foreach ($rows as $value) {

        $category_description = filter_var($value['category_description'], FILTER_SANITIZE_STRING);

        //This is the art by style category
        if ($category_description == 'art_by_style') {

            $style_message = "browse art for sale by style";
            echo "<div class=\"section_heading\">" .  $style_message . "</div>";

            $product = new Product();
            $products_by_style = $product->getRandomArtByStyle();

                if (!empty($products_by_style)) {

                    echo "<div class=\"row\">";

                    $count = 1;

                    foreach ($products_by_style as $style_row) {

                        // Add column break every third row. <div class="w-100"></div>
                        if ($count % 4 == 0) {

                            echo "<div class=\"col\">" . "<div class=\"item_container\"><a href=\"views/viewFrontPage.php?view=viewStyles&style=" . filter_var($style_row['style'], FILTER_SANITIZE_STRING) . "\"><img src=\"/cms5/" . filter_var($style_row['midsize'], FILTER_SANITIZE_URL) .
                                "\" width=\"250\" height=\"220\" title=\"" . filter_var($style_row['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div id=\"item_description\">" . $style_row['style'] . "</div></div></div>";
                            echo "<div class=\"w-100\"></div>";
                        } else {
                            //If not a 3rd row don't add the break.

                            echo "<div class=\"col\">" . "<div class=\"item_container\"><a href=\"views/viewFrontPage.php?view=viewStyles&style=" . filter_var($style_row['style'], FILTER_SANITIZE_STRING) . "\"><img src=\"/cms5/" . filter_var($style_row['midsize'], FILTER_SANITIZE_URL) .
                                "\" width=\"250\" height=\"220\" title=\"" . filter_var($style_row['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div id=\"item_description\">" . $style_row['style'] . "</div></div></div>";
                        }

                        $count++;

                    }

                    echo "</div>"; //End row

                }

                else {

                    //Select in database is bad, log error message.
                }

        //TODO This is the popular products category, need the SQL to tie in with order, future functionality.
        } elseif ($category_description == 'popular_products') {
            $popular_message = "popular products";
            echo "<div class=\"section_heading\">" . $popular_message . "</div>";

            //This is the art by price category activated by active_categories in the database
        } elseif ($category_description == 'art_by_price') {

            $price_message = "browse art for sale by price";
            echo "<div class=\"section_heading\">" . $price_message . "</div>";

            $product = new Product();
            $products_by_price = $product->getArtByPriceRanges();

            if (!empty($products_by_price)) {

                echo "<div class=\"row\">";

                $count = 1;

                foreach ($products_by_price as $price_row) {

                    // Add column break every third row. <div class="w-100"></div>
                    if ($count % 4 == 0) {

                        echo "<div class=\"col\">" . "<div class=\"item_container\"><a href=\"views/viewFrontPage.php?view=viewPrices&price=";
                        if ($count == 1) {echo "0_to_1000";} if ($count == 2) {echo "1000_to_2000";} if ($count == 3) {echo "2000_to_5000";}if ($count == 4) {echo "5000_to_10000";} ;
                        echo "\"><img src=\"/cms5/" . filter_var($price_row['midsize'], FILTER_SANITIZE_URL) .
                            "\" width=\"250\" height=\"220\" title=\"" . filter_var($price_row['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div id=\"item_description\">";
                        if ($count == 1) {echo "$0 - $1000";} if ($count == 2) {echo "$1000 - $2000";} if ($count == 3) {echo "$2000 - $5000";}if ($count == 4) {echo "$5000 - $10000";}
                        echo "</div></div></div>";
                        echo "<div class=\"w-100\"></div>";

                    } else {

                        //If not a 4th row don't add the break.
                        echo "<div class=\"col\">" . "<div class=\"item_container\"><a href=\"views/viewFrontPage.php?view=viewPrices&price=";
                        if ($count == 1) {echo "0_to_1000";} if ($count == 2) {echo "1000_to_2000";} if ($count == 3) {echo "2000_to_5000";}if ($count == 4) {echo "5000_to_10000";} ;
                        echo "\"><img src=\"/cms5/" . filter_var($price_row['midsize'], FILTER_SANITIZE_URL) .
                            "\" width=\"250\" height=\"220\" title=\"" . filter_var($price_row['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div id=\"item_description\">";
                        if ($count == 1) {echo "$0 - $1000";} if ($count == 2) {echo "$1000 - $2000";} if ($count == 3) {echo "$2000 - $5000";}if ($count == 4) {echo "$5000 - $10000";}
                        echo "</div></div></div>";
                    }

                    $count++;

                }

                echo "</div>"; //End row

            }

            else {

                //Select in database is bad, log error message.
            }


         //TODO need to create on sale table with prices that override the normal price in the art table and update sql.
        } elseif ($category_description == 'art_on_sale') {
            $sale_message = "on sale!";
            echo "<div class=\"section_heading\">" . $sale_message . "</div>";

        } elseif ($category_description == 'art_by_medium'){

        $medium_message = "browse art for sale by medium";
        echo "<div class=\"section_heading\">" . $medium_message . "</div>";

            $product = new Product();
            $products_by_medium = $product->getRandomArtByMedium();

            if (!empty($products_by_medium)) {

                echo "<div class=\"row\">";

                $count = 1;

                foreach ($products_by_medium as $medium_row) {

                    // Add column break every third row. <div class="w-100"></div>
                    if ($count % 4 == 0) {

                        echo "<div class=\"col\">" . "<div class=\"item_container\"><a href=\"views/viewFrontPage.php?view=viewMedium&medium=" . filter_var($medium_row['medium'], FILTER_SANITIZE_STRING) . "\"><img src=\"/cms5/" . filter_var($medium_row['midsize'], FILTER_SANITIZE_URL) .
                            "\" width=\"250\" height=\"220\" title=\"" . filter_var($medium_row['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div id=\"item_description\">" . $medium_row['medium'] . "</div></div></div>";
                        echo "<div class=\"w-100\"></div>";
                    } else {
                        //If not a 4th row don't add the break.

                        echo "<div class=\"col\">" . "<div class=\"item_container\"><a href=\"views/viewFrontPage.php?view=viewMedium&medium=" . filter_var($medium_row['medium'], FILTER_SANITIZE_STRING) . "\"><img src=\"/cms5/" . filter_var($medium_row['midsize'], FILTER_SANITIZE_URL) .
                            "\" width=\"250\" height=\"220\" title=\"" . filter_var($medium_row['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div id=\"item_description\">" . $medium_row['medium'] . "</div></div></div>";
                    }

                    $count++;

                }

                echo "</div>"; //End row

            }

            else {

                //Select in database is bad, log error message.
            }



    }

    }

}

else {

    //no active categories to display
}

echo "<div>"; //End of category_display

?>