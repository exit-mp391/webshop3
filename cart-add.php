<?php

require 'class-load.php';


$id = @$_GET['id'];
$cart_object = new Cart();

$cart_object->addProduct($id);

header("Location: {$_SERVER['HTTP_REFERER']}");

?>