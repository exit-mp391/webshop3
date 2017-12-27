<?php

require 'class-load.php';

$product_object = new Product();
$comments_object = new Comments();


if (isset($_POST['comment']) and $userinfo!=false) {
	
	//upis komentara pokretanjem metode
	$comments_object -> newComment($userinfo['id'], @$_GET['id'], $_POST['comment']);

	//redirekt na istu tu stranicu - da se refreshovanjem stranice nebi ponovo upisivali komentari
	header("Location: {$_SERVER['REQUEST_URI']}");
}

$productinfo = $product_object -> getProductInfo(@$_GET['id']);

$productcomments = $comments_object -> getComments(@$_GET['id']);

//var_dump($productcomments);

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
				<div id="velika-slika">
					<img src="
					<?php if ($productinfo['image1']): ?>
						images/big/<?php echo $productinfo['image1']; ?>
					<?php else: ?>
						http://www.novelupdates.com/img/noimagefound.jpg
					<?php endif; ?>
					">
				</div>
				<div id="male-slike">
					<img big-img="https://www.smashingmagazine.com/wp-content/uploads/2016/01/07-responsive-image-example-castle-7-opt.jpg" src="img/phone.jpg">
					<img big-img="https://www.codeproject.com/KB/GDI-plus/ImageProcessing2/flip.jpg" src="img/phone.jpg">
					<img big-img="https://www.reduceimages.com/img/image-after.jpg" src="img/phone.jpg">
				</div>
			</div>
			<div id="desni">
				<h1> <?php echo $productinfo['name']; ?> </h1>
				<p> <?php echo $productinfo['description']; ?></p><br>
				<span id="velika-cena">
					<?php echo number_format($productinfo['price'],0,",","."); ?> rsd
				</span>
				<a id="dodaj-u-korpu" href="">Dodaj u korpu</a>
			</div>
			<div class="clear"></div>
			<div id="komentari">
				<h2> Komentari: </h2>
				<div id="komentari1">
					<?php foreach ($productcomments as $comment): ?>
					<div class="komentar">
						<div class="user">
							<img src="https://cdn1.iconfinder.com/data/icons/rcons-line-ios-3/32/comment-512.png">
						</div>
						<div class="sadrzaj-komentara">
							<h3> <?php echo $comment['name'] . ' ' . $comment['surname']; ?> </h3>
							<p> <?php echo $comment['text']; ?> </p>
						</div>
						<div class="clear"></div>
					</div>
					<?php endforeach; ?>
				</div>
				<button productid="<?php echo $productinfo['id']; ?>" id="submit" class="floatright all-comments">
					Procitaj sve komentare
				</button>
				<!-- facebook comentari -->
				<h2>Facebook komentari </h2>
				<!-- Your embedded comments code -->
					<div class="fb-comment-embed"
				   data-href="http://facebook.com"
				   data-width="500"></div>
				<!-- upis komentara -->
				
				<?php if ($userinfo!=false): ?>
					<h2>Upisi komentar:</h2>
					<form action="" method="post">
						<textarea name="comment" placeholder="Ovde unesite tekst komentara za proizvod"></textarea>
						<br>
						<input id="submit" type="submit" value="Upisi komentar">
					</form>
				<?php endif; ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<?php require 'inc/footer.inc.php'; ?> 

</body>
</html>