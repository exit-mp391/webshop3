<?php

$categories_obj = new Categories();
$categories = $categories_obj->getCategories();
//var_dump($categories);

?>
<h1> Kategorije </h1>


<?php if(!isset($_GET['action'])): ?>
<table>
		<tr>
			<th>Naziv kategorije</th>
			<th>Broj proizvoda</th>
		</tr>

		<?php foreach ($categories as $cat): ?>
			<tr>
				<td><?php echo $cat['name']; ?></td>
				<td><?php echo $cat['count']; ?></td>
                 <td>
                 <a href="admin.php?page=categories&action=delete&catid=<?php echo $cat['id']; ?>">[obrisi]</a>
                 </td>
			</tr>
		<?php endforeach; ?>
</table>
<?php elseif ($_GET['action']=="delete"): ?>
<?php
  $catid = @(int)$_GET['catid'];
  $categories_obj ->deleteCategory['catid'];
  header("Location:{$_SERVER['HTTP_REFERER']}");
?> 
<?php endif; ?>