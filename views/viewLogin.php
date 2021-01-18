<div class="login">

    <div class="login_section">

        <h4>Already registered?</h4>

        <form action="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewLogin"?>" method=POST >

            <input type="hidden" name="token" value="<?php echo $newToken; ?>">

            <div class="form_group">
                <label for="user_login">Email Address</label>
                <input type="text" name="user_login" id="user_login" maxlength="50" value="" />
            </div>


            <div class="form_group">
                <label for="user_password">Password</label>
                <input type="text" name="user_password" id="user_password" maxlength="90" value="" />
                <span id="login_failed" class="<?php if (!empty($login_failed)) { echo $login_failed; } ?>">Login Failed</span>
            </div>

            <button type="submit" id="try_user_login" name="try_user_login" value="try_user_login">Login</button>

        </form>

    </div>



</div>
