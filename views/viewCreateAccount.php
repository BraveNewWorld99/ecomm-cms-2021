<div class="create_account_title"><h3>Create an Account</h3></div>

<div class="create_account_form_section">

<form action="include/front_validate.php" method="POST">
    <input type="hidden" name="token" value="<?php echo $newToken; ?>">
    <input type="hidden" name="validation_type" value="php"/>
    <input type="hidden" name="referrer_url" value="http://localhost/cms5/views/viewFrontPage.php?view=viewCreateAccount" >

    <div class="form_group">
        <label for="user_first_name">First Name</label>
        <input type="text" name="user_first_name" id="user_first_name" reqiured maxlength="50" value="<?php if(!empty($_SESSION['post-data']['user_first_name'])) { echo $_SESSION['post-data']['user_first_name']; } ?>" onblur="validate(this.value, this.id)" />
        <span id="user_first_name_failed" class="<?php if (isset($_SESSION['errors']['user_first_name'])) {echo $_SESSION['errors']['user_first_name']; } ?>">Please enter first name with only a-z characters.</span>
    </div>

    <div class="form_group">
        <label for="user_last_name">Last Name</label>
        <input type="text" name="user_last_name" id="user_last_name" required maxlength="50" value="<?php if(!empty($_SESSION['post-data']['user_last_name'])) { echo $_SESSION['post-data']['user_last_name']; } ?>" onblur="validate(this.value, this.id)"  />
        <span id="user_last_name_failed" class="<?php if(isset($_SESSION['errors']['user_last_name'])) { echo $_SESSION['errors']['user_last_name']; } ?>">Please enter last name with only a-z characters.</span>
    </div>


    <div class="form_group">
        <label for="user_login">Email Address</label>
        <input type="text" name="user_login" id="user_login" required maxlength="50" value="<?php if(!empty($_SESSION['post-data']['user_login'])) { echo $_SESSION['post-data']['user_login']; } ?>" onblur="validate(this.value, this.id)" />
        <span id="user_login_failed" class="<?php if(isset($_SESSION['errors']['user_login'] )) { echo $_SESSION['errors']['user_login']; } ?>">User login already exists or invalid email format.</span>
    </div>


    <div class="form_group">
        <label for="user_password">Password</label>
        <input type="text" name="user_password" id="user_password" required maxlength="90" value="" onblur="validate(this.value, this.id)"  />
        <span id="user_password_failed" class="<?php if(isset($_SESSION['errors']['user_password'])) { echo $_SESSION['errors']['user_password']; } ?>">Password must contain at least 8 characters.</span>
    </div>

    <div class="form_group">
        <label for="user_password_confirm">Confirm Password</label>
        <input type="text" name="user_password_confirm" id="user_password_confirm" required maxlength="90" value="" onblur="validate(this.value, this.id)"  />
        <span id="user_password_confirm" class="<?php if (isset($_SESSION['errors']['user_password_confirm'])) { echo $_SESSION['errors']['user_password_confirm']; } ?>">Password must contain at least 8 characters.</span>
        <span id="passwords_no_match" class="<?php if (!empty($passwords_no_match)) { echo $passwords_no_match; }; ?>">Passwords do not match.</span>
    </div>

    <button type="submit" id="create_user_account" name="create_user_account" value="create_user_account">Register</button>
    <button type="submit" id="cancel_create_account" name="cancel_create_account" value="cancel_create_account">Cancel</button>

</form>

</div> <!-- End create_account_form_section -->
