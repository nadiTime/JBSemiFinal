<?php
session_start();
	require_once('functions.php');
	//get user email and password, check for coralation and start session with user id
	if(isset($_GET['user_email'])&&isset($_GET['user_password'])){
		$email = $_GET['user_email'];
		$passwordFromUser = md5($_GET['user_password']);		//get the user id by email
		$sqlObj = connect();
		$sql = "SELECT `id`,`nickname` FROM `users` WHERE `email`='$email'";
		$answer = $sqlObj->query($sql);								
		$arr =[];
		$arr['success'] =0;
		if (mysqli_num_rows($answer) > 0){
			$res = mysqli_fetch_assoc($answer);
			$id = $res['id'];

			$sql = "SELECT `pass` FROM `passwords` WHERE `user_id`='$id'"; //check if the same passwords
			$answer = $sqlObj->query($sql);	
			$passwordFromServer = mysqli_fetch_assoc($answer);
			if($passwordFromUser==$passwordFromServer['pass']){

				$_SESSION['id'] =$id;
				$arr['userId']=$id;
				$arr['nickname'] = $res['nickname'];
				$arr['success'] =1;

			}
		}

		echo json_encode($arr);

												
	}