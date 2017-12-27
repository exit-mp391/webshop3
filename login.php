<?php

require 'class-load.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$user_object = new User();

	try {

		$user_object -> Login($email, $password);
		header("Location: index.php");
	}
	catch (Exception $e) {
		header("Location: index.php?login_error=1");
	}
}

?>