<?php
$user_object = new User();

$users = $user_object->listUsers();

//var_dump($users);
?>

<?php if(!isset($_GET['action'])): ?>
<h1>Korisnici</h1>

<table>
		<tr>
			<th>Ime i prezime</th>
			<th>Adresa</th>
			<th>Opcije</th>

		</tr>

		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user['name'] . " " . $user['surname']; ?></td>
				<td><?php echo $user['address']; ?></td>
              <a href="admin.php?page=users&action=delete&userid=<?php echo $user['id']; ?>">[obrisi]</a>
			</tr>
		<?php endforeach; ?>
</table>

<?php elseif ($_GET['action']=="delete"): ?>
	<?php
     $userid=$_GET['userid'];
     $user_object ->deleteUser($userid);
      header("Location:{$_SERVER['HTTP_REFERER']}");
	?>
<?php endif; ?>