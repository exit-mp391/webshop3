<?php

require 'class-load.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {

	$ime = $_POST['ime'];
	$naslov = $_POST['naslov'];
	$tekst = $_POST['tekst'];

	mail("danilo.dimitrov@itcentar.rs", $naslov, "Ime: {$ime} \n Tekst: {$tekst}");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shop</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
		require 'inc/topline.inc.php';
		require 'inc/head.inc.php';
		require 'inc/navsearch.inc.php'; 
	?>
	<div id="content">
		<div id="left-sidebar">
			<?php require 'inc/leftsidebar.inc.php'; ?>
		</div>
		<div id="right-content">
			<div id="levi">
				<h2> Kontakt forma: </h2>
				<form action="" method="post">
					<input name="ime" type="text" placeholder="Ime i prezime"><br>
					<input name="naslov" type="text" placeholder="Naslov"><br>
					<textarea name="tekst" placeholder="Unesite tekst poruke"></textarea><br>
					<input id="submit" type="submit" value="Posalji">
				</form>
			</div>
			<div id="desni">
				<h2> Gde se nalazimo? </h2>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1451.4140845740874!2d21.901790542759436!3d43.317856364226614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9499ba778236bab1!2sIT+Centar!5e0!3m2!1sen!2srs!4v1502646945874" width="380" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

	<?php require 'inc/footer.inc.php'; ?> 

</body>
</html>