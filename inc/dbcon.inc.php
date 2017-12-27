<?php

//podaci potrebni za pristup bazi podataka

$host="localhost";
$dbname="dif";
$username="root";
$password="";

try {

	//konekcija na bazu
	$con = new PDO("mysql:host={$host};dbname={$dbname}",$username,$password);
	//podesavamo pdo da nam baza vraca greske kao exception
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//podesavamo pdo da baza vraca asocijativni niz
	$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(Exception $error) {

	echo $error->getMessage();
	die();

}

?>