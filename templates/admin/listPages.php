<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * listPages.php
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
 
      <h1>List of Pages</h1>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
 
      <table>
        <tr>
          <th>Page Title</th>
		  <th>URL</th>
        </tr>
 
<?php foreach ( $results['pages'] as $page ) { ?>
 
        <tr onclick="location='admin.php?action=editPage&amp;pageId=<?php echo $page->page_id?>'">
          <td>
            <?php echo $page->pageTitle?>
          </td>
		  <td>
		  <?php echo $page->url?>
		  </td>
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><?php echo $results['totalRows']?> page<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
 <?php if ($_SESSION["perm_level"] != 3) {
      echo "<p><a href=\"admin.php?action=newPage\">Add a New Page</a></p>";
 }?>
	  </div> <!-- MainAdminContent -->
 
<?php include "templates/admin/include/admin_footer.php" ?>