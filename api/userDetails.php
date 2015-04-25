<!-- 
get user id and echo's user details
 -->
<?php
	$id = $_SESSION['id'];
	require_once('api/functions.php');
	if(isset($_GET['userDetails'])){
		$friendEmail = $_GET['userDetails'];
		$sqlObj = connect();
		$sql = "SELECT nickname, birthdate, email, about, image_path WHERE email='$friendEmail'";
		$answer = $sqlObj->query($sql);									// select friend from db
		if($answer){
			echo "selected user details";
			while($res = mysqli_fetch_assoc($answer)){
				$row[] = $res;
			}
		} 
		else{
			echo "answer failed1";
		}
		$userId = array_values($row)[0];				//check if friends from request and if so send secret datails
		$sql = "SELECT status WHERE sender_id ='$userId' AND reciever_id = '$id' OR sender_id ='$id' AND reciever_id = '$userId'";
		$answer = $sqlObj->query($sql);
		if($answer){
			$res = mysqli_fetch_assoc($answer);
			$status = $res['status'];
		}
		$userDetails = array_slice($row, 1);

		
	}	
