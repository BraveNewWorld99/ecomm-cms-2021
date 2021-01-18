<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * createUser.php
 *
 */
//TODO need to modify this page to match database updates
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

        <h1>Create Users</h1>


<?php
//Create form token in session.
$sec = new Sec;
$newToken = $sec->generateFormToken('createUser');

 ?>


    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="token" value="<?php echo $newToken; ?>">

        <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>

        <ul>

            <li>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['title'])) echo filter_var($_POST['title'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="First Name" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['first_name'])) echo filter_var($_POST['first_name'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['last_name'])) echo filter_var($_POST['last_name'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Email" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['email'])) echo filter_var($_POST['email'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="password">Password</label>
                <input type="text" name="password" id="password" placeholder="Password" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['password'])) echo filter_var($_POST['password'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="address1">Address 1</label>
                <input type="text" name="address1" id="address1" placeholder="Address 1" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['address1'])) echo filter_var($_POST['address1'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="address2">Address 2</label>
                <input type="text" name="address2" id="address2" placeholder="Address 2" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['address2'])) echo filter_var($_POST['address2'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="city">City</label>
                <input type="text" name="city" id="city" placeholder="City" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['city'])) echo filter_var($_POST['city'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="state">State</label>
                <input type="text" name="state" id="state" placeholder="State" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['state'])) echo filter_var($_POST['state'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="country">Country</label>
                <input type="text" name="country" id="country" placeholder="Country" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['country'])) echo filter_var($_POST['country'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="zip_code_post_code">Zip Code</label>
                <input type="text" name="zip_code_post_code" id="zip_code_post_code" placeholder="Zip Code" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['zip_code_post_code'])) echo filter_var($_POST['zip_code_post_code'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Phone" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['phone'])) echo filter_var($_POST['phone'], FILTER_SANITIZE_STRING); ?>"
                />
            </li>

            <li>
                <label for="secret">Secret</label>
                <input type="text" name="secret" id="secret" placeholder="Secret" required autofocus maxlength="255"
                       value="<?php if (isset($_POST['secret'])) echo filter_var($_POST['secret'], FILTER_SANITIZE_STRING); ?>"
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