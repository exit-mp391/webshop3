<?php

require 'class-load.php';

$cart_object = new Cart();
$product_object = new Product();

$mycart = $cart_object -> getCart();

if ($cart_object -> countCart()==0) {
	header("Location: index.php");
}

$products = $product_object -> getCartProducts($mycart);



if ($_SERVER['REQUEST_METHOD']=="POST") {

	$count = count($_POST['quantity']);
	//echo $count;

	for ($i=0; $i<$count; $i++) {

		$prod[$_POST['id'][$i]]=$_POST['quantity'][$i];

		//echo $_POST['id'][$i] . " " . $_POST['quantity'][$i];
		//echo "<br>";
	}

/*
	$niz=array("123", "456");
	foreach ($niz as $key=>$nesto) {
		$nesto;
	}
	die();
	*/
	//$products[0]['nesto']="567";
	//$products[1]['nesto']="333";
	
	foreach ($products as $key=>$pr) {
		$products[$key]['quantity']=$prod[$pr['id']];
	}


	//var_dump($products);

	//create order
	$orders_object = new Orders();
	$order_id = $orders_object -> createOrder($userinfo['id'], $products);
	
	mail($userinfo['email'], "Uspesna kupovina","
			Postovani, uspesno ste narucili proizvode.\n Id vase kupovine je : $order_id
		");

	header("Location: checkout.php?success=1");

	//empty cart
	//$cart_object = new Cart();
	//$cart_object->emptyCart();


	//var_dump($products);
	//var_dump($prod);
	/*
	echo $_POST['quantity'][0];
	echo "<br>";
	echo $_POST['quantity'][1];
	echo $_POST['quantity'][2];
	*/
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
			<h1> Moja korpa </h1>
			<?php if (@$_GET['success']==1):

			$cart_object = new Cart();
			$cart_object->emptyCart();

			?>
				<div id="success">
					Vasa narudzbina je primljena. Hvala.
				</div>
			<?php else: ?>

			<form action="" method="post">
				<table>
					<tr>
						<th>Naslov</th>
						<th>Cena</th>
						<th>Kolicina</th>
						<th>Ukupno</th>
						<th>Akcija</th>
					</tr>
					<?php foreach ($products as $product): ?>
						<tr>
							<td><?php echo $product['name']; ?></td> 
							<td><?php echo $product['price']; ?></td>
							<td>
								<input type="hidden" name="id[]" value="<?php echo $product['id']; ?>">
								<input class="cart-quantity" type="number" value="1" name="quantity[]">
							</td>
							<td class="ukupno"><?php echo $product['price']; ?> </td>
							<td><a href="cart-remove.php?id=<?php echo $product['id']; ?>">[remove]</a></td>
						</tr>
					<?php endforeach; ?>
				</table>
				<input type="submit" value="Naruci">
			</form>
			
			<div id="total">
			Ukupna cena je:
				<span id="total1">
				<?php
					//izdvajamo samo kolonu sa cenom u poseban niz
					$niz_cena = array_column($products, "price");
					//racunamo sumu te kolone
					$suma = array_sum($niz_cena);
					//stampamo
					echo $suma;
				?>
				</span>
			</div>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>

	<?php require 'inc/footer.inc.php'; ?> 

</body>
</html>