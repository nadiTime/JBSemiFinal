<?php
session_start();
	$status=false;
	require_once ('functions.php');
	if(isset($_GET['userId'])&&isset($_GET['friendId'])){
		if($_GET['userId']!=$_GET['friendId']){

			$user_id=$_GET['userId'];
			$friend_id=$_GET['friendId'];
			$sqlObj = connect();
			$sql="SELECT `email` as user_email, nickname as user_nickname, birthdate as user_birthdate,
			 about as user_about, image_path, register_date FROM `users` WHERE id=$friend_id";
			//select reg data
			$answer= $sqlObj->query($sql);
			if($answer){
				$array['regData'] =  mysqli_fetch_assoc($answer);
				$status = true;	
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
			$sql = "SELECT `status`,`sender_id`,`reciever_id` FROM `requests`
			 WHERE `reciever_id` = '$user_id' AND `sender_id` = '$friend_id'
			 OR `sender_id` = '$user_id' AND `reciever_id` = '$friend_id'";
			$answer= $sqlObj->query($sql);
			if($answer){
				$array['requests']  = mysqli_fetch_assoc($answer);
			}

			//check if status 1 and get secret data

			if($array['requests']['status']==1){
				$sql = "SELECT `secret_image_path` as user_secret_image,`note` as user_secret_note
				 FROM `secret`
				 WHERE `user_id` = '$friend_id'";
				$answer= $sqlObj->query($sql);
				if($answer){
					$array['secret']  = mysqli_fetch_assoc($answer);
				}
			}
			
		}
	}
		
	elseif (isset($_GET['userId'])) {
		$user_id=$_GET['userId'];
		$sqlObj = connect();
		$sql="SELECT `email` as user_email, nickname as user_nickname, birthdate as user_birthdate,
		about as user_about, image_path, register_date FROM `users` WHERE id=$user_id";
		$answer= $sqlObj->query($sql);
		if($answer){
			$array['regData'] =  mysqli_fetch_assoc($answer);
			$status =true;	
		}
		$sql="SELECT `post` as post, `date` as post_date FROM `posts`
		 WHERE user_id=$user_id ORDER BY post_date desc";
		$answer= $sqlObj->query($sql);
		if($answer){
			$arr = [];
			while($res = mysqli_fetch_assoc($answer)){
				$arr[] =$res;
			}
			$array['posts'] = $arr; 
		}
		$sql = "SELECT `secret_image_path` as user_secret_image,`note` as user_secret_note
			 FROM `secret`
			 WHERE `user_id` = '$user_id'";
			$answer= $sqlObj->query($sql);
			if($answer){
				$array['secret']  = mysqli_fetch_assoc($answer);
			}

	}
	if($status){
		echo json_encode($array);	
	}