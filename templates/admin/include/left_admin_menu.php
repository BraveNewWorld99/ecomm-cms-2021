<?php

    echo "<div class=\"row\">";
		echo "<div id=\"leftMenu\" class=\"col-6 col-md-2\">";

			echo "<ul>";

				echo "<li><b>Edit Pages</b></li>";

				  foreach ( $results['pages'] as $page ) {

					echo "\t<li><a href=\"admin.php?action=editPage&amp;pageId=" . $page->page_id . "\">" . $page->url . "</a></li>\n";

					}

				    if ($_SESSION["perm_level"] == 1) {

						echo "<li><b>Admins</b></li>\n";
						echo "<li><a href=\"admin.php?action=createAdmin\">Create Admins</a></li>\n";
					}

                        echo "<li><b>Users</b></li>\n";
                        echo "<li><a href=\"admin.php?action=createUser\">Create User</a></li>\n";
                        echo "<li><a href=\"admin.php?action=searchUsers\">Search Users</a></li>\n";

					    echo "<li><b>Products</b></li>\n";
                        echo "<li><a href=\"admin.php?action=addProduct\">Add Products</a></li>\n";
				        echo "<li><a href=\"admin.php?action=searchProducts\">Search Products</a></li>\n";

				        echo "<li><b>Product Categories</b></li>\n";
				        echo "<li><a href=\"admin.php?action=productCategories\">Categories</a></li>\n";



			echo "</ul>";

	  echo "</div>";

?>