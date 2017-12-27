<?php

$order_object = new Orders();
$orders = $order_object ->getOrders();

//var_dump($orders);

?>

<h1> Kupovine </h1>
<table>
		<tr>
			<th>Ime i prezime</th>
			<th>Adresa</th>
			<th>Datum</th>
			<th>Ukupna cena</th>
			<th>Akcija</th>
		</tr>

		<?php foreach ($orders as $order): ?>
			<tr>
				<td><?php echo $order['name'] . " " . $order['surname']; ?></td>
				<td><?php echo $order['address']; ?></td>
				<td><?php echo $order['date_time']; ?></td>
				<td><?php echo $order['total_price']; ?></td>
				<td><a href="admin.php?page=order&id=<?php echo $order['id']; ?>">Pregledaj</a></td>
			</tr>
		<?php endforeach; ?>
</table>