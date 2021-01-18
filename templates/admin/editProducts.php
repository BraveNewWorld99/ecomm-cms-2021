<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * editProducts.php
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

		  <h1>Edit Product</h1>



              <?php

              //If products has been selected, edit the product.
              if ( isset($_GET["product"]) ? $art_id = htmlspecialchars($_GET["product"]) : $art_id = -1) ;

              if ($art_id > 0) {

                  $products = new Product;
                  $row = $products->getProductsByID($art_id);

                  if (isset($row)) {

                      //Create form token in session.
                      $sec = new Sec;
                      $newToken = $sec->generateFormToken('editProducts');

                      ?>

                      <form action="admin.php?action=searchProducts&product=<?php echo $art_id; ?>" method="post">
                          <input type="hidden" name="token" value="<?php echo $newToken; ?>">
                          <input type="hidden" name="art_id" value="<?php echo $art_id ?>"/>
                          <input type="hidden" name="submitted" value="true"/>

                          <ul>

                              <li>
                                  <label for="sku">SKU</label>
                                  <input type="text" name="sku" id="sku" placeholder="sku" required autofocus
                                         maxlength="24" value="<?php echo htmlspecialchars($row->sku); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>

                              </li>

                              <li>
                                  <label for="thumb">Thumb</label>
                                  <input type="text" name="thumb" id="thumb" placeholder="THUMB" required autofocus
                                         maxlength="100" value="<?php echo htmlspecialchars($row->thumb); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>

                              </li>

                              <li>
                                  <label for="midsize">Midsize Image</label>
                                  <input type="text" name="midsize" id="midsize" placeholder="midsize image" required autofocus
                                         maxlength="100" value="<?php echo htmlspecialchars($row->midsize); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>
                              </li>

                              <li>
                                  <label for="large">Large Image</label>
                                  <input type="text" name="large" id="large" placeholder="large image" required autofocus
                                         maxlength="100" value="<?php echo htmlspecialchars($row->large); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>
                              </li>

                              <li>
                                  <label for="style">Style</label>
                                  <input type="text" name="style" id="style" placeholder="style" required autofocus
                                         maxlength="50" value="<?php echo htmlspecialchars($row->style); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>

                              </li>

                              <li>
                                  <label for="price">Price</label>
                                  <input type="text" name="price" id="price" placeholder="price" required autofocus
                                         maxlength="6" value="<?php echo htmlspecialchars($row->price); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>

                              </li>

                              <li>
                                  <label for="medium">Medium</label>
                                  <input type="text" name="medium" id="medium" placeholder="medium" required autofocus
                                         maxlength="50" value="<?php echo htmlspecialchars($row->medium); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>

                              </li>

                              <li>
                                  <label for="artist">Artist</label>
                                  <input type="text" name="artist" id="artist" placeholder="artist" required autofocus
                                         maxlength="50" value="<?php echo htmlspecialchars($row->artist); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>

                              </li>

                              <li>
                                  <label for="mini_description">Description</label>
                                  <input type="text" name="mini_description" id="mini_description"
                                         placeholder="mini_description" required autofocus maxlength="150"
                                         value="<?php echo htmlspecialchars($row->mini_description); ?>"
                                      <?php if ($_SESSION["perm_level"] == 3) {
                                          echo "readonly";
                                      } ?>/>

                              </li>


                          </ul>

                          <div class="buttons">
                              <input
                                  <?php if ($_SESSION["perm_level"] == 3) {
                                      echo "type=\"hidden\"";
                                  } else {
                                      echo "type=\"submit\"";
                                  }
                                  ?>
                                      name="saveChanges" value="Save Changes"

                              />
                              <input type="submit" formnovalidate name="cancel"

                                  <?php if ($_SESSION["perm_level"] == 3) {
                                      echo "value=\"Back\"";
                                  } else {
                                      echo "value=\"Cancel\"";
                                  }
                                  ?> />
                          </div>

                      </form>

                  <?php }

              }?>


		  </div> <!-- MainAdminContent -->


<?php include "templates/admin/include/admin_footer.php" ?>