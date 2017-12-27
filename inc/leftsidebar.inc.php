<?php

$categories_object = new Categories();

$categories = $categories_object -> getCategories();

//var_dump( $categories );

?>
<div class="categories">
	<div class="title">Kategorije</div>
	<?php foreach ($categories as $category): ?>
		<a href="#">
			<?php echo $category['name']; ?>
		</a>
	<?php endforeach; ?>
</div>