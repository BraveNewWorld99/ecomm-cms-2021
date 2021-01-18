<?php

echo "My account";

if(isset($_POST['logout'])) {

    unset($_SESSION['user_logged_in']);
    unset($_SESSION['user_level']);

}


?>

<form action="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewMyAccount"?>" method="POST">
<button type="submit" id="logout" name="logout" value="try_logout">Logout</button>

</form>

<a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewMyAccountOrders"?>">View Orders</a>



