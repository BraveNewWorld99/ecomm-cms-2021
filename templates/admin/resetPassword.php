<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 *
 * Notes: Do I need to put this live to test the sendMail function?
 *
 */
 
 ?>


<?php include "templates/include/admin_header.php" ?>
 
<div>

    <?php
    //Create form token in session.
    $sec = new Sec;
    $newToken = $sec->generateFormToken('resetPassword');

    ?>
	 
	<form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="token" value="<?php echo $newToken; ?>">
    <input type="hidden" name="id"/>
 
	<?php if ( isset( $results['errorMessage'] ) ) { ?>
		<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
		<?php } ?>
    
		<ul>        
			<li>
				<label for="login">Enter Login</label>
				<input type="text" name="login" id="login" placeholder="Enter Login" required autofocus maxlength="255" />
			</li>
		  
			<div class="buttons">
				<input type="submit" name="sendEmail" value="Send Reset Email" />
				<input type="submit" formnovalidate name="cancel" value="Cancel" />
			</div>
		</ul>
	
	</form>
	
 </div>
 
<?php include "templates/include/admin_footer.php" ?>