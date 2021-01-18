<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * updatePassword.php
 */
 
 ?>

<?php include "templates/include/admin_header.php" ?>
 
<div>
	
	<?php

    //Create form token in session.
    $sec = new Sec;
    $newToken = $sec->generateFormToken('updatePassword');

    //Get reset token from email.
    $reset_token = $_GET['reset_token'];
	?>
		
	<form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
    <input type="hidden" name="reset_token" value="<?php echo $reset_token ?>"/>
        <input type="hidden" name="token" value="<?php echo $newToken; ?>">
 
	<?php if ( isset( $results['errorMessage'] ) ) { ?>
		<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
		<?php } ?>
		
    
		<ul>        
			<li>
				<label for="password">Enter New Password</label>
				<input type="text" name="password" id="password" placeholder="Enter Password" required autofocus maxlength="255" />
			</li>
			
			<li>
				<label for="password2">Re-Enter New Password</label>
				<input type="text" name="password2" id="password2" placeholder="Re-enter Password" required autofocus maxlength="255" />
			</li>
		  
			<div class="buttons">
				<input type="submit" name="updatePassword" value="Reset Password" />
				<input type="submit" formnovalidate name="cancel" value="Cancel" />
			</div>
		</ul>
	
	</form>
	
 </div>
 
<?php include "templates/include/admin_footer.php" ?>