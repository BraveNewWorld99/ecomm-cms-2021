<?php
//TODO This is now working with drop-down menus, just need to fix style for nav menu.

echo "<nav>";

$pages = new Page;
$rows = $pages->getTopMenuItems();

if (!empty($rows)) {

    echo "<ul>";

    foreach ($rows as $value) {


        $parent_name = filter_var($value['parentName'], FILTER_SANITIZE_STRING);
        $url = filter_Var($value['url'], FILTER_SANITIZE_STRING);

        //TODO here the first item in the database MUST be a top_menu_item, need better check than this.
        echo "<li><a href=\"viewFrontPage&pageID=" . filter_var($value['page_id'], FILTER_SANITIZE_NUMBER_INT) . "\">" .
            filter_var($value['pageTitle'], FILTER_SANITIZE_STRING) . "</a>";

        $child_pages = new Page;
        $child_items = $child_pages->getChildPagesfromParent($url);

        //TODO need to make this only appear when it's a top_menu_item with no children
        //TODO reference cms5_menu/menu3.php -- this is the working model
        if (empty($child_items)){

            echo "</li>";

        }

        if (!empty($child_items)){

            echo "<ul>";

            foreach ($child_items as $value2) {


                echo "<li><a href=\"viewFrontPage&pageID=" . filter_var($value2['page_id'], FILTER_SANITIZE_NUMBER_INT) . "\">" .
                    filter_var($value2['pageTitle'], FILTER_SANITIZE_STRING) . "</a></li>";

            }

            echo "</ul>";

        }

    }

    echo "</ul>";

}

echo "</nav>";

?>