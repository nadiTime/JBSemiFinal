<?php
session_start();
require_once('functions.php');
	if(isset($_GET['relationships'])){
		$userId = $_SESSION['id'];
		$data = [];
		$data['friends'] = getFriends($userId);
		$data['request'] = getRequests($userId);
		$data['declined'] = getDeclined($userId);
		echo json_encode($data);
	}

	function getFriends($userId){
		$sqlObj = connect();
		$sql = "SELECT users.id, users.nickname as user_nickname, users.register_date, users.image_path 
			from users, requests 
			where requests.status = 1 
			and ((users.id = requests.reciever_id and requests.sender_id = $userId)  
			or (users.id = requests.sender_id and requests.reciever_id = $userId))";
		$answer = $sqlObj->query($sql);
		if($answer){
		 	$friends=[];
		 	while($res = mysqli_fetch_assoc($answer)){
				$friends[] =$res;
		 	}
		}
		return $friends;
	}

	function getRequests($userId){
		$sqlObj = connect();
		$sql = "SELECT users.id, users.nickname as user_nickname, users.register_date, users.image_path 
			from users, requests 
			where requests.status = 2 
			and (users.id = requests.sender_id and requests.reciever_id = $userId)";
		$answer = $sqlObj->query($sql);
		if($answer){
		 	$requests = array();
		 	while($res = mysqli_fetch_assoc($answer)){
				$requests[] = $res;
		 	}
		}
		return $requests;
	}

	function getDeclined($userId){
		$sqlObj = connect();
		$sql = "SELECT users.id, users.nickname as user_nickname, users.register_date, users.image_path 
			from users, requests 
			where requests.status = 0 
			and (users.id = requests.sender_id and requests.reciever_id = $userId)";
		$answer = $sqlObj->query($sql);
		if($answer){
		 	$declined=[];
		 	while($res = mysqli_fetch_assoc($answer)){
				$declined[] = $res;
		 	}
		}
		return $declined;
	}