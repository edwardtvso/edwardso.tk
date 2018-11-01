<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   
   echo 'You have cleaned session';
	header("Location: http://192.168.1.36/login.php"); 	

?>

	<br><br>
	Click here to <a href = "login.php" tite = "Login">Login.
