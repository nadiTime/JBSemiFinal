<?php
session_start();
	require_once ('functions.php');
	if(isset($_GET['userId'])&&$_GET['friendId']){
		$user_id=$_GET['userId'];
		$friend_id=$_GET['friendId'];
		$sqlObj = connect();
		$sql="SELECT `email` as user_email, nickname as user_nickname, birthdate as user_birthdate,
		 about as user_about, image_path, register_date FROM `users` WHERE id=$friend_id";
		//select reg data
		$answer= $sqlObj->query($sql);
		if($answer){
			$array['regData'] =  mysqli_fetch_assoc($answer);	
		}
		//select posts
		$sql="SELECT `post` as post, `date` as post_date FROM `posts`
		 WHERE user_id=$friend_id ORDER BY post ASC";
		$answer= $sqlObj->query($sql);
		if($answer){
			$arr = [];
			while($res = mysqli_fetch_assoc($answer)){
				$arr[] =$res;
			}
			$array['posts'] = $arr; 
		}

		//now check request status with friend
		echo json_encode($array);
	}
	elseif (isset($_GET['userId'])) {
			
	}	
