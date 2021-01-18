<?php

echo "<div class=\"row\">";

echo "<div class=\"footer_container\">";

echo "<div class=\"footer_styles\">";

echo "<h3>Styles</h3>";

$product = new Product;
$rows = $product->getDistinctStyles();

foreach ($rows as $value) {

    echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=viewStyles&style=" . $value['style'] . "\">" .
        $value['style'] . "</a></br>";
    
}

echo "</div>"; //End footer_sytles


echo "<div class=\"footer_info\">";

echo "<h3>Information</h3>";

echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=aboutUs\">About Us</a></br>";
echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=contactUs\">Contact Us</a></br>";
echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=privacyPolicy\">Privacy Policy</a></br>";



echo "</div>"; //End footer_info


echo "<div class=\"footer_my_account\">";

echo "<h3>My Account</h3>";

echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=viewRegisterLogin\">My Account</a></br>";
echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=viewLogin\">Login</a></br>";
echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=viewPassword\">Password</a></br>";
echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=viewPrivacyPolicy\">Privacy Policy</a></br>";
echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=viewMyAddresses\">My Orders</a></br>";
echo "<a href=\"" . BASE_URI . "views/viewFrontPage.php?view=viewNews\">Latest News</a></br>";

echo "</div>"; //End footer_my_account


echo "</div>"; //End footer_container

echo "</div>";  //End row



?>