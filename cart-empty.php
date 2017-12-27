<?php

require 'class-load.php';


$cart_object = new Cart();

$cart_object->emptyCart();

header("Location: {$_SERVER['HTTP_REFERER']}");

?>