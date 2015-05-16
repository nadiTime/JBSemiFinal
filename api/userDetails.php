<?php
session_start();
	if(!isset($_SESSION['id'])){
		$success = 0;
		echo json_encode($success);
		die;
	}
	$success = true;
	require_once ('functions.php');
	if(isset($_GET['friendId'])){
		$userId = $_SESSION['id'];
		if($userId!=$_GET['friendId']){
			$user_id=$userId;
			$friend_id=$_GET['friendId'];
			$sqlObj = connect();
			$sql="SELECT `email` as user_email, nickname as user_nickname, birthdate as user_birthdate,
			 about as user_about, image_path, register_date FROM `users` WHERE id=$friend_id";
			//select reg data
			$answer= $sqlObj->query($sql);
			if($answer){
				$array['regData'] =  mysqli_fetch_assoc($answer);
			}
			else{
				$success = false;
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
			else{
				$success = false;
			}

			//now check request status with friend
			$sql = "SELECT `status`,`sender_id`,`reciever_id` FROM `requests`
			 WHERE `reciever_id` = '$user_id' AND `sender_id` = '$friend_id'
			 OR `sender_id` = '$user_id' AND `reciever_id` = '$friend_id'";
			$answer= $sqlObj->query($sql);
			if($answer){
				$array['requests']  = mysqli_fetch_assoc($answer);
			}
			else{
				$success = false;
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
				else{
					$success = false;
				}
			}
			
		}
	}
		
	elseif (isset($_GET['userId'])) {
		$user_id=$_SESSION['id'];
		$sqlObj = connect();
		$sql="SELECT `email` as user_email, nickname as user_nickname, birthdate as user_birthdate,
		about as user_about, image_path, register_date FROM `users` WHERE id=$user_id";
		$answer= $sqlObj->query($sql);
		if($answer){
			$array['regData'] =  mysqli_fetch_assoc($answer);
		}
		else{
			$success = false;
		}
		if(!isset($_GET['userInfo'])){
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
			else{
				$success = false;
			}
		}
		$sql = "SELECT `secret_image_path` as user_secret_image,`note` as user_secret_note
			 FROM `secret`
			 WHERE `user_id` = '$user_id'";
			$answer= $sqlObj->query($sql);
			if($answer){
				$array['secret']  = mysqli_fetch_assoc($answer);
			}
			else{
				$success = false;
			}


	}
	if($success){
		$array['success'] = $success;
		echo json_encode($array);	
	}