<?php
session_start();
 	require_once('functions.php');

 	if(isset($_POST['user_nickname'])&&isset($_POST['user_email'])&&isset($_POST['user_birthdate'])&&isset($_POST['user_about'])&&isset($_POST['user_password'])){
 		if(validate($_POST['user_nickname'],$_POST['user_email'],$_POST['user_password'])){
 			$nickname = $_POST['user_nickname'];
 			$email = $_POST['user_email'];
 			$birthdate = $_POST['user_birthdate'];
 			$about = $_POST['user_about'];
 			$password = md5($_POST['user_password']);
 			$active = 1;
 			$sqlObj = connect();
 			if(isset($_POST['update'])){
 				$id = $_POST['update'];
 				$sql = "UPDATE `users` SET `nickname` = '$nickname', `email` = '$email', `birthdate` = '$birthdate', `about` = '$about' WHERE `id` = $id";
 				$answer1= $sqlObj->query($sql);
				$sql="UPDATE `passwords` SET `pass` = '$password' WHERE `user_id` = '$id'";
				$answer2= $sqlObj->query($sql);
 				if($answer2&&$answer1){
					$success = array('success' => 1);
				}
				else{
					$success = array('success' => 0);
				} 
 			}
			else{
				$sql="INSERT INTO `users` (`nickname`,`email`,`birthdate`,`about`) VALUES('$nickname','$email','$birthdate','$about')";
				$answer1= $sqlObj->query($sql);
				$id = $sqlObj->insert_id;
				$sql="INSERT INTO `passwords` (`user_id`,`pass`) VALUES('$id','$password')";
				$answer2= $sqlObj->query($sql);
				if($answer2&&$answer1){
					$success = array('success' => $id);
					$_SESSION['id'] = $id;
				}
				else{
					$success = array('success' => 0);
				} 
			}
			echo json_encode($success);
 		}
 		else{
 			$validate = array('validate' => 0);
 			echo json_encode($validate);
 		}
 	}
 	if(isset($_POST['post'])){
 		$sqlObj = connect();
 		$userId = $_SESSION['id'];
 		$post = $_POST['post'];
 		$sql="INSERT INTO `posts`(`user_id`, `post`) VALUES ('$userId','$post')";
		$answer1= $sqlObj->query($sql);
		if($answer){
			$success = array('success' => 1);
		}
		echo json_encode($success);
 	}
 	

	if(isset($_GET['image'])){ 
		$target = 'pics/profile/';
		if(is_uploaded_file($_FILES['pic']['tmp_name'])){
			$ext = pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
			$name = $_SESSION['id'];
	      	$status = array();
	      	$answer = move_uploaded_file($_FILES['pic']['tmp_name'], $target.$name.".".$ext);
	     	if(!$answer){
	     		$status = array('success' => 0);
	     	}
	     	else{
	     		$path = 'api/'.$target.$name.".".$ext;
	     		updatePicture($path);
	     		$status = array('success' => 1);

	     	}
	     	$fullpath = 'api/'.$target.$name.'.'.$ext;
	      	echo  json_encode($fullpath);
	    }

	}


	function updatePicture($path){
		$id = $_SESSION['id'];
		$sqlObj = connect();
		$sql = "UPDATE `users` SET `image_path` = '$path' WHERE `id` = $id";
		$answer = $sqlObj->query($sql);
		return ($answer);
	}
