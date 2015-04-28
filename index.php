 <?php
 session_start(); //temp

 	if(session_status() == PHP_SESSION_NONE) {
 		header('Location:login.php');
 	}

	require_once('templates/head.html');
 ?>
 	<script type="text/javascript" src="js/index.js"></script>

 <?php
 	require_once('templates/header.html');
	require_once('templates/navbar.html');
 ?>
 	<section id="body">
	 	<div id="person">
		 	<div id="profile-picture">	
		 		<img src="api/pics/profile/user.jpg"/>
		 	</div>
			<div id="user-details">
				<p name="name">user name</p>
				<p name="birthdate">birthdate</p>
				<p name="email">nadavcn@gmail.com</p>
			</div>

			<div id="secret-data">secret data goes here</div>
		</div>
		<div id="posts">
			<textarea placeholder="Whats on yur mind?"></textarea>
			<p>example post</p>
		</div>
	 	<div id="request">requests</div>
	 	
	 </section>


<?php
	require_once('templates/footer.html');
?>
