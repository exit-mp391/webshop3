<?php

require 'class-load.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$email = $_POST['email'];
	$adresa = $_POST['address'];
	$password = $_POST['password'];
	$repeat_password = $_POST['repeat_password'];

	//kreiranje objekta za validaciju
	$v = new Validacija();

	//pokretanje metoda za validaciju
	$v -> ObaveznoPolje($ime, "Ime");
	$v -> ObaveznoPolje($prezime, "Prezime");
	$v -> ObaveznoPolje($email, "Email");
	$v -> ObaveznoPolje($adresa, "Adresa");
	$v -> ObaveznoPolje($password, "Password");
	$v -> ObaveznoPolje($repeat_password, "Password");

	$v -> ValidanEmail1($email, "Email adresa");
	$v -> IstaPolja($password, $repeat_password, "Password");

	if ($v -> greska == true) {

		$tekst_greske = $v -> tekstgreske;

		$tekst_greske = implode("<br>", $tekst_greske);

		//echo $tekst_greske;
	} else {
		$user_object = new User();
		try {

			$user_object -> CreateUser($ime, $prezime, $email, $adresa, $password);

			$tekst_uspesno = "Korisnik je uspesno registrovan.";
		}
		catch(Exception $e) {
			$tekst_greske = "Email adresa vec postoji u bazi podataka.";
		}

	}

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
				<?php if (isset($tekst_greske)): ?>
					<div id="error">
						<?php echo $tekst_greske; ?>
					</div>
				<?php endif; ?>
				
				<?php if (isset($tekst_uspesno)): ?>
					<div id="success">
						<?php echo $tekst_uspesno; ?>
					</div>
				<?php else: ?>
					<form action="" method="post">
						<label for="ime">Ime</label><br>
	                    <input type="text" name="ime" id="ime"><br>
	                    <label>Prezime</label><br>
	                    <input type="text" name="prezime"><br>
	                    <label>E-mail</label><br>
	                    <input type="text" name="email"><br>
	                    <label>Adresa</label><br>
	                    <input type="text" name="address"><br>
	                    <label>Slicica</label><br>
	                    <input type="file" name="slika"><br>
	                    <label>Unesite lozinku</label><br>
	                    <input type="password" name="password"><br>
	                    <label>Ponovite lozinku</label><br>
	                    <input type="password" name="repeat_password"><br>
	                    <input type="submit">
					</form>
				<?php endif; ?>
			</div>
			<div id="desni">
			
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

	<?php require 'inc/footer.inc.php'; ?> 

</body>
</html>