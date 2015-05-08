<?php
session_start();
require_once ('functions.php');
	if(isset($_GET['origin'])){
		$userId=$_SESSION['id'];
		$order='user_nickname ';
		$search="";
		if(isset($_GET['order'])){
			$order .= $_GET['order']; //must be asc or desc
		}
		if(isset($_GET['search'])){
			$search .= " AND nickname LIKE '".$_GET['search']."%'";
		}
		if($_GET['origin']=='findFriends'){
			$sqlObj = connect();
			$sql = "SELECT id, nickname as user_nickname, image_path, register_date
			 FROM `users` WHERE id!=$userId".$search." ORDER BY $order";
			 $answer = $sqlObj->query($sql);
			if($answer){
			 	$data=[];
			 	while($res = mysqli_fetch_assoc($answer)){
					$data[] =$res;
			 	}
			}
		}
		elseif($_GET['origin']=='myFriends'){
			$sqlObj = connect();
			$sql = "SELECT users.id, users.nickname as user_nickname, users.register_date, users.image_path 
				from users, requests 
				where requests.status = 1 
				and ((users.id = requests.reciever_id and requests.sender_id = $userId)  
				or (users.id = requests.sender_id and requests.reciever_id = $userId))"
				.$search." ORDER BY $order";
			$answer = $sqlObj->query($sql);
			if($answer){
			 	$data=[];
			 	while($res = mysqli_fetch_assoc($answer)){
					$data[] =$res;
			 	}
			}
		}
		echo json_encode($data);
	}