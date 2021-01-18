<div class="my_account_title"<h3>Account</h3></div>

<div class="create_account_section">

    <h4>New here?</h4>

    <p id="note">Registration is free and easy!</p>

    <ul>
        <li>Faster checkout</li>
        <li>View and track orders</li>
        <li>Save and update account info</li>
    </ul>


    <div class="create_account_link_section">

        <!--TODO Need to make this a form/button, retrieve the POST value referrer URL and pass that into this form
        TODO then post that to the viewCreateAccount form for redirection back to the original referrer URL. -->
        <a id="create_account_link" href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewCreateAccount" ?>">Create Account</a>

    </div>

</div>

<div class="login">

    <div class="login_section">

        <?php

        //Refer from viewShipInfo.php
        $ship_info_login_redirect = "";
        $ship_info_referrer_url = "";
        $bill_info_login_redirect = "";
        $bill_info_referrer_url = "";

        if(isset($_POST['ship_info_login_redirect'])) { $ship_info_login_redirect = filter_var($_POST['ship_info_login_redirect'], FILTER_SANITIZE_STRING); };
        if(isset($_POST['ship_info_referrer_url'])) { $ship_info_referrer_url = filter_var($_POST['ship_info_referrer_url'], FILTER_SANITIZE_STRING); };
        if(isset($_POST['bill_info_login_redirect'])) { $bill_info_login_redirect = filter_var($_POST['bill_info_login_redirect'], FILTER_SANITIZE_STRING); };
        if(isset($_POST['bill_info_referrer_url'])) { $bill_info_referrer_url = filter_var($_POST['bill_info_referrer_url'], FILTER_SANITIZE_STRING); };

         ?>

        <h4>Already registered?</h4>

        <form action="include/front_validate.php" method="POST">
        <input type="hidden" name="validation_type" value="php"/>
        <input type="hidden" name="referrer_url" value="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewRegisterLogin"?>" />
        <input type="hidden" name="token" value="<?php echo $newToken; ?>" />
        <input type="hidden" name="ship_info_login_redirect" value="<?php echo $ship_info_login_redirect; ?>" />
        <input type="hidden" name="ship_info_referrer_url" value="<?php echo $ship_info_referrer_url; ?>" />
        <input type="hidden" name="bill_info_login_redirect" value="<?php echo $bill_info_login_redirect; ?>" />
        <input type="hidden" name="bill_info_referrer_url" value="<?php echo $bill_info_referrer_url; ?>" />

        <div class="form_group">
        <label for="user_login">Email Address</label>
        <input type="text" name="user_login" id="user_login" maxlength="50" value="<?php if(!empty($_SESSION['post-data']['user_login'])) { echo $_SESSION['post-data']['user_login']; } ?>" onblur="validate(this.value, this.id)" />
        <span id="user_login_failed" class="<?php if(isset($_SESSION['errors']['user_login'] )) { echo $_SESSION['errors']['user_login']; } ?>">User login already exists or invalid email format.</span>
        </div>


        <div class="form_group">
        <label for="user_password">Password</label>
        <input type="text" name="user_password" id="user_password" maxlength="90" value="" onblur="validate(this.value, this.id)" />
        <span id="user_password_failed" class="<?php if(isset($_SESSION['errors']['user_password'])) { echo $_SESSION['errors']['user_password']; } ?>">Password must contain at least 8 characters.</span>
        </div>

        <button type="submit" id="try_user_login" name="try_user_login" value="try_user_login">Login</button>

        </form>

    </div>



</div>
