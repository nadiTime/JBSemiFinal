<?php
	$userId = $_SESSION["id"];    //saves session user id
	$lastPageFriendId = $_SESSION['lastPageFriendId']; //save the last friend pressed id or 0 if other page

	/*
		post[email]post[password] check, if correct set session to user id
		echo 1
		
	*/

/*<!-- 
here will be the global session variables:
	1. loged in
	2. which page was last,

	


a list of all what the server need to GET:
	USERS:
		pic (path to),
		secret pic (path to),
		nickname,
		email (unique),
		password (only letters and numbers),
		birthdate,
		about (real escape string),
	Posts

a list of all what the server do:
	Insert new users
	update existing users
	manage friend request
	accept/decline/regret request
	delete user

a list of all what the server need to GIVE:
user details
all friends
my friends
friend/not friend details
 -->*/