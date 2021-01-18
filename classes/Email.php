<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * Email.php
 */


/**
* Class to handle email
*/

//TODO need to test email functionality on live server.

class Email
{
	//Properties
	public $email_recipient = null;
	
	public $email_subject = null;
	
	public $email_message = null;
	
	public $email_headers = null;
	
	public $random_string = null;
	
	public $reset_token = null;
	
	public $success = false;
	
	
	public static function updateAuthToken($email_recipient, $reset_token) {

	    //TODO Need to replace this with stored procedure.
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

		// Update the Auth Token for Password Reset
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
		$sql = "UPDATE auth SET reset_token = :reset_token where login = :email_recepient LIMIT 1";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":reset_token", $reset_token, PDO::PARAM_STR );
		$st->bindValue( ":email_recipient", $email_recipient, PDO::PARAM_STR );
		$st->execute();
		$conn = null;
	}
	
	public static function sendResetEmail($email_recipient) {
		
		
		function random_string( $length = 16 ) {
		    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$?";
		    $random_string = substr( str_shuffle( $chars ), 0, $length );
		    return $random_string;
	    }
		
		$random_string = random_string();
		
		$reset_token = password_hash($random_string, PASSWORD_BCRYPT);
		
		Email::updateAuthToken($email_recipient, $reset_token);
		
		$email_subject  = "Password Reset Request from Corrupt Robot";
		
		$email_message  = "Hopefully you have requested this password reset link from Corrupt Robot.\r\n\r\n";
		$email_message .= "Click the link below to reset your password.\r\n\r\n";
		$email_message .= "<a href=\"http://localhost/cms3/admin.php?action=updatePassword&amp;reset_token=" . $reset_token . "\">Reset My Password</a>";
		
		$email_headers  = "From: testerdev93@gmail.com\r\n";
		$email_headers .= "Content-type: text/html; charset=utf-8";
		

		//need to vet this out, there probably won't be a reply email for this
		//but this function could be usefull
		//$validate_email = filter_input(INPUT_POST, $email_recipient, FILTER_VALIDATE_EMAIL);
			
		//if (validate_email) {
			//do something with the valid email
		//}
	
		$success = mail($email_recipient,$email_subject,$email_message,$email_headers);
		
		if ($success == true) {
			echo "Password reset email sent to " . $email_recipient;
		}
		
		else {
			echo "There was an error sending your password reset email.  Sorry.";
		}
		
	}

}