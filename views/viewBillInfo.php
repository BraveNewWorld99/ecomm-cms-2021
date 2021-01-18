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

            echo "<div class=\"bill_info_details\">";

            //Create form token in session.
            $sec = new Sec;
            $newToken = $sec->generateFormToken('viewBillInfo');

            //Todo chagned this temporarily to !empty for testing.
            if(empty($user_logged_in)) {


                echo "<div class=\"login_title\"><h3>Login or Registration Required</h3></div>";

                echo "<form action=\"" . BASE_URI . "views/viewFrontPage.php?view=viewRegisterLogin\" method=\"POST\">";
                echo  "<input type=\"hidden\" name=\"bill_info_referrer_url\" value=\"http://localhost/cms5/views/viewFrontPage.php?view=viewBillInfo\">";
                echo  "<button type=\"submit\" id=\"bill_info_login_redirect\" name=\"bill_info_login_redirect\" value=\"login_redirect\">";
                echo  "Register or Login";
                echo  "</button>";

                echo "</form>";


            } else {


            $user = new User;
            $bill_info = $user->getBillInfo($user_logged_in);

            ?>

            <div class="purchase_links">
                <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewShipInfo"?>">Shipping Info ></a>
                <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewBillInfo"?>">Billing Info ></a>
                <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewPaymentInfo"?>">Payment Info</a>
            </div>

            <div class="billing_address_title"><h3>Billing Address</h3></div>

            <?php

            if(!empty($bill_info[0]['bill_first_name']) && !empty($bill_info[0]['bill_last_name'])) {

            ?>

            <div id="hidden_bill_first_name" class="hidden"><?php echo $bill_info[0]['bill_first_name'] ?></div>
            <div id="hidden_bill_last_name" class="hidden"><?php echo $bill_info[0]['bill_last_name'] ?></div>
            <div id="hidden_bill_address1" class="hidden"><?php echo $bill_info[0]['bill_address1'] ?></div>
            <div id="hidden_bill_address2" class="hidden"><?php echo $bill_info[0]['bill_address2'] ?></div>
            <div id="hidden_bill_city" class="hidden"><?php echo $bill_info[0]['bill_city'] ?></div>
            <div id="hidden_bill_state" class="hidden"><?php echo $bill_info[0]['bill_state'] ?></div>
            <div id="hidden_bill_country" class="hidden"><?php echo $bill_info[0]['bill_country'] ?></div>
            <div id="hidden_bill_zip_code_post_code" class="hidden"><?php echo $bill_info[0]['bill_zip_code_post_code'] ?></div>


            <div class="pull_bill_info">
                <input type="checkbox" id="pull_bill_info" name="pull_bill_info" value="">
                <label for="pull_bill_info">Use saved account billing information.</label>
            </div>

                <?php

            } //end empty bill_first_name and bill_last_name

            $user = new User;
            $ship_info = $user->getShipInfo($user_logged_in);

            if(!empty($ship_info[0]['ship_first_name']) && !empty($ship_info[0]['ship_last_name'])) {

                ?>

                <div id="hidden_ship_first_name" class="hidden"><?php echo $ship_info[0]['ship_first_name'] ?></div>
                <div id="hidden_ship_last_name" class="hidden"><?php echo $ship_info[0]['ship_last_name'] ?></div>
                <div id="hidden_ship_address1" class="hidden"><?php echo $ship_info[0]['ship_address1'] ?></div>
                <div id="hidden_ship_address2" class="hidden"><?php echo $ship_info[0]['ship_address2'] ?></div>
                <div id="hidden_ship_city" class="hidden"><?php echo $ship_info[0]['ship_city'] ?></div>
                <div id="hidden_ship_state" class="hidden"><?php echo $ship_info[0]['ship_state'] ?></div>
                <div id="hidden_ship_country" class="hidden"><?php echo $ship_info[0]['ship_country'] ?></div>
                <div id="hidden_ship_zip_code_post_code"
                     class="hidden"><?php echo $ship_info[0]['ship_zip_code_post_code'] ?></div>


                <div class="pull_ship_info">
                    <input type="checkbox" id="pull_ship_to_bill_info" name="pull_ship_to_bill_info" value="">
                    <label for="pull_ship_to_bill_info">Billing information same as shipping information.</label>
                </div>

                <?php

            } //end empty ship_first_name and ship_last_name

            ?>

            <div class="bill_info_form_section">

                <form action="include/front_validate.php" method="POST" id="bill_info_details">
                    <input type="hidden" name="token" value="<?php echo $newToken; ?>">
                    <input type="hidden" name="validation_type" value="php"/>
                    <input type="hidden" name="referrer_url" value="http://localhost/cms5/views/viewFrontPage.php?view=viewBillInfo" >

                    <div class="form_group_inline">
                        <label for="bill_first_name">First Name</label>
                        <input type="text" name="bill_first_name" id="bill_first_name" required autofocus maxlength="50" value="" onblur="validate(this.value, this.id)"/>
                        <span id="bill_first_name_failed" class="<?php if(isset($_SESSION['errors']['bill_first_name'])) { echo $_SESSION['errors']['bill_first_name']; } ?>">Please enter first name with only a-z characters.</span>
                    </div>

                    <div class="form_group_inline">
                        <label for="bill_last_name">Last Name</label>
                        <input type="text" name="bill_last_name" id="bill_last_name" required maxlength="50" value="" onblur="validate(this.value, this.id)"/>
                        <span id="bill_last_name_failed" class="<?php if(isset($_SESSION['errors']['bill_last_name'])) { echo $_SESSION['errors']['bill_last_name']; } ?>">Please enter first name with only a-z characters.</span>
                    </div>

                    <div class="form_group">
                        <label for="bill_address1">Address</label>
                        <input type="text" name="bill_address1" id="bill_address1" required maxlength="50" value="" onblur="validate(this.value, this.id)"/>
                        <span id="bill_address1_failed" class="<?php if(isset($_SESSION['errors']['bill_address1'])) { echo $_SESSION['errors']['bill_address1']; } ?>">Please enter first name with only a-z characters.</span>
                    </div>

                    <div class="form_group">
                        <label for="bill_address2">Apartment, Suite, etc. (optional)</label>
                        <input type="text" name="bill_address2" id="bill_address2" maxlength="50" value="" onblur="validate(this.value, this.id)"/>
                        <span id="bill_address2_failed" class="<?php if(isset($_SESSION['errors']['bill_address2'])) { echo $_SESSION['errors']['bill_address2']; } ?>">Please enter first name with only a-z characters.</span>
                    </div>

                    <div class="form_group">
                        <label for="bill_city">City</label>
                        <input type="text" name="bill_city" id="bill_city" required maxlength="50" value="" onblur="validate(this.value, this.id)"/>
                        <span id="bill_city_failed" class="<?php if(isset($_SESSION['errors']['bill_city'])) { echo $_SESSION['errors']['bill_city']; } ?>">Please enter first name with only a-z characters.</span>
                    </div>

                    <div class="form_group_inline">
                        <label for="bill_country">Country</label>
                        <input type="text" name="bill_country" id="bill_country" required maxlength="50" readonly value="United States" placeholder="United States" onblur="validate(this.value, this.id)"/>
                        <span id="bill_country_failed" class="<?php if(isset($_SESSION['errors']['bill_country'])) { echo $_SESSION['errors']['bill_country']; } ?>">Please enter first name with only a-z characters.</span>
                    </div>


                    <div class="form_group_inline">
                        <label for="bill_state">State</label>

                        <?php
                        $product = new Product;
                        $drop = $product->getBillStateDropDown();
                        echo $drop;
                        ?>

                    </div>


                    <div class="form_group_inline">
                        <label for="bill_zip_code_post_code">Zip Code</label>
                        <input type="text" name="bill_zip_code_post_code" id="bill_zip_code_post_code" required maxlength="10" value="" onblur="validate(this.value, this.id)"/>
                        <span id="bill_zip_code_post_code_failed" class="<?php if(isset($_SESSION['errors']['bill_zip_code_post_code'])) { echo $_SESSION['errors']['bill_zip_code_post_code']; } ?>">Please enter first name with only a-z characters.</span>
                    </div>

                    <button type="submit" id="insert_bill_info" name="insert_bill_info" value="insert_bill_info">Continue to Payment
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

