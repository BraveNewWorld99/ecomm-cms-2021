<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * productCategories.php
 *
 */

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

        <h1>Activate Product Categories</h1>

        <?php

        //Create form token in session.
        $sec = new Sec;
        $newToken = $sec->generateFormToken('productCategories');

        ?>

        <?php


          if ( isset( $_POST['saveChanges'] ) ) {

              $sec = new Sec;
              $token_verified = $sec->verifyFormToken('productCategories');

              if ($token_verified = true) {

                  $checkbox_style = filter_var(isset($_POST['checkbox_style']) ? '1' : '0', FILTER_SANITIZE_STRING);
                  $checkbox_popular = filter_var(isset($_POST['checkbox_popular']) ? '1' : '0', FILTER_SANITIZE_STRING);
                  $checkbox_price = filter_var(isset($_POST['checkbox_price']) ? '1' : '0', FILTER_SANITIZE_STRING);
                  $checkbox_sale = filter_var(isset($_POST['checkbox_sale']) ? '1' : '0', FILTER_SANITIZE_STRING);
                  $checkbox_medium = filter_var(isset($_POST['checkbox_medium']) ? '1' : '0', FILTER_SANITIZE_STRING);

                  $product = new Product();
                  $product->updateActiveCategories($checkbox_style, $checkbox_popular, $checkbox_price, $checkbox_sale, $checkbox_medium);
                  //Redirect to admin page notifying of saved changes
                  header( "Location: admin.php?status=changesSaved" );


              } else {

                  echo "Site down for maintenance.";
              }

          }

          elseif ( isset( $_POST['cancel'] ) ) {

              $sec = new Sec;
              $token_verified = $sec->verifyFormToken('productCategories');

              if ($token_verified = true) {

                  // User has cancelled their edits: return list pages
                  header("Location: admin.php");

              }

              else {

                  echo "Site down for maintenance";
              }

          }

//TODO This form isn't sticky, need to get values from table active_categories and pull this data into the form.
      ?>
        <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
            <input type="hidden" name="token" value="<?php echo $newToken; ?>">
            <table id="categories_checkbox">
                <tr>
                    <th><input type="checkbox" class="categories_checkbox" name="checkbox_style" value="checkbox_style"></th>
                    <th>Browse Art for Sale by Style</th>
                </tr>

                <tr>
                    <th><input type="checkbox" class="categories_checkbox" name="checkbox_popular" value="checkbox_popular"></th>
                    <th>Popular Products</th>
                </tr>

                <tr>
                    <th><input type="checkbox" class="categories_checkbox" name="checkbox_price" value="checkbox_popular"></th>
                    <th>Browse Art for Sale by Price</th>

                <tr>
                    <th><input type="checkbox" class="categories_checkbox" name="checkbox_sale" value="checkbox_sale"></th>
                    <th>On Sale!</th>
                </tr>

                <tr>
            <th><input type="checkbox" class="categories_checkbox" name="checkbox_medium" value="checkbox_medium"></th>
                    <th>Browse Art for Sale by Medium</th>
                </tr>

            </table>

            <div class="buttons">
                <input type="submit" name="saveChanges" value="Save Changes" />
                <input type="submit" formnovalidate name="cancel" value="Cancel" />
            </div>

        </form>

    </div> <!-- MainAdminContent -->

<?php include "templates/admin/include/admin_footer.php" ?>

