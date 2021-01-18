<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * Auth.php
 */

/** Class to handle authentication **/

class Auth
{
	//Properties
	
	/**
	* @var int The page ID from the database
	*/
	public $id = null;
	
	/**
	* @var varchar the login from the database
	*/
	
	public $login = null;
	
	/**
	* @var varchar the password from the database
	*/
	
	public $password = null;
	
	/**
	* @var varchar the salt from the database
	*/
	
	public $salt = null;
	
	/**
	* @var varchar the hash from the database
	*/
	
	public $hash = null;
	
	/**
	* @var int the permission level from the database
	*/
	public $perm_level = null;
	
	/**
	* @var varchar the permission level name from the database
	*/
	public $perm_name = null;


  
   /**
  * Returns an Auth object matching the given login
  *
  * @param varchar The login 
  * @return Auth|false The auth object, or false if the record was not found or there was a problem
  */

   //This function may be useful for the future
 /**
  public static function getByLogin( $login, $password ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM auth WHERE login = :login and password = :password LIMIT 1";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":login", $login, PDO::PARAM_STR );
	$st->bindValue( ":password", $password, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Auth( $row );
  }
  
  **/
  
  
  public function insertUser($login, $password, $perm_name) {
	// Insert the new user
	
	$hash_value = null;
	$salt = null;
	
	switch ($perm_name) {
		case 'admin':
			$perm_level = 1;
			break;
		case 'editor':
			$perm_level = 2;
			break;
		case 'manager':
			$perm_level = 3;
			break;
	}
	

	$hash_value = password_hash($password, PASSWORD_BCRYPT);
	
	//salt and random passwords for database folks
	$salt = random_bytes(16);
	
	//There used to be some logic here that I understood. I was adding a fake password to the Auth table.
	//But the hash should be the only thing that matches the password's has.  Am I salting my hash?  How am I using salt?
	//is the has getting stored properly?  Can use password_check.php to generate hashes for passwords now.
	
    function random_password( $length = 8 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	
	$password = random_password();

    //TODO $perm_name is not updating inserting in the database, fix this later.
      //Set PDO Attributes in the options array
      $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL insertAdmin( :login, :password, :salt, :hash_value, :perm_level, :perm_name )";
    $st = $conn->prepare ( $sql );
	$st->bindValue( ":login", $login, PDO::PARAM_STR );
    $st->bindValue( ":password", $password, PDO::PARAM_STR );
    $st->bindValue( ":salt", $salt, PDO::PARAM_STR );
	$st->bindValue( ":hash_value", $hash_value, PDO::PARAM_STR );
	$st->bindValue( ":perm_level", $perm_level, PDO::PARAM_INT );
	$st->bindValue( ":perm_name", $perm_name, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null; 
  }

  public function updatePassword($password, $reset_token) {

	    
	    $hash_value = password_hash($password, PASSWORD_BCRYPT);

	    //TODO Need to replace with Stored Procedure, an do this all in 1.
      //Set PDO Attributes in the options array
      $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];
	  
	    // Update the user Password for given reset token
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
		$sql = "UPDATE auth SET hash_value = :hash_value where reset_token = :reset_token LIMIT 1";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":hash_value", $hash_value, PDO::PARAM_STR );
		$st->bindValue( ":reset_token", $reset_token, PDO::PARAM_STR );
		$st->execute();
		$conn = null;
		
	    // Update the reset_token to a null value
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
		$sql = "UPDATE auth SET reset_token = null where reset_token = :reset_token LIMIT 1";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":reset_token", $reset_token, PDO::PARAM_STR );
		$st->execute();
		$conn = null;
  }
  
}
