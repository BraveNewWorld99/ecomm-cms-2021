<?php
//Set money format
setlocale(LC_MONETARY, 'en_US');

include "include/left_front_menu.php";

echo "<div class=\"shopping_main_section\">";

echo "<div class=\"shopping_main_banner\">";

$medium = isset( $_GET['medium'] ) ? $_GET['medium'] : "";
$medium = filter_var($medium, FILTER_SANITIZE_STRING);

echo $medium;

echo "</div>"; //End of shopping_main_banner


$products = new Product;
$rows = $products->getArtByMedium($medium);


if (!empty($rows)) {

    echo "<div class=\"row\">";

    $count = 1;

    foreach ($rows as $value) {

        // Add column break every third row. <div class="w-100"></div>
        if ($count % 4 == 0) {

            echo "<div class=\"col\">" . "<div class=\"item_container\"><a href=\"viewFrontPage.php?view=viewProduct&productID=" . filter_var($value['art_id'], FILTER_SANITIZE_NUMBER_INT) . "\"><img src=\"/cms5/" . filter_var($value['midsize'], FILTER_SANITIZE_URL) .
                "\" width=\"250\" height=\"220\" title=\"" . filter_var($value['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div class=\"mini_descrip\">" . $value['mini_description'] . "</div><div class=\"price_container\"><div class=\"shopping_bag\"><i class=\"fa fa-shopping-cart\"></i></div><div class=\"price\">" . $products->money_format('%i', $value['price']/100) . "</div></div></div></div>";
            echo "<div class=\"w-100\"></div>";
        } else {
            //If not a 4th row don't add the break.

            echo "<div class=\"col\">" . "<div class=\"item_container\"><a href=\"viewFrontPage.php?view=viewProduct&productID=" . filter_var($value['art_id'], FILTER_SANITIZE_NUMBER_INT) . "\"><img src=\"/cms5/" . filter_var($value['midsize'], FILTER_SANITIZE_URL) .
                "\" width=\"250\" height=\"220\" title=\"" . filter_var($value['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div class=\"mini_descrip\">" . $value['mini_description'] . "</div><div class=\"price_container\"><div class=\"shopping_bag\"><i class=\"fa fa-shopping-cart\"></i></div><div class=\"price\">" . $products->money_format('%i',$value['price']/100) . "</div></div></div></div>";
        }

        $count++;

    }

    echo "</div>"; //End row

}

else {

    //Select in database is bad, log error message.
    echo "No Data";
}

echo "</div>"; //End of shopping_main_section
echo "</div>"; //End of row

?>