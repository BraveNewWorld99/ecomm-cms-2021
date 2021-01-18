<?php echo "<!-- This is the main menu section which contains the logo, menu links, and cart icon -->";

echo "<div class=\"row\">";

echo "<!-- This is the container for the logo, menu links, and cart -->";

echo "<div id=\"header_wrap\">";

echo "<!-- This is a container for the logo -->";

echo "<div id=\"header_left\">";

    echo "<a href=\"http://localhost/cms5/\">Art House</a>";

    echo "</div>";

echo "<!-- This is the container for the menu -->";

echo "<div id=\"header_center\">";

include "main_front_menu.php";

echo "</div>";

echo "<!-- This is the container for the cart -->";

echo "<div id=\"header_right\">";

    $user_session_id = session_id();

    $product = new Product;
    $item_count = $product->countCartItems($user_session_id);

        echo "<a href=\"" . BASE_URI .  "views/viewFrontPage.php?view=viewCart\">";

        echo "<i class=\"fas fa-shopping-bag\"></i> my cart : ";

        echo "<div id=\"item_count\">";

            if ($item_count[0] > 0) {

                echo $item_count[0] . " item(s)";
            }


             echo "</div> <!-- End of item_count -->";

            echo "</a>  <!-- End of a link -->";

    echo "</div>  <!-- End of header_right -->";

echo "</div> <!-- End of header_wrap -->";

echo "</div> <!-- End of row -->";
?>