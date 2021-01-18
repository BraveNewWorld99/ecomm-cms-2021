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

    <h1>Add Product</h1>



    <?php

    if ( isset( $_POST['saveChanges'] ) ) {

        //User has posted the product edit form: save the changes.

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('addProduct');

        if ($token_verified = true) {


            //SANITIZE INPUTS
            $sku = filter_var($_POST["sku"], FILTER_SANITIZE_STRING);
            $thumb = filter_var($_POST["thumb"], FILTER_SANITIZE_STRING);
            $midsize = filter_var($_POST["midsize"], FILTER_SANITIZE_STRING);
            $style = filter_var($_POST["style"], FILTER_SANITIZE_STRING);
            $price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT);
            $medium = filter_var($_POST["medium"], FILTER_SANITIZE_STRING);
            $artist = filter_var($_POST["artist"], FILTER_SANITIZE_STRING);
            $mini_description = filter_var($_POST["mini_description"], FILTER_SANITIZE_STRING);

            //Only allow for image type extensions
            $thumb_extension = pathinfo($thumb, PATHINFO_EXTENSION);
            $midsize_extension = pathinfo($midsize, PATHINFO_EXTENSION);

            if(($thumb_extension=='jpg' || $thumb_extension=='jpeg' || $thumb_extension=='png') AND ($midsize_extension=='jpg' || $midsize_extension=='jpeg' || $midsize_extension=='png'))
            {

                //Append directory to thumb and midsize
                $thumb = "product_images/thumbs/" . $thumb;
                $midsize = "product_images/midsize/" . $midsize;

                // Update the Product using the Product Class
                $product = new Product;
                $product->insertProduct($sku, $thumb, $midsize, $style, $price, $medium, $artist, $mini_description);

            }
            else
            {
                //TODO Need to display error message on admin page explaining what went wrong.
                header("Location: admin.php");
            }

        }

        else {

            echo "Site down for maintenance";
        }

    } elseif ( isset( $_POST['cancel'] ) ) {

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('addProduct');

        if ($token_verified = true) {

            // User has cancelled their edits: return list pages
            header("Location: admin.php");

        }

        else {

            echo "Site down for maintenance";
        }

    }

            //Create form token in session.
            $sec = new Sec;
            $newToken = $sec->generateFormToken('addProduct');

            ?>

            <form action="admin.php?action=addProduct" method="post">
                <input type="hidden" name="token" value="<?php echo $newToken; ?>">
                <input type="hidden" name="submitted" value="true"/>

                <ul>

                    <li>
                        <label for="sku">SKU</label>
                        <input type="text" name="sku" id="sku" placeholder="sku" required autofocus
                               maxlength="24" value=""
                            <?php if ($_SESSION["perm_level"] == 3) {
                                echo "readonly";
                            } ?>/>

                    </li>

                    <li>
                        <label for="thumb">Thumb</label>
                        <input type="file" name="thumb" id="thumb" placeholder="THUMB" accept="image/png, image/jpeg" required autofocus
                               maxlength="100" value=""
                            <?php if ($_SESSION["perm_level"] == 3) {
                                echo "readonly";
                            } ?>/>

                    </li>

                    <li>
                        <label for="midsize">Midsize Image</label>
                        <input type="file" name="midsize" id="midsize" placeholder="midsize image" accept="image/png, image/jpeg" required autofocus
                               maxlength="100" value=""
                            <?php if ($_SESSION["perm_level"] == 3) {
                                echo "readonly";
                            } ?>/>
                    </li>

                    <li>
                        <label for="large">Large Image</label>
                        <input type="file" name="large" id="large" placeholder="large image" accept="image/png, image/jpeg" required autofocus
                               maxlength="100" value=""
                            <?php if ($_SESSION["perm_level"] == 3) {
                                echo "readonly";
                            } ?>/>
                    </li>

                    <li>
                        <label for="style">Style</label>
                        <input type="text" name="style" id="style" placeholder="style" required autofocus
                               maxlength="50" value=""
                            <?php if ($_SESSION["perm_level"] == 3) {
                                echo "readonly";
                            } ?>/>

                    </li>

                    <li>
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" placeholder="price" required autofocus
                               maxlength="6" value=""
                            <?php if ($_SESSION["perm_level"] == 3) {
                                echo "readonly";
                            } ?>/>

                    </li>

                    <li>
                        <label for="medium">Medium</label>
                        <input type="text" name="medium" id="medium" placeholder="medium" required autofocus
                               maxlength="50" value=""
                            <?php if ($_SESSION["perm_level"] == 3) {
                                echo "readonly";
                            } ?>/>

                    </li>

                    <li>
                        <label for="artist">Artist</label>
                        <input type="text" name="artist" id="artist" placeholder="artist" required autofocus
                               maxlength="50" value=""
                            <?php if ($_SESSION["perm_level"] == 3) {
                                echo "readonly";
                            } ?>/>

                    </li>

                    <li>
                        <label for="mini_description">Description</label>
                        <input type="text" name="mini_description" id="mini_description"
                               placeholder="mini_description" required autofocus maxlength="150"
                               value=""
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

</div> <!-- MainAdminContent -->


<?php include "templates/admin/include/admin_footer.php" ?>
