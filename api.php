<?php

require 'class-load.php';

$product_obj= new Product();
$product=$product_obj->getProducts();

echo json_encode($product);

?>