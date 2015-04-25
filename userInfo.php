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
 ?>
 		<script type="text/javascript" src="js/userInfo.js"></script>
 	</head>
 	<body>
 		user info page


<?php
	require_once('templates/footer.html');
?>