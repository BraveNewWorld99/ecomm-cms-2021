<?php
// start PHP session
//session_start();
// load error handling script and validation class
require_once("../../config.php");

//start session
session_start();

//Clear session post data
$_SESSION['post-data'] = [];

//Store all post data in session
if (isset($_POST)) {

    $_SESSION['post-data'] = $_POST;

}

// Create new validator object
$validate = new Validate();

// read validation type (PHP or AJAX?)
$validation_type = '';
if (isset($_GET['validation_type']))
{
    $validation_type = $_GET['validation_type'];
}

//TODO I'll change my AJAX call in viewCreateAccount.php and viewShipInfo.php to POST later so can delete the $_GET above
if (isset($_POST['validation_type']))
{
    $validation_type = $_POST['validation_type'];
}


// AJAX validation or PHP validation?
if ($validation_type == 'php')
{

    if (isset($_POST['referrer_url']))
    {
        $referrer_url = $_POST['referrer_url'];
    }

    // PHP validation is performed by the ValidatePHP method, which returns
    // the page the visitor should be redirected to (which is allok.php if
    // all the data is valid, or back to index.php if not)
    header("Location:" . $validate->ValidatePHP($referrer_url));
}
else
{
    // AJAX validation is performed by the ValidateAJAX method. The results
    // are used to form an XML document that is sent back to the client
    $response = array("result" =>
        $validate->ValidateAJAX($_GET['input_value'], $_GET['field_id']),
        "field_id" => $_GET['field_id'] );

    // generate the response
    if(ob_get_length()) ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
