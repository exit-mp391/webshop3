<?php 

require 'class-load.php';

$product_object = new Product();
$products = $product_object -> getProducts();
//var_dump($products[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shop</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--<link rel="icon" href="favicon.png" type="image/x-icon" />-->
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
			<div id="search1">
				<form>
					Tekst:
					<input type="text" placeholder="pretraga">
					Kategorija:
					<select>
						<option>- - - -</option>
						<?php foreach ($categories as $category): ?>
							<option>
							<?php echo $category['name']; ?>
							</option>
						<?php endforeach; ?>
					</select>
					cena od <input type="text" placeholder="unesi iznos">
					do <input type="text" placeholder="unesi iznos">
					<input id="submit" type="submit" value="Trazi">
				</form>
			</div>
			<div id="products">

			<?php foreach ($products as $product): ?>
				<div class="product">
					<div class="title"><?php echo $product['name']; ?></div>
					<div class="thumbnail">
						<img src="
						<?php if ($product['image1']): ?>
							images/thumbnails/<?php echo $product['image1']; ?>
						<?php else: ?>
							http://www.novelupdates.com/img/noimagefound.jpg
						<?php endif; ?>
						">
						<div class="cena"><?php echo $product['price']; ?></div>
					</div>
					<div class="bottom-links">
						<a class="detaljnije" href="product.php?id=<?php echo $product['id']; ?>"> Detaljnije</a>

						<?php if (@in_array($product['id'], $mycart)): ?>
							<a class="kupi" href="cart-remove.php?id=<?php echo $product['id']; ?>"> [x]</a>
						<?php else: ?>
							<a class="kupi" href="cart-add.php?id=<?php echo $product['id']; ?>"> Kupi</a>
						<?php endif; ?>

					</div> 
				</div>
			<?php endforeach; ?>
			
				<div class="clear"></div>
			</div>
			<div id="numeracija">
				<div class="levo">
					Prikazano 1 - 12 od ukupno 50
				</div>
				<div class="desno">
					Strana:
					<a class="active" href="#">1</a>
					<a href="#">2</a>
					<a href="#">&gt;</a>
					<a href="#">&gt;&gt;</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<?php require 'inc/footer.inc.php'; ?> 
</body>
</html>