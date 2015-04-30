<?php
	session_start();
	if(session_status() == PHP_SESSION_NONE){
		$answer = array('session' => 0);
		echo json_encode($answer);
	}
	else{
		require_once ('functions.php');
		if(isset($_GET['user_id'])){
			$id=$_GET['user_id'];
			$sqlObj = connect();
			$sql="SELECT email as user_email, nickname as user_nickname, birthdate as user_birthdate, about as user_about, image_path, register_date FROM `users` WHERE id=$id";
			$answer= $sqlObj->query($sql);
			$array['session'] =1;
			while ($row = mysqli_fetch_assoc($answer)){
				$array['data']=$row;
			}
			echo json_encode($array);
		}
	}
	