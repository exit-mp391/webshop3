<?php

Class Comments {
	var $con;
	function __construct() {
		global $con;
		$this->con = $con;
	}

	function getComments($product_id, $start_at = 0, $per_page = 5) {

		$q_get_comments = $this->con->prepare("
			SELECT `comments`.text, `users`.name, `users`.surname
			FROM `comments`
			LEFT JOIN `users` ON `comments`.user_id = `users`.id
			WHERE `comments`.product_id = :product_id
			ORDER BY `comments`.id DESC
			LIMIT {$start_at}, {$per_page}
			");
		$q_get_comments -> execute([
			':product_id' => $product_id
			]);
		$comments = $q_get_comments -> fetchAll();
		return $comments;
	}
	function newComment($user_id, $product_id, $comment) {

		$q_insert_comment = $this->con->prepare("
			INSERT INTO `comments` (user_id, product_id, text)
			VALUES(:user_id, :product_id, :comment)
			");
		$q_insert_comment -> execute([
			':user_id' => $user_id,
			':product_id' => $product_id,
			':comment' => $comment
			]);

	}

	function deleteUserComments($id){
   $q_delete_comments = $this->con->prepare("
      DELETE FROM `comments`
      WHERE `user_id`= :user_id
   	");

   $q_delete_comments->execute([
      ':user_id'=> $id
   	]);

	}

}

?>