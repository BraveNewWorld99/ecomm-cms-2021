<?php 

/**
 * CMS by Adam Hott
 * Copyright 2019
 * createAdmin.php
 *
 * Notes: Work to be done in cleaning up the formatting, do the <div> elements match up here?
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
		  
		  <h1>Create Admins</h1>
		  


<?php
//Create form token in session.
$sec = new Sec;
$newToken = $sec->generateFormToken('createAdmin');

?>
		  
		 <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
             <input type="hidden" name="token" value="<?php echo $newToken; ?>">
             <input type="hidden" name="id"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
           <li>
            <label for="login">Login</label>
            <input type="text" name="login" id="login" placeholder="Login" required autofocus maxlength="255"
                   value="<?php if (isset($_POST['login'])) echo htmlspecialchars($_POST['login'], ENT_QUOTES); ?>"
            />
          </li>
		  
          <li>
            <label for="password">Password</label>
            <input type="text" name="password" id="password" placeholder="Password" required autofocus minlength="8" maxlength="255"
                   value="<?php if (isset($_POST['password'])) echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                   title="One number, one upper, one lower, one special, with 8 to 12 characters"
            />
          </li>
		  
		  <li>
           <label for="perm_name">Permission Level</label>
            <select name="perm_name" id="perm_name">
				<option value="admin">Administrator</option>
				<option value="editor">Website Editor</option>
				<option value="manager">Manager</option>
			</select>
			
          </li>
  
        </ul>
 
        <div class="buttons">
          <input type="submit" name="saveChanges" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>

          </div> <!-- MainAdminContent -->

<?php include "templates/admin/include/admin_footer.php" ?>