<?php
session_start();
 	require_once('functions.php');
 	if(isset($_POST['user_nickname'])&&isset($_POST['user_email'])&&isset($_POST['user_birthdate'])&&isset($_POST['user_about'])&&isset($_POST['user_password'])){
 		if(validate($_POST['user_nickname'],$_POST['user_email'],$_POST['user_password'])){
 			$sqlObj = connect();
 			$nickname = mysqli_real_escape_string($sqlObj, $_POST['user_nickname']);
 			$email = mysqli_real_escape_string($sqlObj,$_POST['user_email']);
 			$birthdate = mysqli_real_escape_string($sqlObj,$_POST['user_birthdate']);
 			$about = mysqli_real_escape_string($sqlObj,$_POST['user_about']);
 			$password = md5($_POST['user_password']);
 			$active = 1;
 			
 			if(isset($_POST['update'])){
 				$update = updateUserDetails($nickname,$email,$birthdate,$about,$password);
 				if($update['user']&&$update['pass']){
					$success = array('success' => 1);
				}
				else{
					$success = array('success' => 0);
				} 
 			}
			else{
				$answer1=insertNewUser($nickname,$email,$birthdate,$about);
				$user_id = $answer1['id'];
				$answer2= insertPasswordandDefaultSecret($user_id,$password);
				if($answer2&&$answer1['answer']){
					$success = array('success' => $user_id);
					$_SESSION['id'] = $user_id;
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
 		$answer = insertNewPost($_POST['post']);
		if($answer){
			$success = array('success' => 1);
		}
		echo json_encode($success);
 	}
 	

	if(isset($_GET['image'])){ 
		$fullPath = uploadUserImage();
		echo json_encode($fullPath);
	}

	if(isset($_GET['updateSecret'])){
		$answer = updateSecret();
		echo $answer;
	}

	if(isset($_GET['requestToHandle'])&&isset($_GET['declined'])){
		$friend_id = $_GET['requestToHandle'];
		$declined = $_GET['declined'];
		$success = handleRequests($friend_id,$declined);
		echo $success;
	}


	

