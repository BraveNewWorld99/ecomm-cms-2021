<?php

echo "<ul id=\"homepage_menu\">";

foreach ($results['pages'] as $page) {
    //viewFrontPage is for the front end of the application.  viewAdminPage is for the back end of the application.
    echo "\t<li><a href=\"index.php?action=viewFrontPage&amp;pageId=" . $page->page_id . "\">" . $page->url . "</a></li>\n";

}

echo "</ul>";

?>