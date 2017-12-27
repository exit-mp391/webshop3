<?php

Class Orders {
var $con;

	function __construct() {
		global $con;
		$this->con=$con;
	}

	function createOrder($userid, $products) {


		$this->con->beginTransaction();
		//create order
		$q_order_create = $this->con->prepare("
			INSERT INTO `orders` (user_id)
			VALUES (:userid)
			");
		$q_order_create->execute([
			':userid' => $userid
			]);
		//get order id - last insert id
		$last_id= $this->con->LastInsertId();



		//insert order items
		$q_insert_order_items= $this->con->prepare("
			INSERT INTO `order_items` (order_id, product_name, product_price, quantity)
			VALUES (:order_id, :product_name, :product_price, :quantity)
			");

		foreach ($products as $product) {

			$q_insert_order_items -> execute([
				':order_id' => $last_id,
				':product_name' => $product['name'],
				':product_price' => $product['price'],
				':quantity' => $product['quantity']
				]);
		}

		$this->con->commit();
		return $last_id;		
	}

	function getOrders($start_at = 0, $limit = 10) {

		$q_get_orders = $this->con->prepare("
			SELECT 
			
			`orders`.*,
			`users`. `name`,
			`users`. `surname`,
			`users`. `address`,

			SUM(`product_price`*`quantity`) as `total_price`
			

			FROM `orders`
			LEFT JOIN `users` ON `orders`.`user_id` = `users`.`id`
			LEFT JOIN `order_items` ON `orders`.`id` = `order_items`.`order_id`
			
			GROUP BY `order_items`.`order_id`
			ORDER BY `orders`.`id` DESC
			LIMIT {$start_at}, {$limit}
			"
			);

		$q_get_orders->execute();
		$orders = $q_get_orders->fetchAll();

		return $orders;

	}

	function getItems($order_id) {

		$q_get_items = $this->con->prepare(
			"SELECT * FROM `order_items`
			WHERE `order_id`=:order_id
			"
			);

		$q_get_items -> execute([
			':order_id' => $order_id
			]);

		$items=$q_get_items->fetchAll();
		
		return $items;
	}

}