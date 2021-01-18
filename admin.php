<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * admin.php
 */

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username= isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "resetPassword" && $action != "updatePassword" && $action != "login" && $action != "logout" && !$username ){
	login();
	exit;
}

switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'resetPassword':
	resetPassword();
	break;
  case 'updatePassword':
	updatePassword();
	break;
  case 'newPage':
    newPage();
    break;
  case 'editPage':
    editPage();
    break;
  case 'deletePage':
    deletePage();
    break;
  case 'createAdmin':
	createAdmin();
	break;
	case 'createUser':
        createUser();
        break;
    case 'searchUsers':
        searchUsers();
        break;
    case 'editUser':
        editUser();
        break;
    case 'deleteUser':
        deleteUser();
        break;
	case 'searchProducts':
        searchProducts();
        break;
    case 'editProducts':
        editProducts();
        break;
    case 'addProduct':
        addProduct();
        break;
    case 'productCategories':
        productCategories();
        break;
  default:
    listPages();
}

function login() {

  $results = array();
  $results['pageTitle'] = "Admin Login | Corrupt Robot";


  if ( isset($_POST['username']) && isset($_POST['password']) ) {

    // User has posted the login form: attempt to log the user in
	//TODO Should move this database stuff to the Auth Class if possible

      $sec = new Sec;
      $token_verified = $sec->verifyFormToken('loginForm');

      if ($token_verified = true) {


                //TODO Need to create stored procedure for this
				//get values for login from auth table
				$login = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
				$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$sql = "SELECT * FROM auth WHERE login = :login LIMIT 1";
				$st = $conn->prepare( $sql );
				$st->bindValue( ":login", $login, PDO::PARAM_STR );
				$st->execute();
				$row = $st->fetch();
				$conn = null;		
				
				//$hash_value = array_shift($row);
				$hash_value = $row[4];
				$perm_level = $row[5];
				
				if (password_verify ($password,$hash_value) ) {
					
					// Login successful: Create a session and redirect to the admin homepage
					$_SESSION['username'] = $login;
					$_SESSION['perm_level'] = $perm_level;
					header( "Location: admin.php" );
				
		} else {
 
			// Login failed: display an error message to the user
			$results['errorMessage'] = "Incorrect username or password. Please try again.";	  
			require( TEMPLATE_PATH . "/admin/loginForm.php" );
		}


      }

      else {

          echo "Site down for maintenance.";

      }
 
		} else {
	  
			// User has not posted the login form yet: display the form
			require( TEMPLATE_PATH . "/admin/loginForm.php" );
		}
}

function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" ); 
}

function resetPassword() {
	
  $results = array();
  $results['pageTitle'] = "Reset Password";
  $results['formAction'] = "resetPassword";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
 
  if ( isset( $_POST['sendEmail'] ) ) {

      $sec = new Sec;
      $token_verified = $sec->verifyFormToken('resetPassword');

      if ($token_verified = true) {

          //User has posted their login, send out reset token email
          $email = new Email;
          $email->sendResetEmail($_POST["login"]);

      }

        else {

            echo "Site down for maintenance";
        }
  }
  
  elseif ( isset( $_POST['cancel'] ) ) {

      $sec = new Sec;
      $token_verified = $sec->verifyFormToken('resetPassword');

      if ($token_verified = true) {

          // User has cancelled their edits: return to the pages list
          header("Location: admin.php");

      }

        else {

            echo "Site is down for maintenance";

        }

  }
  
	else {
        // User has not posted the login form yet: display the form
		require( TEMPLATE_PATH . "/admin/resetPassword.php" );
	}
}

function updatePassword() {
	$results = array();
	$results['pageTitle'] = "Update Password";
	$results['formAction'] = "updatePassword";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];


	if (isset($_POST['updatePassword'])) {

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('updatePassword');

        if ($token_verified = true) {

            //check for password mismatch
            $passwordOne = filter_var($_POST["password"], SANITIZE_STRING);
            $passwordTwo = filter_var($_POST["password2"], SANITIZE_STRING);

            if ($passwordOne != $passwordTwo) {
                $reset_token = filter_var($_POST["reset_token"], FILTER_SANITIZE_STRING);
                echo "Your passwords do not match, please re-enter.";
                header("Location: admin.php?action=updatePassword&reset_token=" . $reset_token);
            } else {

                //User has posted their new password to update
                $reset_token = filter_var($_POST["reset_token"], FILTER_SANITIZE_STRING);
                $new_password = new Auth;
                $new_password->updatePassword($passwordOne, $reset_token);
                header("Location: admin.php");
            }

        }

        else {

            echo "Site down for maintenance";
        }
	}
	
	elseif (isset($_POST['cancel'])) {

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('updatePassword');

        if ($token_verified = true) {
		//User has cancelled: return to the pages list
		header( "Location: admin.php" );

	}
        else {

            echo "Site is down for maintenance";

        }
    }
	
	else {
		//display the form for password reset
		require( TEMPLATE_PATH . "/admin/updatePassword.php" );
	}
}

function newPage() {
  $results = array();
  $results['pageTitle'] = "New Page";
  $results['formAction'] = "newPage";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the page edit form: save the new article
      $page = new Page;
      $page->storeFormValues( $_POST );
      $page->insertPage();
      header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the page list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the page edit form yet: display the form
    $results['page'] = new Page; //is this line necessary??
    require( TEMPLATE_PATH . "/admin/editPage.php" );
  }
}


function editPage() {
  $results = array();
  $results['pageTitle'] = "Edit Page";
  $results['formAction'] = "editPage";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
 
  if ( isset( $_POST['saveChanges'] ) ) {

      $sec = new Sec;
      $token_verified = $sec->verifyFormToken('editPage');

      if ($token_verified = true) {

          // User has posted the article edit form: save the article changes

          if (!$page = Page::getPageById((int)$_POST['pageId'])) {
              header("Location: admin.php?error=pageNotFound");
              return;
          }

          //var_dump($_POST);
          //exit;

          $page->storeFormValues($_POST);
          $page->updatePage();
          header("Location: admin.php?status=changesSaved");

      }

      else {

          echo "Site down for maintenance.";
      }
 
  } elseif ( isset( $_POST['cancel'] ) ) {

      $sec = new Sec;
      $token_verified = $sec->verifyFormToken('editPage');

      if ($token_verified = true) {

          // User has cancelled their edits: return to the page list
          header("Location: admin.php");

      }
        else {

            echo "Site down for maintenance";
        }

  } else {
 
    // User has not posted the page edit form yet: display the form
    $results['page'] = Page::getPageById( (int)$_GET['pageId'] );
    require( TEMPLATE_PATH . "/admin/editPage.php" );
  }
}

function deletePage() {
	 if ( !$page = Page::getPageById( (int)$_GET['pageId'] ) ) {
    header( "Location: admin.php?error=pageNotFound" );
    return;
  }
 
  $page->deletePage();
  header( "Location: admin.php?status=pageDeleted" );
}

function listPages() {
  $results = array();
  $data = Page::getPageList();
  $results['pages'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "All Pages";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "pageNotFound" ) $results['errorMessage'] = "Error: Page not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "pageDeleted" ) $results['statusMessage'] = "Page deleted.";
  }
 
  require( TEMPLATE_PATH . "/admin/listPages.php" );
}

function searchProducts() {
    $results = array();
    $results['pageTitle'] = "Search Products";
    $results['formAction'] = "searchProducts";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    require( TEMPLATE_PATH . "/admin/searchProducts.php" );
}

function editProducts() {
    $results = array();
    $results['pageTitle'] = "Edit Products";
    $results['formAction'] = "editProducts";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    require( TEMPLATE_PATH . "/admin/editProducts.php" );
}

function addProduct() {
    $results = array();
    $results['pageTitle'] = "Add Product";
    $results['formAction'] = "addProduct";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    require ( TEMPLATE_PATH . "/admin/addProduct.php" );

}

function productCategories() {
    $results = array();
    $results['pageTitle'] = "Product Categories";
    $results['formAction'] = "productCategories";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    require ( TEMPLATE_PATH . "/admin/productCategories.php" );


}

function createAdmin() {
  $results = array();
  $results['pageTitle'] = "Create Admin";
  $results['formAction'] = "createAdmin";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
 
  if ( isset( $_POST['saveChanges'] ) ) {

      $sec = new Sec;
      $token_verified = $sec->verifyFormToken('createAdmin');

      if ($token_verified = true) {

    //SANITIZE INPUTS
    $login = filter_var($_POST["login"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $perm_name = filter_var($_POST["perm_name"], FILTER_SANITIZE_STRING);

      //User has posted the create user edit form: save the new user.
	$auth = new Auth;
    $auth->insertUser($login,$password,$perm_name);
    header( "Location: admin.php?status=changesSaved" );

          }

          else {

              echo "Site down for maintenance.";
      }

  }
  
    elseif ( isset( $_POST['cancel'] ) ) {

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('createAdmin');

        if ($token_verified = true) {

            // User has cancelled their edits: return list pages
            header("Location: admin.php");

        }

        else {

            echo "Site down for maintenance";
        }
	
	}
	
	else {
		//display the form
		require( TEMPLATE_PATH . "/admin/createAdmin.php" );
	}
}




function createUser() {

  $results = array();
  $results['pageTitle'] = "Create User";
  $results['formAction'] = "createUser";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

  if ( isset( $_POST['saveChanges'] ) ) {

      $sec = new Sec;
      $token_verified = $sec->verifyFormToken('createUser');

      if ($token_verified = true) {

          //SANITIZE INPUTS
          $title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
          $first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
          $last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
          $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
          $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
          $address1 = filter_var($_POST["address1"], FILTER_SANITIZE_STRING);
          $address2 = filter_var($_POST["address2"], FILTER_SANITIZE_STRING);
          $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
          $state = filter_var($_POST["state"], FILTER_SANITIZE_STRING);
          $country = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
          $zip_code_post_code = filter_var($_POST["zip_code_post_code"], FILTER_SANITIZE_STRING);
          $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
          $secret = filter_var($_POST["secret"], FILTER_SANITIZE_STRING);

          $password = password_hash($password, PASSWORD_BCRYPT);
          $registration_date = date("Y-m-d H:i:s");
          $user_level = 0;

            //TODO this is no longer inserting a new user into the database??  Try to find when this was working, It was 11/20/2019 at 9:03 AM.  Try to pull this down.
          //User has posted the create user edit form: save the new user.

          //var_dump($_POST);
          //var_dump($password);
          //var_dump($registration_date);
          //var_dump($user_level);
          //exit;


          $user = new User;
          $user->insertUser($title, $first_name, $last_name, $email, $password, $registration_date, $address1, $address2, $city, $state, $country, $zip_code_post_code, $phone, $secret, $user_level);
          header("Location: admin.php?status=changesSaved");

      }

      else {

          echo "Site down for maintenance.";

      }

  }

  elseif ( isset( $_POST['cancel'] ) ) {

      $sec = new Sec;
      $token_verified = $sec->verifyFormToken('createUser');

      if ($token_verified = true) {

          // User has cancelled their edits: return list pages
          header("Location: admin.php");

      }

      else {

          echo "Site down for maintenance.";
      }

  }

  else {
      //display the form
      require( TEMPLATE_PATH . "/admin/createUser.php" );
  }

}

function searchUsers() {
    $results = array();
    $results['pageTitle'] = "Search Users";
    $results['formAction'] = "searchUsers";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    require( TEMPLATE_PATH . "/admin/searchUsers.php" );

}

function editUser()
{
    //TODO searchProducts page is appearing below editUser page?
    $results = array();
    $results['pageTitle'] = "Edit User";
    $results['formAction'] = "editUser";

    $data = Page::getPageList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    if (isset($_POST['saveChanges'])) {

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('editUser');

        if ($token_verified = true) {


            //SANITIZE INPUTS
            $user_id = filter_var($_POST["user_id"], FILTER_SANITIZE_NUMBER_INT);
            $title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
            $first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
            $last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
            $address1 = filter_var($_POST["address1"], FILTER_SANITIZE_STRING);
            $address2 = filter_var($_POST["address2"], FILTER_SANITIZE_STRING);
            $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
            $state = filter_var($_POST["state"], FILTER_SANITIZE_STRING);
            $country = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
            $zip_code_post_code = filter_var($_POST["zip_code_post_code"], FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
            $secret = filter_var($_POST["secret"], FILTER_SANITIZE_STRING);
            $user_level = 0;
            $date_modified = date("Y-m-d H:i:s");

            //User has posted the create user edit form: save the new user.
            $user = new User;
            $user->updateUser($user_id, $title, $first_name, $last_name, $email, $address1, $address2, $city, $state, $country, $zip_code_post_code, $phone, $secret, $user_level, $date_modified);
            header("Location: admin.php?status=changesSaved");

        } else {

            echo "Site down for maintenance";


        }

    } elseif (isset($_POST['cancel'])) {

        $sec = new Sec;
        $token_verified = $sec->verifyFormToken('editUser');

        if ($token_verified = true) {

            // User has cancelled their edits: return list pages
            header("Location: admin.php?action=searchUsers");

        } else {

            echo "Site down for maintenance.";
        }

    } else {
        //display the form
        require(TEMPLATE_PATH . "/admin/editUser.php");
    }

}

    function deleteUser() {
        $results = array();
        $results['pageTitle'] = "Delete User";
        $results['formAction'] = "deleteUser";

        $data = Page::getPageList();
        $results['pages'] = $data['results'];
        $results['totalRows'] = $data['totalRows'];


        if ( isset( $_POST['deleteUser'] ) ) {

            $sec = new Sec;
            $token_verified = $sec->verifyFormToken('deleteUser');

            if ($token_verified = true) {

                //SANITIZE INPUTS
                $user_id = filter_var($_POST["user_id"], FILTER_SANITIZE_NUMBER_INT);
                $date_modified = date("Y-m-d H:i:s");

                //echo "User ID: " . $user_id;
                //echo "Date Modified: " . $date_modified;
               //exit;

                $user = new User();
                $user->deleteUser($user_id, $date_modified);

                // User deleted: return to admin page
                header("Location: admin.php?action=searchUsers");


            } else {

                echo "Site down for maintenance.";

            }

        }

        if (isset($_POST['cancel'])) {
            $sec = new Sec;
            $token_verified = $sec->verifyFormToken('deleteUser');

            if ($token_verified = true) {

                // User has cancelled their edits: return search users
                header("Location: admin.php?action=searchUsers");


            }

            else {

                echo "Site down for maintenance.";

            }

        }

        else {

            //display the form
            require(TEMPLATE_PATH . "/admin/deleteUser.php");

        }

    }

?>


