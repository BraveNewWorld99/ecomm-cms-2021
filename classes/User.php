<?php
/**
 * CMS by Adam Hott
 * Copyright 2019
 * User.php
 */

/** Class to handle users **/

class User
{

//TODO have to modify all functions that include user data due to new fields
    //Properties

    /**
     * @var mediumint The user_id from the database
     */

    public $user_id = null;

    /**
     * @var varchar The user's  title from the database
     */

    public $user_title = null;

    /**
     * @var varchar The user's first name from the database
     */

    public $user_first_name = null;

    /**
     * @var varchar The user's last name from the database
     */

    public $user_last_name = null;

    /**
     * @var email The user's email from the database
     */

    public $email = null;

    /**
     * @var varchar The user's password from the database
     */

    public $password = null;

    /**
     * @var varchar The token for resetting the user's password
     */

    public $token = null;

    /**
     * @var datetime The registration date from the database
     */

    public $registration_date = null;



    /**
     * @var varchar The user's ship to first name from the database
     */

    public $ship_first_name = null;

     /**
     * @var varchar The user's ship to last name from the database
     */

     public $ship_last_name = null;

    /**
     * @var varchar The user's ship to address 1 from the database
     */


    public $ship_address1 = null;

    /**
     * @var varchar The user's ship to address 2 from the database
     */

    public $ship_address2 = null;

    /**
     * @var varchar The user's ship to city from the database
     */

    public $ship_city = null;

    /**
     * @var varchar The user's ship to state from the database
     */

    public $ship_state = null;

    /**
     * @var varchar The user's ship to country from the database
     */

    public $ship_country = null;

    /**
     * @var varchar The user's ship to zip code or post code from the database
     */

    public $ship_zip_code_post_code = null;


    /**
     * @var varchar The user's bill to first name from the database
     */

    public $bill_first_name = null;

    /**
     * @var varchar The user's bill to last name from the database
     */

    public $bill_last_name = null;

    /**
     * @var varchar The user's bill to address 1 from the database
     */

    public $bill_address1 = null;

    /**
     * @var varchar The user's bill to address 2 from the database
     */

    public $bill_address2 = null;

    /**
     * @var varchar The user's bill to city from the database
     */

    public $bill_city = null;

    /**
     * @var varchar The user's bill to state from the database
     */

    public $bill_state = null;

    /**
     * @var varchar The user's bill to country from the database
     */

    public $bill_country = null;

    /**
     * @var varchar The user's bill to zip code or post code from the database
     */

    public $bill_zip_code_post_code = null;


    /**
     * @var char The user's phone from the database
     */

    public $phone = null;


    /**
     * @var int The user's auth level from the database
     */

    public $user_level = null;

    /**
     * @var datetime The date the record was modified in the database
     */

    public $date_modified = null;

    /**
     * @var bigint The count of users in database
     */

    public $user_count = [];

    /**
     * @var int The first record to start with
     */

    public $start = "";

    /**
     * @var int The number of records displayed per page
     */

    public $pagerows = "";

    //This creates a user from the admin section
    public function insertUser($user_title,$user_first_name,$user_last_name,$email,$password,$registration_date,$ship_first_name,$ship_last_name,$ship_address1,$ship_address2,$ship_city,$ship_state,$ship_country,$ship_zip_code_post_code,$bill_first_name,$bill_last_name,$bill_address1,$bill_address2,$bill_city,$bill_state,$bill_country,$bill_zip_code_post_code,$phone,$user_level, $date_modified){

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL insertUser( :user_title, :user_first_name, :user_last_name, :email, :password, :registration_date, :ship_first_name, :ship_last_name, :ship_address1, :ship_address2, :ship_city, :ship_state, :ship_country, :ship_zip_code_post_code, :bill_first_name, :bill_last_name, :bill_address1, :bill_address2, :bill_city, :bill_state, :bill_country, :bill_zip_code_post_code, :phone, :user_level, :date_modified )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":user_title", $user_title, PDO::PARAM_STR );
        $st->bindValue( ":user_first_name", $user_first_name, PDO::PARAM_STR );
        $st->bindValue( ":user_last_name", $user_last_name, PDO::PARAM_STR );
        $st->bindValue( ":email", $email, PDO::PARAM_STR );
        $st->bindValue( ":password", $password, PDO::PARAM_STR );
        $st->bindValue( ":registration_date", $registration_date, PDO::PARAM_STR );
        $st->bindValue( ":ship_first_name", $ship_first_name, PDO::PARAM_STR );
        $st->bindValue( ":ship_last_name", $ship_last_name, PDO::PARAM_STR );
        $st->bindValue( ":ship_address1", $ship_address1, PDO::PARAM_STR );
        $st->bindValue( ":ship_address2", $ship_address2, PDO::PARAM_STR );
        $st->bindValue( ":ship_city", $ship_city, PDO::PARAM_STR );
        $st->bindValue( ":ship_state", $ship_state, PDO::PARAM_STR );
        $st->bindValue( ":ship_country", $ship_country, PDO::PARAM_STR );
        $st->bindValue( ":ship_zip_code_post_code", $ship_zip_code_post_code, PDO::PARAM_STR );
        $st->bindValue( ":bill_first_name", $bill_first_name, PDO::PARAM_STR );
        $st->bindValue( ":bill_last_name", $bill_last_name, PDO::PARAM_STR );
        $st->bindValue( ":bill_address1", $bill_address1, PDO::PARAM_STR );
        $st->bindValue( ":bill_address2", $bill_address2, PDO::PARAM_STR );
        $st->bindValue( ":bill_city", $bill_city, PDO::PARAM_STR );
        $st->bindValue( ":bill_state", $bill_state, PDO::PARAM_STR );
        $st->bindValue( ":bill_country", $bill_country, PDO::PARAM_STR );
        $st->bindValue( ":bill_zip_code_post_code", $bill_zip_code_post_code, PDO::PARAM_STR );
        $st->bindValue( ":phone", $phone, PDO::PARAM_STR );
        $st->bindValue( ":user_level", $user_level, PDO::PARAM_INT );
        $st->bindValue( ":date_modified", $date_modified, PDO::PARAM_STR );
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

public function getUserID($user_logged_in) {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    $sql = "CALL getUserID(:user_logged_in)";
    $st = $conn->prepare($sql);
    $st->bindValue( ":user_logged_in", $user_logged_in, PDO::PARAM_STR );
    $st->execute();
    $rows = $st->fetchAll();
    $conn = null;
    if ( $rows ) return $rows;
}

public function getUsers() {

    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    $sql = "SELECT * FROM getUsers";
    $st = $conn->prepare($sql);
    $st->execute();
    $rows = $st->fetchAll();
    $conn = null;
    if ( $rows ) return new User( $rows );
}

public function getUserCount() {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    $sql = "SELECT * FROM getUserCount";
    $st = $conn->prepare($sql);
    $st->execute();
    $user_count = $st->fetch();
    $conn = null;
    if ($user_count) return $user_count;

}

public function getUserByID($user_id) {

    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    $sql = "CALL getUserByID(:user_id)";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":user_id", $user_id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return $row;

}

public function getUserRegData($start, $pagerows) {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    //$sql = "SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y')" .
    //    "AS regdat, user_id FROM users ORDER BY registration_date ASC LIMIT :start, :pagerows";
    $sql = "CALL getUserRegData(:start,:pagerows)";
    $st = $conn->prepare($sql);
    $st->bindValue(":start", $start, PDO::PARAM_INT);
    $st->bindValue(":pagerows", $pagerows, PDO::PARAM_INT);
    $st->execute();
    $rows = $st->fetchAll();
    $conn = null;
    if ($rows) return $rows;

}


    public function getUserSearchRegData($query) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
        //$sql = "SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y')" .
        //    "AS regdat, user_id FROM users WHERE (`first_name` LIKE '%".$query."%') OR (`last_name` LIKE '%".$query."%') OR (`email` LIKE '%".$query."%') ORDER BY registration_date ASC";
        $sql = "CALL getUserSearchRegData(:query)";
        $st = $conn->prepare($sql);
        $st->bindValue(":query", $query, PDO::PARAM_STR);
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ($rows) return $rows;

    }

public function updateUser($user_id,$title,$first_name,$last_name,$email,$address1,$address2,$city,$state,$country,$zip_code_post_code,$phone,$secret,$user_level, $date_modified) {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    // Update the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL updateUser(:user_id, :title, :first_name, :last_name, :email, :address1, :address2, :city, :state, :country, :zip_code_post_code, :phone, :secret, :user_level, :date_modified)";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":user_id", $user_id, PDO::PARAM_INT );
    $st->bindValue( ":title", $title, PDO::PARAM_STR );
    $st->bindValue( ":first_name", $first_name, PDO::PARAM_STR );
    $st->bindValue( ":last_name", $last_name, PDO::PARAM_STR );
    $st->bindValue( ":email", $email, PDO::PARAM_STR );
    $st->bindValue( ":address1", $address1, PDO::PARAM_STR );
    $st->bindValue( ":address2", $address2, PDO::PARAM_STR );
    $st->bindValue( ":city", $city, PDO::PARAM_STR );
    $st->bindValue( ":state", $state, PDO::PARAM_STR );
    $st->bindValue( ":country", $country, PDO::PARAM_STR );
    $st->bindValue( ":zip_code_post_code", $zip_code_post_code, PDO::PARAM_STR );
    $st->bindValue( ":phone", $phone, PDO::PARAM_STR );
    $st->bindValue( ":secret", $secret, PDO::PARAM_STR );
    $st->bindValue( ":user_level", $user_level, PDO::PARAM_INT );
    $st->bindValue( ":date_modified", $date_modified, PDO::PARAM_STR );
    $st->execute();
    $this->user_id = $conn->lastInsertId();
    $conn = null;

}

public function deleteUser($user_id, $date_modified){

    // Does the Page object have an ID?
    if ( is_null( $user_id ) ) trigger_error ( "User::deleteUser(): Attempt to delete a User object that does not have its ID property set.", E_USER_ERROR );

    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    // Delete the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL deleteUser(:user_id,:date_modified)";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":user_id", $user_id, PDO::PARAM_INT );
    $st->bindValue( ":date_modified", $date_modified, PDO::PARAM_STR );
    $st->execute();
    $conn = null;

}

public function checkUserLoginExists($email) {

    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    $sql = "CALL checkUserLoginExists(:email)";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":email", $email, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return $row;

}

public function loginUser($user_login) {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    $sql = "CALL loginUser(:user_login)";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":user_login", $user_login, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return $row;

}

public function insertUserShipInfo($user_login, $ship_first_name, $ship_last_name, $ship_address1, $ship_address2, $ship_city, $ship_state, $ship_country, $ship_zip_code_post_code, $date_modified) {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL insertUserShipInfo( :user_login, :ship_first_name, :ship_last_name, :ship_address1, :ship_address2, :ship_city, :ship_state, :ship_country, :ship_zip_code_post_code, :date_modified )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":user_login", $user_login, PDO::PARAM_STR );
    $st->bindValue( ":ship_first_name", $ship_first_name, PDO::PARAM_STR );
    $st->bindValue( ":ship_last_name", $ship_last_name, PDO::PARAM_STR );
    $st->bindValue( ":ship_address1", $ship_address1, PDO::PARAM_STR );
    $st->bindValue( ":ship_address2", $ship_address2, PDO::PARAM_STR );
    $st->bindValue( ":ship_city", $ship_city, PDO::PARAM_STR );
    $st->bindValue( ":ship_state", $ship_state, PDO::PARAM_STR );
    $st->bindValue( ":ship_country", $ship_country, PDO::PARAM_STR );
    $st->bindValue( ":ship_zip_code_post_code", $ship_zip_code_post_code, PDO::PARAM_STR );
    $st->bindValue( ":date_modified", $date_modified, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
}

public function getShipInfo($user_login) {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    $sql = "CALL getShipInfo(:user_login)";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":user_login", $user_login, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetchAll();
    $conn = null;
    if ( $row ) return $row;
}

public function getBillInfo($user_login)
{
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
    $sql = "CALL getBillInfo(:user_login)";
    $st = $conn->prepare($sql);
    $st->bindValue(":user_login", $user_login, PDO::PARAM_STR);
    $st->execute();
    $row = $st->fetchAll();
    $conn = null;
    if ($row) return $row;
}

    public function insertUserBillInfo($user_login, $bill_first_name, $bill_last_name, $bill_address1, $bill_address2, $bill_city, $bill_state, $bill_country, $bill_zip_code_post_code, $date_modified) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL insertUserBillInfo( :user_login, :bill_first_name, :bill_last_name, :bill_address1, :bill_address2, :bill_city, :bill_state, :bill_country, :bill_zip_code_post_code, :date_modified )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":user_login", $user_login, PDO::PARAM_STR );
        $st->bindValue( ":bill_first_name", $bill_first_name, PDO::PARAM_STR );
        $st->bindValue( ":bill_last_name", $bill_last_name, PDO::PARAM_STR );
        $st->bindValue( ":bill_address1", $bill_address1, PDO::PARAM_STR );
        $st->bindValue( ":bill_address2", $bill_address2, PDO::PARAM_STR );
        $st->bindValue( ":bill_city", $bill_city, PDO::PARAM_STR );
        $st->bindValue( ":bill_state", $bill_state, PDO::PARAM_STR );
        $st->bindValue( ":bill_country", $bill_country, PDO::PARAM_STR );
        $st->bindValue( ":bill_zip_code_post_code", $bill_zip_code_post_code, PDO::PARAM_STR );
        $st->bindValue( ":date_modified", $date_modified, PDO::PARAM_STR );
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

}