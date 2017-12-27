<?php

Class Categories {

	var $con;

	function __construct() {
		global $con;
		$this->con = $con;
	}

	function getCategories() {

		$get_categories = $this->con->prepare("
			SELECT `categories`.*, COUNT(category_id) AS COUNT FROM `categories` 
          LEFT JOIN `products` ON `categories`.`id`=`products`.`category_id`
             GROUP BY`categories`.`id`
			");

		$get_categories -> execute();

		return $get_categories->fetchAll();
	
	}
	

    function deleteCategory($id){
     $q_delete_category=$this->con->prepare("
         DELETE FROM `categories`
         WHERE `id`=:id
         LIMIT 1
	     ");

         $q_delete_category->execute([
         ':id'=> $id
	     ]);
	}
}

?>