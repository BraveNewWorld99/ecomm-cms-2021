<?php
/**
 * CMS by Adam Hott
 * Copyright 2019
 * viewHomePage.php
 */

//this is the top black panel of the site which contains the phone number, search bar, and wish list
include "include/top_panel.html";

//this is the main menu section of the site which contains the logo, main menu bar, and cart
include "include/header_wrap.php";

//this is the NEW THIS WEEK section or main text area.
include "include/section_text.html";

//this is the product categories that are tied in with the active_categories table in the database.
include "include/product_categories.php";

//footer
include "include/front_footer.php";

?>