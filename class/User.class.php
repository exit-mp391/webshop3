<?php

Class User {
	
	var $con;
	
	function __construct() {
		global $con;
		$this->con = $con;
	}

	function CreateUser($ime, $prezime, $email, $adresa, $password) {
		$create_user=$this->con->prepare("
			INSERT INTO `users`
			(`name` , `surname` , `email` , `address` , `password`)
			VALUES
			(:ime , :prezime , :email , :adresa , MD5(:password))
			");
		$create_user->execute([
			":ime"=>$ime,
			":prezime"=>$prezime,
			":email"=>$email,
			":adresa"=>$adresa,
			":password"=>$password
			]);
		
	}

	function getUserInfo($id){
     $q_get_user =$this->con->prepare("
    SELECT FROM `users`
    WHERE `id`=:id
     	");
     $q_get_user->execute([
         ':id'=> $id
     	]);
     return $q_get_user->fetch();

	}





	function Login($email, $password) {
		//pokusavamo da selektujemo korisnika sa tim emailom i lozinkom
		$select_user = $this->con->prepare("
		SELECT * FROM `users`
		WHERE `email`=:email AND `password`=MD5(:password)
			");
		$select_user -> execute([
			':email' => $email,
			':password' => $password
			]);
		$userinfo = $select_user -> fetchAll();
		
		if (!count($userinfo)>0) {
			throw new Exception("Neispravni podaci.");
		}
		
		$session = md5(mt_rand() . mt_rand() . mt_rand() . time());

		setcookie("session", $session, time()+3600);

		$update_session = $this->con->prepare("
			UPDATE `users` SET `session`=:session, `session_expired` =(NOW() + INTERVAL 1 HOUR) WHERE `id`=:userid
			");
		$update_session -> execute([
			':userid' => $userinfo[0]['id'],
			':session' => $session
			]);

	}





	function LoggedUser() {


		$session = @$_COOKIE['session'];

		if (strlen($session)!=32) {
			return false;
		}

		$select_user = $this->con->prepare("
			SELECT * FROM `users`
			WHERE `session` = :session AND `session_expired` > NOW()
			");
		$select_user -> execute([
			':session' => $session
			]);
		$userinfo = $select_user -> fetchAll();
		
		if (count($userinfo)>0) {

			$q_update_time = $this->con->prepare("
				UPDATE `users` SET `session_expired` = NOW() + INTERVAL 1 HOUR WHERE `id` = :userid
				");
			$q_update_time -> execute ([
				':userid' => $userinfo[0]['id']
				]);
			return $userinfo[0];
		}
		else {
			return false;
		}

	}




	function LogOut() {
		setcookie("session", '', time());

	}





	function listUsers($start_at = 0, $limit = 20) {
		
		$q_list_users = $this->con->prepare("
			SELECT * FROM `users`
			LIMIT {$start_at},{$limit}
			");
		$q_list_users->execute();
		$users=$q_list_users->fetchAll();
		return $users;
	}





	function deleteUser($id){  

$uinfo = $this->getUserInfo($id);

if ($uinfo['admin']==0){

$comments_obj= new Comments();
$comments_obj->deleteUsersComments($id);


      $q_delete_user= $this->con->prepare("
        DELETE FROM `users` WHERE`id`= :id AND `admin`= '0'
      	");


     $q_delete_user -> execute([
       `:id`=> $id
     	]);
 }
	}
}

?>