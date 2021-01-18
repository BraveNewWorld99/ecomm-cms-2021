<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * searchProducts.php
 *
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

		  <h1>Search Products</h1>

              <div id="search_bar">
                  <?php
                      //Create form token in session.
                      $sec = new Sec;
                      $newToken = $sec->generateFormToken('searchProducts');
                  ?>

                  <form id="search_form" action="admin.php?action=searchProducts&query=submitted" method="POST">
                      <input id="search_input" type="text" name="query" />
                      <input id="search_input" type="submit" value="Search" />
                      <input id="search_input" type="submit" value="See All" name="see_all" />
                      <input type="hidden" name="token" value="<?php echo $newToken; ?>">
                  </form>

              </div>

              <?php

              if ( isset( $_POST['saveChanges'] ) ) {

                  //User has posted the product edit form: save the changes.

                  $sec = new Sec;
                  $token_verified = $sec->verifyFormToken('editProducts');

                  if ($token_verified = true) {

                        //TODO Need to verify thumb and midsize are images.
                      //SANITIZE INPUTS
                      $art_id = filter_var($_POST["art_id"], FILTER_SANITIZE_NUMBER_INT);
                      $sku = filter_var($_POST["sku"], FILTER_SANITIZE_STRING);
                      $thumb = filter_var($_POST["thumb"], FILTER_SANITIZE_STRING);
                      $midsize = filter_var($_POST["midsize"], FILTER_SANITIZE_STRING);
                      $large = filter_var($_POST["large"], FILTER_SANITIZE_STRING);
                      $style = filter_var($_POST["style"], FILTER_SANITIZE_STRING);
                      $price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT);
                      $medium = filter_var($_POST["medium"], FILTER_SANITIZE_STRING);
                      $artist = filter_var($_POST["artist"], FILTER_SANITIZE_STRING);
                      $mini_description = filter_var($_POST["mini_description"], FILTER_SANITIZE_STRING);

                      // Update the Product using the Product Class
                      $product = new Product;
                      $product->updateProduct($art_id, $sku, $thumb, $midsize, $large, $style, $price, $medium, $artist, $mini_description);

                  }

                  else {

                      echo "Site down for maintenance";
                  }

              }

              if ( isset( $_POST['query'] ) ) {

              $sec = new Sec;
              $token_verified = $sec->verifyFormToken('searchProducts');

              if ($token_verified = true) {

                  include("templates/admin/include/search_product_grid.php");
              }

              else {

                echo "Site down for maintenance";
              }

              }

              elseif ( isset($POST['see_all'])) {

                $sec = new Sec;
                $token_verified = $sec->verifyFormToken('searchProducts');

                if ($token_verified = true) {


                  header( "Location: admin.php?action=searchProducts" );

                  }

                else {

                    echo "Site down for maintenance";

                }

              }

              else {

                  include("templates/admin/include/product_grid.php");

              }

                ?>

		  </div> <!-- MainAdminContent -->


<?php include "templates/admin/include/admin_footer.php" ?>

