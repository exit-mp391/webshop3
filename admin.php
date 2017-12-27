<?php

require 'class-load.php';

if ($userinfo['admin']!=1 or $userinfo==false) {
	header("Location: index.php");
	die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shop - admin</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
		require 'inc/topline.inc.php';
		require 'inc/head.inc.php';
		//require 'inc/navsearch.inc.php'; 
	?>
	<div id="content">
		<div id="left-sidebar">
			<?php require 'admin-inc/leftsidebar.inc.php'; ?>
		</div>
		<div id="right-content">
			<?php
				if (isset($_GET['page'])) {
					require "admin-inc/{$_GET['page']}.inc.php"; 
				}
				else {
					require "admin-inc/homepage.inc.php";
				}
			?>
		</div>
		<div class="clear"></div>
	</div>

	<?php require 'inc/footer.inc.php'; ?> 

</body>
</html>