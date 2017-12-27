<?php

use Intervention\Image\ImageManagerStatic as Image;

Class Product {
	var $con;
	function __construct() {
		global $con;
		$this->con = $con;
	}

	function newProduct() {

		//validacija za domaci
		list($width, $height)=@getimagesize($_FILES['image-1']['tmp_name']);
		if ($width>0 and $height>0) {

			$image1=md5(mt_rand().mt_rand().mt_rand().time()) . ".jpg";
		}

		$q_new_product = $this->con->prepare("
			INSERT INTO `products` (name, description, status, sale, sale_price, price, image1, image2, image3, category_id)
			VALUES (:name, :description, :status, :sale, :sale_price, :price, :image1, :image2, :image3, :category_id)
			");

		$q_new_product -> execute([
			':name' => $_POST['name'],
			':description' => $_POST['description'],
			':status' => $_POST['status'],
			':sale' => $_POST['sale'],
			':sale_price' => $_POST['sale_price'],
			':price' => $_POST['price'],
			':image1' => @$image1,
			':image2' => null,
			':image3' => null,
			':category_id' => $_POST['category_id'],
			]);

		if (isset($image1)) {
			//resizujemo sliku i cuvamo je
			$image = Image::
				make($_FILES['image-1']['tmp_name'])->
				resize(800, null, function ($constraint) {
				    $constraint->aspectRatio();
				})->
				save("images/big/" . $image1);
			//zatim istu sliku jos jednom resizujemo i ubacujemo u folder sa malim slikama
			$image->
				resize(175, null, function ($constraint) {
				    $constraint->aspectRatio();
				})->
				save("images/thumbnails/" . $image1);
		}
	
	}

	function getProductInfo($id) {
		$q_get_product = $this->con->prepare("
			SELECT * FROM `products` WHERE `id`=:id
			");
		$q_get_product -> execute([
			'id' => $id
			]);

		$product_info = $q_get_product->fetch();

		return $product_info;
	}
	function getProducts($start_at = 0, $limit = 20) {
		
		$q_get_products = $this->con->prepare("
			SELECT * 
			FROM `products`
			ORDER BY `id` DESC
			LIMIT {$start_at}, {$limit}
			");

		$q_get_products->execute();
		$products = $q_get_products -> fetchAll();
		return $products;
	}

	function getCartProducts($mycart) {

		//var_dump($mycart);

		$mycart = implode(",", $mycart);

		$q_get_products = $this->con->prepare("
			SELECT * 
			FROM `products`
			WHERE `id` IN ($mycart)
			");

		$q_get_products->execute();
		$products = $q_get_products -> fetchAll();
		return $products;
	}

Function deleteProduct($id){

   $productinfo = $this->getProductInfo($id);

   if(isset($productinfo['$image1'])){
   	  unlink("images/big/" . $productinfo['image1']);
   	  unlink("images/thumbnails/" . $productinfo['image1']);
   }

    if(isset($productinfo['$image1'])){
   	  unlink("images/big/" . $productinfo['image1']);
   	  unlink("images/thumbnails/" . $productinfo['image1']);
   }

    if(isset($productinfo['$image1'])){
   	  unlink("images/big/" . $productinfo['image1']);
   	  unlink("images/thumbnails/" . $productinfo['image1']);
   }


   $q_remove_product = $this->con->prepare("
      DELETE FROM `products`
      WHERE `id`= :id
      LIMIT 1
   	");

   $q_remove_product->execute([
     ':id'=> $id
   	]);

}


function editProduct(){


	list($width, $height)=$getimagesize($_FILES['image1']['tmp_name']);
	if($width>0 and $height>0){
		$image1=md5(mt_rand().mt_rand().mt_rand().time())."jpg";
	}

	$q_edit_product= $this->con->prepare("
       UPDATE `products`
      SET 
      `name`=:name,
      `description`=:description,
      `status`= :status,
      `sale`=:sale,
      `price`= :price,
      `sale_price`=:sale_price,
      `image1`= :image1,
      `image2`= :image2,
      `image3`= :image3,
      `category_id`=:category_id
      WHERE `id`= :product_id
		");

	$q_edit_product->execute([
       ':name' => $_POST['name'],
			':description' => $_POST['description'],
			':status' => $_POST['status'],
			':sale' => $_POST['sale'],
			':sale_price' => $_POST['sale_price'],
			':price' => $_POST['price'],
			':image1' => @$image1,
			':image2' => null,
			':image3' => null,
			':category_id' => $_POST['category_id'],
			':product_id'=> $_POST['product_id']
		]);
}


function countProducts(){
	$q_count_products= $this->con->prepare("
       SELECT COUNT(*) as count FROM `products`
		");

	$q_count_products->execute();

	$product=$q_count_products->fetch();
	return $product['count'];
}


}

?>