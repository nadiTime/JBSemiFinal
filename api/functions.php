<?php
	function connect(){
		$sqlObj= new mysqli('localhost','root','','jb');
		if($sqlObj->connect_errno){
			echo "connection errror";
		}
		else return $sqlObj;
	}
	
