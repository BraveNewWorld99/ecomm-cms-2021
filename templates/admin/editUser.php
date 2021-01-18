<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * createUser.php
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

        <h1>Edit User</h1>


<?php
    //Sanitize input and cast to integer
    $user_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $user_id = (int)$user_id;

    $user = new User();
    $row = $user->getUserByID($user_id);

    //Create form token in session.
    $sec = new Sec;
    $newToken = $sec->generateFormToken('editUser');

    //TODO Need to change htmlspecial chargs to filter_var.
?>

    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="user_id" id="user_id" value="<?php if (isset($row['user_id'])) echo filter_var($row['user_id'], FILTER_SANITIZE_NUMBER_INT); ?>" />
        <input type="hidden" name="token" value="<?php echo $newToken; ?>">

        <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>

        <ul>

            <li>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title" required autofocus maxlength="255"
                       value="<?php if (isset($row['title'])) echo filter_var($row['title'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="First Name" required autofocus maxlength="255"
                       value="<?php if (isset($row['first_name'])) echo filter_var($row['first_name'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required autofocus maxlength="255"
                       value="<?php if (isset($row['last_name'])) echo filter_var($row['last_name'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Email" required autofocus maxlength="255"
                       value="<?php if (isset($row['email'])) echo filter_var($row['email'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>


            <li>
                <label for="address1">Address 1</label>
                <input type="text" name="address1" id="address1" placeholder="Address 1" required autofocus maxlength="255"
                       value="<?php if (isset($row['address1'])) echo filter_var($row['address1'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="address2">Address 2</label>
                <input type="text" name="address2" id="address2" placeholder="Address 2" required autofocus maxlength="255"
                       value="<?php if (isset($row['address2'])) echo filter_var($row['address2'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="city">City</label>
                <input type="text" name="city" id="city" placeholder="City" required autofocus maxlength="255"
                       value="<?php if (isset($row['city'])) echo filter_var($row['city'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="state">State</label>
                <input type="text" name="state" id="state" placeholder="State" required autofocus maxlength="255"
                       value="<?php if (isset($row['state'])) echo filter_var($row['state'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="country">Country</label>
                <input type="text" name="country" id="country" placeholder="Country" required autofocus maxlength="255"
                       value="<?php if (isset($row['country'])) echo filter_var($row['country'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="zip_code_post_code">Zip Code</label>
                <input type="text" name="zip_code_post_code" id="zip_code_post_code" placeholder="Zip Code" required autofocus maxlength="255"
                       value="<?php if (isset($row['zip_code_post_code'])) echo filter_var($row['zip_code_post_code'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Phone" required autofocus maxlength="255"
                       value="<?php if (isset($row['phone'])) echo filter_var($row['phone'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="secret">Secret</label>
                <input type="text" name="secret" id="secret" placeholder="Secret" required autofocus maxlength="255"
                       value="<?php if (isset($row['secret'])) echo filter_var($row['secret'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

        </ul>

        <div class="buttons">
            <input type="submit" name="saveChanges" value="Save Changes" />
            <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>

    </form>

    </div> <!-- MainAdminContent -->


<?php include "templates/admin/include/admin_footer.php" ?>