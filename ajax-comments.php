<?php

require 'class-load.php';

$comments_object = new Comments();

$comments = $comments_object -> getComments(@$_GET['id'], 0, 500);


?>

<?php foreach ($comments as $comment): ?>
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