<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * searchProducts.php
 *
 *
 */
//TODO Need to modify this page to match database updtes.
?>

<?php include "templates/admin/include/admin_header.php" ?>

<div class="row">
    <div id="adminHeader" class="col-12 col-md-8">
        <h2>Corrupt Robot Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
    </div>
    <div id="adminHeader" class="col-6 col-md-4">


    </div>
</div>

<?php include "templates/admin/include/left_admin_menu.php" ?>

<div id="MainAdminContent" class="col-6 col-md-10">

    <div id="search_bar">
        <?php
        //Create form token in session.
        $sec = new Sec;
        $newToken = $sec->generateFormToken('searchUsers');
        ?>

        <form id="search_form" action="admin.php?action=searchUsers&query=submitted" method="POST">
            <input id="search_input" type="text" name="query" />
            <input id="search_input" type="submit" value="Search" />
            <input id="search_input" type="submit" value="See All" name="see_all" />
            <input type="hidden" name="token" value="<?php echo $newToken; ?>">
        </form>

    </div>

    <?php
    //Pagination

    //set the number of rows per display page
    $pagerows = 4;

    if ((isset($_GET['p']) && is_numeric($_GET['p']))) { //already been calculated
        $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
        // make sure it is not executable XSS
    }
    else {

        $user = new User;
        $user_count = $user->getUserCount();

        $records = filter_var($user_count[0], FILTER_SANITIZE_NUMBER_INT);

        if ($records > $pagerows) {

            //if the number of records will fill more than one page
            //Calculate the number of pages and round the result up to the nearest integer
            $pages = ceil ($records/$pagerows);
        }

        else  {
            $pages = 1;
        }

    }  //Page check finished

    //Declare which record to start with
    if ((isset($_GET['s'])) &&( is_numeric($_GET['s']))) {

        $start = htmlspecialchars($_GET['s'], ENT_QUOTES);
        // make sure it is not executable XSS

        }   else{
            $start = 0;
        }

    if ( isset( $_POST['query'] ) ) {

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('searchUsers');

        if ($token_verified = true) {

            include("templates/admin/include/search_user_grid.php");
        }

        else {

            echo "Site down for maintenance";
        }

    }

    elseif ( isset($POST['see_all'])) {

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('searchUsers');

        if ($token_verified = true) {

            include("templates/admin/include/user_grid.php");

        }

        else {

            echo "Site down for maintenance";

        }

    }

    else {

        include("templates/admin/include/user_grid.php");

    }

    // Now display the total number of records/members.

    $echostring = "";

    if ($pages > 1) {//
//What number is the current page?
        $current_page = ($start/$pagerows) + 1;
//If the page is not the first page then create a Previous link
        if ($current_page != 1) {
            $echostring .= "<a href=\"admin.php?action=searchUsers&s=" . ($start - $pagerows) .
                "&p=" . $pages . "\">Previous</a>";
        }
//Create a Next link
        if ($current_page != $pages) {
            $echostring .= "<a href=\"admin.php?action=searchUsers&s=" . ($start + $pagerows) .
                "&p=" . $pages . "\">Next</a>";
        }
        $echostring .= "</p>";
        echo $echostring;
    }

    ?>


</div> <!-- MainAdminContent -->

<?php include "templates/admin/include/admin_footer.php" ?>
