<?php

$product_object = new Product();
$categories_object = new Categories();


$products = $product_object -> getProducts();
$categories = $categories_object -> getCategories();
//var_dump($products);
//var_dump($categories);
?>


<?php if (!isset($_GET['action'])): ?>
<?php

if (isset($_GET['stranica'])){

	$page=(int)$_GET['stranica'];
}
else{
	$page=1;
}

	$per_page=1;


$broj_proizvoda = $product_object->countProducts();

$broj_stranica = ceil($broj_proizvoda/$per_page);
$start_at=($page*$per_page)-$per_page;
$product = $product_object->getProducts($start_at,$per_page);
?>
	<h1>Proizvodi</h1>
	<a id="submit" class="floatright" href="admin.php?page=products&action=newproduct">Novi proizvod</a>
	<div class="clear"></div>
	<table>
		<tr>
			<th>Naziv</th>
			<th>Opis</th>
			<th>Cena</th>
			<th>Akcija</th>
			<th>Akcijska cena</th>
			<th>Status</th>
			<th>Opcije</th>
		</tr>
		<?php foreach ($products as $product): ?>
		<tr>
			<td><?php echo $product['name']; ?></td>
			<td><?php echo $product['description']; ?></td>
			<td><?php echo $product['price']; ?></td>
			<td><?php echo $product['sale']; ?></td>
			<td><?php echo $product['sale_price']; ?></td>
			<td><?php echo $product['status']; ?></td>
			<td>
				<a href="admin.php?page=products&action=edit&productid=<?php echo $product['id']; ?>">Izmeni</a>
				<a href="admin.php?page=products&action=delete&productid=<?php echo $product['id']; ?>">Obrisi</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
<div id="numeracija">
				<div class="levo">
					Prikazano 1 - 12 od ukupno 50
				</div>
				<div class="desno">
					Strana:

         <?php
          $args['page']= "products";
          Helper::generatePagination();
         ?>



					<a class="active" href="#">1</a>
					<a href="#">2</a>
					<a href="#">&gt;</a>
					<a href="#">&gt;&gt;</a>
				</div>
				<div class="clear"></div>
			</div>


<?php elseif ($_GET['action']=="delete"): ?>

<?php
$productid = @$_GET['productid'];
$product_object->deleteProduct($productid);

header("Location:{$_SERVER['HTTP_REFERER']}");
?>
<?php elseif ($_GET['action']=="newproduct"): ?>
	
	<?php 
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			if ($_POST['tip']=="unos") {

				$product_object -> newProduct();
			
			}
		}
	?>
	<h1> Novi proizvod</h1>
	<form action="" method="post" enctype="multipart/form-data">

	<input type="text" name="name" placeholder="Naziv proizvoda"><br>
	<textarea name="description" placeholder="Opis proizvoda"></textarea><br>
	<input type="number" name="price" placeholder="Cena proizvoda"><br>
	Status:<br>
	<select name="status">
		<option value="1">Aktivan</option>
		<option value="0">Neaktivan</option>
	</select><br>
	Akcija:<br>
	<select name="sale">
		<option value="0">Ne</option>
		<option value="1">Da</option>
	</select><br>
	<input type="text" name="sale_price" placeholder="Akcijska cena"><br>
	Kategorija:<br>
	<select name="category_id">
		<?php foreach ($categories as $cat): ?>
			<option value="<?php echo $cat['id']; ?>">
				<?php echo $cat['name']; ?>
			</option>
		<?php endforeach; ?>
	</select><br>
	Slika 1:<br>
	<input type="file" name="image-1"><br>
	Slika 2:<br>
	<input type="file" name="image-2"><br>
	Slika 3:<br>
	<input type="file" name="image-3"><br>
	<input type="hidden" name="tip" value="unos">

	<input id="submit" type="submit" value="Unesi">
	</form>
<?php elseif ($_GET['action']=="edit"): ?>

<?php



$productid=@(int)$_GET['productid'];
$productinfo= $product_object->getProductInfo($productid);
?>
<h1> Izmena proizvoda</h1>
	<form action="" method="post" enctype="multipart/form-data">

	<input type="text" name="name" placeholder="Naziv proizvoda" value="<?php $productinfo['name']; ?>"><br>
	<textarea name="description" placeholder="Opis proizvoda"><?php echo $productinfo['description']; ?></textarea><br>
	<input type="number" name="price" placeholder="Cena proizvoda" value="<?php echo $productinfo['price']; ?>"><br>
	Status:<br>
	<select name="status">
		<option value="1">Aktivan</option>
		<option value="0" <?php echo ($productinfo['status']==0)? "selected": ""; ?>>Neaktivan</option>
	</select><br>
	Akcija:<br>
	<select name="sale">
		<option value="0">Ne</option>
		<option value="1" <?php echo ($productinfo['sale']==1) ? "selected" : "";  ?>>Da</option>
	</select><br>
	<input type="text" name="sale_price" placeholder="Akcijska cena" value="<?php echo $productinfo['sale_price']; ?>"><br>
	Kategorija:<br>
	<select name="category_id">
		<?php foreach ($categories as $cat): ?>
			<option value="<?php echo $cat['id']; ?>">
				<?php echo ($cat['id']==$productinfo['category_id']) ? "selected" : "" ; ?>
			</option>
		<?php endforeach; ?>
	</select><br>
	Slika 1:<br>
	<input type="file" name="image-1"><br>
	Slika 2:<br>
	<input type="file" name="image-2"><br>
	Slika 3:<br>
	<input type="file" name="image-3"><br>
	<input type="hidden" name="tip" value="unos">

	<input id="submit" type="submit" value="edit">
	</form>
	<?php endif;?>