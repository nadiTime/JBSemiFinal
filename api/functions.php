<?php
	function connect(){
		$sqlObj= new mysqli('localhost','root','','jbsemifinal');
		if($sqlObj->connect_errno){
			echo "connection errror";
		}
		else return $sqlObj;
	}
	function validate($nickname,$email,$password){
		$answer=ctype_alnum($password);
		$answer=filter_var($email, FILTER_VALIDATE_EMAIL);
		$answer=(strlen($nickname)>=2);
		return $answer; 
	}
