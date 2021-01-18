<?php

echo "<div class=\"row\">";

    $products = new Product;
    $rows = $products->getProducts();

    if (isset($rows)) {

        $count = 1;

        foreach ($rows as $value) {

            // Add column break every third row. <div class="w-100"></div>
            if ($count % 3 == 0) {
                //TODO Need to go back 2 directories in the image src link, can't figure this out.
                echo "<div class=\"col\">" . "<a href=\"admin.php?action=editProducts&product=" . filter_var($value['art_id'], FILTER_SANITIZE_NUMBER_INT) . "\"><img src=\"/cms5/" . filter_var($value['thumb'], FILTER_SANITIZE_URL) .
                    "\" width=\"75\" height=\"75\" title=\"" . filter_var($value['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div id=\"product_description\">" . $value['mini_description'] . "</div></div>";
                echo "<div class=\"w-100\"></div>";
            } else {
                //If not a 3rd row don't add the break.
                //TODO Need to go back 2 directories in the image src link, can't figure this out.
                echo "<div class=\"col\">" . "<a href=\"admin.php?action=editProducts&product=" . filter_var($value['art_id'], FILTER_SANITIZE_NUMBER_INT) . "\"><img src=\"/cms5/" . filter_var($value['thumb'], FILTER_SANITIZE_URL) .
                    "\" width=\"75\" height=\"75\" title=\"" . filter_var($value['artist'], FILTER_SANITIZE_STRING) . "\"></a>" . "<div id=\"product_description\">" . $value['mini_description'] . "</div></div>";
            }

            $count++;
        }

    }

echo "</div>";

?>