<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * editPage.php
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
 
      <h1><?php echo $results['pageTitle']?></h1>

          <?php
          //Create form token in session.
          $sec = new Sec;
          $newToken = $sec->generateFormToken('editPage');

          ?>
 
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
          <input type="hidden" name="token" value="<?php echo $newToken; ?>">
        <input type="hidden" name="pageId" value="<?php echo $results['page']->page_id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
           <li>
            <label for="url">URL</label>
            <input type="text" name="url" id="url" placeholder="URL" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['page']->url)?>"
			<?php if ($_SESSION["perm_level"] == 3) {
				echo "readonly";
			} ?>/>
			
          </li>

            <li>
                <label for="parentName">PARENT URL</label>
                <select name="parentName" id="parentName" required>
                    <option value="top_menu_item">None. This is a Top Menu Item</option>
                    <?php

                    $rows = new Page;
                    $rows = $rows->getUrlParentNameList();

                    foreach ($rows as $value){

                        echo "<option value=\"" . $value[0] . "\">" . $value[0] . "</option>";
                    }

                    ?>

                </select>

            </li>
		  
          <li>
            <label for="pageTitle">Page Title</label>
            <input type="text" name="pageTitle" id="pageTitle" placeholder="Page title" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['page']->pageTitle)?>"
			<?php if ($_SESSION["perm_level"] == 3) {
				echo "readonly";
			} ?>/>
          </li>
 
 
          <li>
            <label for="content">Page Content</label>
            <textarea name="pageContent" id="pageContent" placeholder="The HTML content of the page" required maxlength="100000" style="height: 30em;" 
			<?php if ($_SESSION["perm_level"] == 3) {
				echo "readonly";
			} ?>
			><?php echo htmlspecialchars( $results['page']->pageContent )?></textarea>
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
 
<?php if ( $results['page']->page_id ) { ?>
<?php if ($_SESSION["perm_level"] != 3) {
      echo "<p><a href=\"admin.php?action=deletePage&amp;pageId=" . $results['page']->page_id . "\"onclick=\"return confirm('Delete This Page?')\">Delete This Page</a></p>";
      } }?>
		</div> <!-- MainAdminContent -->
		
<?php include "templates/admin/include/admin_footer.php" ?>