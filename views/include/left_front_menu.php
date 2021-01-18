<?php
//TODO want to pull in different menus for different views.
$view = isset( $_GET['view'] ) ? $_GET['view'] : "";

echo "<div class=\"row\">";
echo "<div id=\"left_front_menu\">";
echo "</ul>";

if ($view == 'viewStyles') {

$product = new Product();
$distinct_styles = $product->getDistinctStyles();

if (!empty($distinct_styles)) {

    echo "<div id=\"distinct_styles\">Styles</div>";

    echo "<ul>";

    foreach ($distinct_styles as $value) {

        echo "<li><a href=\"viewFrontPage.php?view=viewStyles&style=" . $value['style'] . "\">" . $value['style'] . "</a></li>";

    }

    echo "</ul>";

}

else {

    //TODO Error log no data

}


}

elseif ($view == 'viewPrices') {

    echo "<div id=\"price_range\">Price Range</div>";

    echo "<ul>";
    echo "<li><a href=\"viewFrontPage.php?view=viewPrices&price=0_to_1000\">$0 - $1000</a></li>";
    echo "<li><a href=\"viewFrontPage.php?view=viewPrices&price=1000_to_2000\">$1000 - $2000</a></li>";
    echo "<li><a href=\"viewFrontPage.php?view=viewPrices&price=2000_to_5000\">$2000 - $5000</a></li>";
    echo "<li><a href=\"viewFrontPage.php?view=viewPrices&price=5000_to_10000\">$5000 - $10000</a></li>";
    echo "</ul>";

}

elseif ($view == 'viewMedium') {

    $product = new Product;
    $distinct_medium = $product->getDistinctMedium();

    if (!empty($distinct_medium)) {

        echo "<div id=\"distinct_medium\">Medium</div>";

        foreach ($distinct_medium as $value) {

            echo "<li><a href=\"viewFrontPage.php?view=viewMedium&medium=" . $value['medium'] . "\">" . $value['medium'] . "</a>";

        }

    }

    else {

        //TODO Error log no data

    }


}



echo "</ul>";
echo "</div>"; //End left_front_menu

?>