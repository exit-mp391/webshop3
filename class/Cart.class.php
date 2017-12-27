<?php

Class Cart {

	var $con;

	function __construct() {
		global $con;
		$this->con = $con;
	}

	function getCart() {
		//hvatamo trenutni cart iz korisnikovog browsera
		$current_cart = @$_COOKIE['cart'];
		//unserializujemo (pretvaramo string u niz)
		$current_cart = unserialize($current_cart);
		
		return $current_cart;	
	}

	function addProduct($id) {

		$current_cart = $this -> getCart();

		//$current_cart = array_unique($current_cart);
		//var_dump($current_cart);

		//ukoliko id koji trenutno korisnik hoce da doda u korpu vec postoji u nizu, ne treba ga dodati
		if (!in_array($id, $current_cart)) {

			//u suprotnom dodajemo id u niz
			$current_cart[]=$id;

			//serijalizujemo niz i upisujemo kao cookie
			setcookie("cart", serialize($current_cart), time()+123123);
		}
	
	}

	function countCart() {
		//hvatamo trenutni cart iz korisnikovog browsera
		$current_cart = @$_COOKIE['cart'];
		//unserializujemo (pretvaramo string u niz)
		$current_cart = unserialize($current_cart);

		//vracamo broj proizvoda u korpi
		if (empty($current_cart)) {
			return 0;
		}
		return count($current_cart);
	}


	function emptyCart() {
		setcookie("cart", "", time());
	}

	function removeProduct($id) {
		/*
		$niz=array(12,13,14);
		echo $niz[0];
		unset ($niz[0]);
		var_dump($niz);
		*/
		//sta imam u korpi
		
		$current_cart = $this -> getCart();
		//var_dump($current_cart);
		//echo "<br>";
		
		//nacin 1 za brisanje elementa niza po vrednosti
		/****
		$index_to_delete = array_search($id, $current_cart);
		unset($current_cart[$index_to_delete]);
		***/
		//nacin 2
		$current_cart = array_diff($current_cart, array($id));

		setcookie("cart", serialize($current_cart), time()+123123);
	}
	
}

?>