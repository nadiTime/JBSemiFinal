<?php
require_once('DB.class.php');
	function connect(){
		$sqlObj= DB::getInstance();
		if($sqlObj->connect_errno){
			echo "connection error";
			die;
		}
		else return $sqlObj;
	}
	function validate($nickname,$email,$password){
		$answer=ctype_alnum($password);
		$answer=filter_var($email, FILTER_VALIDATE_EMAIL);
		$answer=(strlen($nickname)>=2);
		return $answer; 
	}

	/*
		get user register details
		returns array, answer and insert id
	 */
	function insertNewUser($nickname,$email,$birthdate,$about){
		$sqlObj = connect();
		$sql="INSERT INTO `users` (`nickname`,`email`,`birthdate`,`about`) VALUES('$nickname','$email','$birthdate','$about')";
		$insert = array();
		$insert['answer'] = $sqlObj->query($sql);
		$insert['id'] = $sqlObj->insert_id;
		return  $insert;
	}

	function insertPasswordandDefaultSecret($id,$password){
		$sqlObj = connect();
		$sql="INSERT INTO `passwords` (`user_id`,`pass`) VALUES('$id','$password'); INSERT INTO `secret`(`user_id`, `note`) VALUES ('$id','my secret note')";
		$answer = mysqli_multi_query($sqlObj,$sql); 
		return $answer;		
	}

	function updateUserDetails($nickname,$email,$birthdate,$about,$password){
		$sqlObj = connect();
		$update = array();
		$id = $_SESSION['id'];
		$sql = "UPDATE `users` SET `nickname` = '$nickname', `email` = '$email', `birthdate` = '$birthdate', `about` = '$about' WHERE `id` = $id";
		$update['user']= $sqlObj->query($sql);
		$sql="UPDATE `passwords` SET `pass` = '$password' WHERE `user_id` = '$id'";
		$update['pass']= $sqlObj->query($sql);
		return $update;
	}

	function insertNewPost($post){
		$sqlObj = connect();
 		$userId = $_SESSION['id'];
 		$post = $_POST['post'];
 		$sql="INSERT INTO `posts`(`user_id`, `post`) VALUES ('$userId','$post')";
		$answer= $sqlObj->query($sql);
		return $answer;
	}

	function uploadUserImage(){
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
	      	return $fullpath;
	    }
	}

	function updatePicture($path){
		$id = $_SESSION['id'];
		$sqlObj = connect();
		$sql = "UPDATE `users` SET `image_path` = '$path' WHERE `id` = $id";
		$answer = $sqlObj->query($sql);
		return ($answer);
	}

	function updateSecret(){
		if(is_uploaded_file($_FILES['pic']['tmp_name'])){
			$sqlObj = connect();
	 		$userId = $_SESSION['id'];
	 		$target = 'pics/secret/';
	 		$ext = pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
	      	$status = array('success'=>1);
	      	$answer = move_uploaded_file($_FILES['pic']['tmp_name'], $target.$userId.".".$ext);
	     	if(!$answer){
	     		$status = array('success' => 0);
	     	}
	     	else{
	     		$path = 'api/'.$target.$userId.".".$ext;
	     		$note = $_GET['updateSecret'];
				$sql = "UPDATE `secret` SET `secret_image_path`='$path', `note`='$note' WHERE user_id = $userId";
				$answer1= $sqlObj->query($sql);
				if(!$answer){
					$status['success'] = 0;
				}
			}
			return json_encode($status);
		}
	} 

	function handleRequests($friend_id,$declined){
		$success=array(0=>false);
		$user_id = $_SESSION['id'];
		$sqlObj = connect();
		$sql = "SELECT `status` FROM `requests` WHERE `sender_id` = '$friend_id' AND `reciever_id` = '$user_id'";
		$answer= $sqlObj->query($sql);
		$tmp = mysqli_fetch_assoc($answer);
		if($tmp['status']==2){
			$sql = "UPDATE `requests` SET `status`='$declined' WHERE reciever_id = '$user_id'";
			$answer= $sqlObj->query($sql);
			if ($answer) {
				$success[0]=1;
			}
			else{;
				$success[0]=0;				
			}
		}
		elseif($tmp['status']!=1){
			$sql = "INSERT INTO `requests`(`sender_id`, `reciever_id`, `status`) VALUES ('$user_id','$friend_id',2)";
			$answer= $sqlObj->query($sql);
			if ($answer) {
				$success[0]=2;
			}
			else{
				$success[0]=0;				
			}			
		}
		return json_encode($success);
	}