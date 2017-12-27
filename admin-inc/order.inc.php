<?php

$order_object = new Orders();

$items = $order_object->getItems(@(int)$_GET['id']);
//var_dump($items);
?>
<h1> Informacije o kupovini </h1>

<table>
		<tr>
			<th>Naziv</th>
			<th>Cena</th>
			<th>Kolicina</th>
		</tr>

		<?php
		$suma=0;
		foreach ($items as $item):
		$suma+=$item['product_price']*$item['quantity'];
		?>
			<tr>
				<td><?php echo $item['product_name']; ?></td>
				<td><?php echo $item['product_price']; ?></td>
				<td><?php echo $item['quantity']; ?></td>
			</tr>
		<?php endforeach; ?>
</table>

Ukupna cena je:

<?php
echo $suma;
?>