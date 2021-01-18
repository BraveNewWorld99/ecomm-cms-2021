<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * loginForm.php
 */
 
 ?>


<?php include "templates/admin/include/admin_header.php" ?>

<?php
//Create form token in session.
$sec = new Sec;
$newToken = $sec->generateFormToken('loginForm');

?>

 
      <form action="admin.php?action=login" method="post" style="width: 50%;">
          <input type="hidden" name="token" value="<?php echo $newToken; ?>">
        <input type="hidden" name="login" value="true" />
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
          <li>
            <label for="username">Login</label>
            <input type="text" name="username" id="login" placeholder="Login" required autofocus maxlength="20" />
          </li>
 
          <li>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required maxlength="20" />
          </li>
		  
		  <li>
		    <a style="padding-left: 80px;" href="admin.php?action=resetPassword">Forgot password</a>
		  </li>
 
        </ul>
 
        <div class="buttons">
          <input type="submit" name="login" value="login" />
        </div>
 
      </form>
 
<?php include "templates/admin/include/admin_footer.php" ?>