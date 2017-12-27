<?php

$cart_object = new Cart();

$mycart = $cart_object->getCart();
//var_dump($mycart);

//var_dump(unserialize(@$_COOKIE['cart']));
?>
<div id="head">
	<div id="logo">
		<a href="index.php">
			<img src="img/logo.png">
		</a>
	</div>
	<div id="login-form">
		<?php if ($userinfo!=false): ?>
			Dobrodosli <b><?php echo $userinfo['name'] . ' ' . $userinfo['surname']; ?></b><br>
			<a href="logout.php">LogOut</a><br>
			Korpa: <?php echo $cart_object->countCart(); ?> proizvoda
			<a href="cart-empty.php">[Isprazni korpu]</a>
			<?php if ($cart_object->countCart()>0): ?>
				<a href="checkout.php">[Pogledaj korpu]</a>
			<?php endif; ?>
		<?php else: ?> 
			<form action="login.php" method="post">
				<input type="text" id="username" name="email" placeholder="email">
				<input type="password" id="password" name="password" placeholder="password"><br>
				<input id="submit" type="submit" value="Prijavi se">
				<a href="register.php"> Novi korisnik? </a>
			</form>
		<?php endif; ?>
	</div>
</div>