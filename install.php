<?php
// ucitavanje konekcije na bazu 
require 'inc/dbcon.inc.php';

//priprema
$create_users_table = $con->prepare("
	CREATE TABLE IF NOT EXISTS `users` (
		`id` int(11) AUTO_INCREMENT,
		`name` varchar(255) NOT NULL,
		`surname` varchar(255) NOT NULL,
		`email` varchar(255) NOT NULL,
		`address` varchar(255) NOT NULL,
		`password` varchar(255) NOT NULL,
		`date_time` datetime DEFAULT CURRENT_TIMESTAMP,
		`avatar` varchar(255) DEFAULT NULL,
		`session` varchar(255) DEFAULT NULL,
		`session_expired` datetime DEFAULT NULL,
		`admin` boolean DEFAULT 0,
		PRIMARY KEY (id),
		UNIQUE (email)
	)
	");

$create_categories_table = $con->prepare("
	CREATE TABLE IF NOT EXISTS `categories` (
	`id` int(11) AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	PRIMARY KEY (id)
	)
	");

$create_products_table = $con->prepare("
	CREATE TABLE IF NOT EXISTS `products` (
	`id` int(11) AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`description` text NOT NULL,
	`status` BOOLEAN DEFAULT 1,
	`sale` BOOLEAN DEFAULT 0,
	`sale_price` int(11),
	`price` int(11) NOT NULL,
	`image1` varchar(255) DEFAULT NULL,
	`image2` varchar(255) DEFAULT NULL,
	`image3` varchar(255) DEFAULT NULL,
	`category_id` int(11) DEFAULT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE
	)
	");
$create_comments_table = $con->prepare("
	CREATE TABLE IF NOT EXISTS `comments` (
	`id` int(11) AUTO_INCREMENT,
	`date_time` datetime DEFAULT CURRENT_TIMESTAMP,
	`user_id` int(11) NOT NULL,
	`product_id` int(11) NOT NULL,
	`text` text NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
	)
	");
$create_messages_table = $con->prepare("
	CREATE TABLE IF NOT EXISTS `messages` (
	`id` int(11) AUTO_INCREMENT,
	`date_time` datetime DEFAULT CURRENT_TIMESTAMP,
	`sender_id` int(11) DEFAULT NULL,
	`receiver_id` int(11) DEFAULT NULL,
	`subject` varchar(255) NOT NULL,
	`message` text NOT NULL,
	`status` boolean DEFAULT 0,
	PRIMARY KEY (id),
	FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE SET NULL,
	FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE SET NULL
	)
	");
$create_orders_table = $con->prepare("
	CREATE TABLE IF NOT EXISTS `orders` (
	`id` int(11) AUTO_INCREMENT,
	`date_time` datetime DEFAULT CURRENT_TIMESTAMP,
	`user_id` int(11) DEFAULT NULL,
	`status` boolean DEFAULT 0,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users(id)
	)
	");
$create_order_items_table = $con->prepare("
	CREATE TABLE IF NOT EXISTS `order_items` (
	`id` int(11) AUTO_INCREMENT,
	`order_id` int(11) NOT NULL,
	`product_name` varchar(255) NOT NULL,
	`product_price` int(11) NOT NULL,
	`quantity` int(11) DEFAULT 1,
	PRIMARY KEY (id),
	FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
	)
	");

// pokretanje

$create_users_table->execute();
$create_categories_table->execute();
$create_products_table->execute();
$create_comments_table->execute();
$create_messages_table->execute();
$create_orders_table->execute();
$create_order_items_table->execute();

?>