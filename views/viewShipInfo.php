<div class="row">

<div class="ship_info_wrapper">

<div class="order_summary">

<div class="order_summary_title"><h3>Order Summary</h3></div>

<?php

//Get User Session
$user_session_id = session_id();

//Get Cart Items By User Session ID
$product = new Product;
$rows = $product->getCartBySession($user_session_id);

//TODO consider putting higher above, it's breaking html with an extra </div> being added due to code location here
if (isset($rows)) {

echo "<table class=\"checkout_table\">";

$grand_total = 0;

foreach ($rows as $value) {

    $price_calc = $value['price'];
    $quantity_calc = $value['quantity'];
    $total_price = $price_calc * $quantity_calc;
    $grand_total = $grand_total + $total_price;

    echo "<tr><td><div class=\"checkout_img_container\"><img class=\"checkout_img\" src=" . BASE_URI . $value['midsize'] . "></div></td><td><div class=\"checkout_item_description\">" . $value['mini_description'] .
        "</div></td><td><div class=\"checkout_total_price\">" . $product->money_format('%i', $total_price / 100) . "</div></td></tr>";

}

//TODO need to fix alignment in of this div in css
echo "<tr><td></td><td></td><td><div class=\"check_grand_total\">" . $product->money_format('%i', $grand_total / 100) . "</div></td>";

echo "</table>";

echo "</div>"; //End order_summary

echo "<div class=\"ship_info_details\">";

//Create form token in session.
$sec = new Sec;
$newToken = $sec->generateFormToken('viewShipInfo');

if(empty($user_logged_in)) {


    echo "<div class=\"login_title\"><h3>Login or Registration Required</h3></div>";

    echo "<form action=\"" . BASE_URI . "views/viewFrontPage.php?view=viewRegisterLogin\" method=\"POST\">";
    echo  "<input type=\"hidden\" name=\"ship_info_referrer_url\" value=\"http://localhost/cms5/views/viewFrontPage.php?view=viewShipInfo\">";
    echo  "<button type=\"submit\" id=\"ship_info_login_redirect\" name=\"ship_info_login_redirect\" value=\"login_redirect\">";
    echo  "Register or Login";
    echo  "</button>";

    echo "</form>";


} else {

$user = new User;
$ship_info = $user->getShipInfo($user_logged_in);


?>
    <div class="purchase_links">
    <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewShipInfo"?>">Shipping Info ></a>
    <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewBillInfo"?>">Billing Info ></a>
    <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewPaymentInfo"?>">Payment Info</a>
    </div>

    <div class="shipping_address_title"><h3>Shipping Address</h3></div>

<?php

if(!empty($ship_info[0]['ship_first_name']) && !empty($ship_info[0]['ship_last_name'])) {

    ?>

    <div id="hidden_ship_first_name" class="hidden"><?php echo $ship_info[0]['ship_first_name'] ?></div>
    <div id="hidden_ship_last_name" class="hidden"><?php echo $ship_info[0]['ship_last_name'] ?></div>
    <div id="hidden_ship_address1" class="hidden"><?php echo $ship_info[0]['ship_address1'] ?></div>
    <div id="hidden_ship_address2" class="hidden"><?php echo $ship_info[0]['ship_address2'] ?></div>
    <div id="hidden_ship_city" class="hidden"><?php echo $ship_info[0]['ship_city'] ?></div>
    <div id="hidden_ship_state" class="hidden"><?php echo $ship_info[0]['ship_state'] ?></div>
    <div id="hidden_ship_country" class="hidden"><?php echo $ship_info[0]['ship_country'] ?></div>
    <div id="hidden_ship_zip_code_post_code" class="hidden"><?php echo $ship_info[0]['ship_zip_code_post_code'] ?></div>


    <div class="pull_ship_info">
        <input type="checkbox" id="pull_ship_info" name="pull_ship_info" value="">
        <label for="pull_ship_info">Use saved account shipping information.</label>
    </div>

    <?php

} //end empty ship_first_name


?>




        <div class="ship_info_form_section">

        <form action="include/front_validate.php" method="POST" id="ship_info_details">
            <input type="hidden" name="token" value="<?php echo $newToken; ?>">
            <input type="hidden" name="validation_type" value="php"/>
            <input type="hidden" name="referrer_url"
                   value="http://localhost/cms5/views/viewFrontPage.php?view=viewShipInfo">

            <div class="form_group_inline">
                <label for="ship_first_name">First Name</label>
                <input type="text" name="ship_first_name" id="ship_first_name" required autofocus maxlength="50"
                       value="" onblur="validate(this.value, this.id)"/>
                <span id="ship_first_name_failed" class="<?php if (isset($_SESSION['errors']['ship_first_name'])) {
                    echo $_SESSION['errors']['ship_first_name'];
                } ?>">Please enter first name with only a-z characters.</span>
            </div>

            <div class="form_group_inline">
                <label for="ship_last_name">Last Name</label>
                <input type="text" name="ship_last_name" id="ship_last_name" required maxlength="50" value=""
                       onblur="validate(this.value, this.id)"/>
                <span id="ship_last_name_failed" class="<?php if (isset($_SESSION['errors']['ship_last_name'])) {
                    echo $_SESSION['errors']['ship_last_name'];
                } ?>">Please enter first name with only a-z characters.</span>
            </div>

            <div class="form_group">
                <label for="ship_address1">Address</label>
                <input type="text" name="ship_address1" id="ship_address1" required maxlength="50" value=""
                       onblur="validate(this.value, this.id)"/>
                <span id="ship_address1_failed" class="<?php if (isset($_SESSION['errors']['ship_address1'])) {
                    echo $_SESSION['errors']['ship_address1'];
                } ?>">Please enter first name with only a-z characters.</span>
            </div>

            <div class="form_group">
                <label for="ship_address2">Apartment, Suite, etc. (optional)</label>
                <input type="text" name="ship_address2" id="ship_address2" maxlength="50" value=""
                       onblur="validate(this.value, this.id)"/>
                <span id="ship_address2_failed" class="<?php if (isset($_SESSION['errors']['ship_address2'])) {
                    echo $_SESSION['errors']['ship_address2'];
                } ?>">Please enter first name with only a-z characters.</span>
            </div>

            <div class="form_group">
                <label for="ship_city">City</label>
                <input type="text" name="ship_city" id="ship_city" required maxlength="50" value=""
                       onblur="validate(this.value, this.id)"/>
                <span id="ship_city_failed" class="<?php if (isset($_SESSION['errors']['ship_city'])) {
                    echo $_SESSION['errors']['ship_city'];
                } ?>">Please enter first name with only a-z characters.</span>
            </div>

            <div class="form_group_inline">
                <label for="ship_country">Country</label>
                <input type="text" name="ship_country" id="ship_country" required maxlength="50" readonly
                       value="United States" placeholder="United States" onblur="validate(this.value, this.id)"/>
                <span id="ship_country_failed" class="<?php if (isset($_SESSION['errors']['ship_country'])) {
                    echo $_SESSION['errors']['ship_country'];
                } ?>">Please enter first name with only a-z characters.</span>
            </div>


            <div class="form_group_inline">
                <label for="ship_state">State</label>

                <?php
                $product = new Product;
                $drop = $product->getShipStateDropDown();
                echo $drop;
                ?>

            </div>


            <div class="form_group_inline">
                <label for="ship_zip_code_post_code">Zip Code</label>
                <input type="text" name="ship_zip_code_post_code" id="ship_zip_code_post_code" required maxlength="10"
                       value="" onblur="validate(this.value, this.id)"/>
                <span id="ship_zip_code_post_code_failed"
                      class="<?php if (isset($_SESSION['errors']['ship_zip_code_post_code'])) {
                          echo $_SESSION['errors']['ship_zip_code_post_code'];
                      } ?>">Please enter first name with only a-z characters.</span>
            </div>

            <button type="submit" id="insert_ship_info" name="insert_ship_info" value="insert_ship_info">Continue to
                Payment
            </button>

        </form>

    </div> <!-- End ship_info_form_section

<?php

    } // End if(empty($user_logged_in))

    echo "</div>";

    } else {

    echo "<div class=\"no_ship_cart_items\">There are no items in your cart.</div>";

    }

echo "</div>"; //end ship_info_wrapper



echo "</div>"; //End row

echo "<!-- End row -->";

?>

