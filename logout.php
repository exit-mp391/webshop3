<?php

require 'class-load.php';

$user_object = new User();
$user_object -> LogOut();

header("Location: index.php");

?>