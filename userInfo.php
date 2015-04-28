<!-- 
1. this file is used for registration AND updating user details
	-if there is no authentication the fields are empty for registration
	-if there is authentication:
		a. user details in the field (ajax)
		b. display the navigation menu (ajax)
			option to deactivate account
				wont show on friends.php and friendships.php
				no way to get the user profile from the url
2. use HTML5 to build the fields (we'er going to use ajax so no need for 'form'):
	email
	password
	re-password
	nickname
	birth date
	about myself
	save button
3. client side validation
	use as much HTML5
	show errors when validation fails
	required -> email, password, re-enter, nicakname, birthdate
	email input should be focused on page load
	password can contain letters and numbers only
	re-enter must match password
4. re-enter password will not be sent to server
	email should be unique (ajax)
5. show server validation errors/success (ajax)
6. if all validation passes:
	on registration:
		insert user details in user table
		login user and redirect to index.php
	on updating details:
		update user details
		redirect to index.php
 -->
 <?php
	require_once('templates/head.html');
	$filename = basename(preg_replace('/\.php$/', '', __FILE__));
	echo "<script src='js/".$filename.".js'></script>";
 	require_once('templates/header.html');
 ?>
 	<section id="body">
 		<h1>userInfotmp</h1>

 		<div id="userInfo">
 			<form action="" method="post"> 
	 			<label for="user_email">email</label> 
	 			<input type="email" name="user_email" required autofocus/>
	 			<label for="user_password">password</label>
	 			<input type="password" name="user_password" required/>
	 			<label for="re-enter_password">re-enater password</label>
	 			<input type="password" name="re-enter_password" required />
	 			<label for="user_nickname">nickname</label>
	 			<input type="text" name="user_nickname" required />
	 			<label for="user_birthdate">birth date</label>
	 			<input type="date" name="user_birthdate" required />
	 			<textarea placeholder="about myself" name="user_about"></textarea> 
	 			<div id="update-register">update-register</div>
 			</form>

 		</div>

 	</section>


<?php
	require_once('templates/footer.html');
?>