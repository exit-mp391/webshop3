<div id="nav-search">
	<div id="top-nav">
		<a class="selected" href="#">Pocetna</a>
		<a href="#">Kategorije</a>
		<a href="#">Akcije</a>
		<a href="#">Najpopularniji</a>
		<a href="#">FAQ</a>
		<a href="contact.php">Kontakt</a>
		<?php if ($userinfo['admin']==1): ?>
			<a href="admin.php">Admin panel</a>
		<?php endif; ?>
	</div>
	<div id="top-search">
		<form>
			<input type="text" placeholder="Pretrazi sajt" id="search" name="search">
		</form>
	</div>
</div>