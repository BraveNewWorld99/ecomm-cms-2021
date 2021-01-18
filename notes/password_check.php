<?php

require("../config.php");
session_start();

?>

<?php //include "templates/include/admin_header.php" ?>
	  
	  

<?php 


	
	if(isset($_POST['checkPassword'])){
		$password = $_POST['password_to_check'];
		//need function here to generate hash.
		$message = "";
		$message2 = "";
		$hash_value = password_hash($password, PASSWORD_BCRYPT);
		$message = "Your password is: " . $password . " and the calculated hash is: " . $hash_value;
		echo $message;
		
		//get values for stored from auth table
		//$login = "admin"; 
		//$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		//$sql = "SELECT hash_value FROM auth WHERE login = :login AND password = :password LIMIT 1";
		//$st = $conn->prepare( $sql );
		//$st->bindValue( ":login", $login, PDO::PARAM_STR );
		//$st->bindVale( ":login", $password, PDO::PARAM_STR );
		//$st->execute();
		//$row = $st->fetch();
		//$conn = null;		
		//$message2 = "Your password is: " . $password . " and the database hash is: " . $row;
	}
	
?>	  

	
<form action="" method="post">
	<ul>        
			<li>
				<label form">Enter Password</label>
				<input type="text" name="password_to_check" id="password_to_check" placeholder="Password" required autofocus maxlength="255" />
			</li>
	</ul>			

			<div class="buttons">
				<input type="submit" name="checkPassword" value="Check Password" />
				<input type="submit" formnovalidate name="cancel" value="Cancel" />
			</div>
</form>


<?php //include "templates/include/admin_footer.php" ?>