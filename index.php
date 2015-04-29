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
 ?>
 	<section>
	 	<div id="person" class="row">
		 	<div id="profile-picture" class="2u">	
		 		<img src="api/pics/profile/user.jpg"/>
		 	</div>
			<div id="user-details" class="4u">
				<p name="name">user name</p>
				<p name="birthdate">birthdate</p>
				<p name="email">nadavcn@gmail.com</p>
			</div>

			<div id="secret-data" class="4u$">secret data goes here</div>
		</div>
		<div id="posts" class="row">
			<div class="10u">
				<textarea placeholder="Whats on yur mind?"></textarea>
				<div id="posts-view">posts view</div>
			</div>
			<div class="2u"><button>Post</button></div>
		</div>
	 	<div id="request">requests</div>
	 	
	 </section>


<?php
	require_once('templates/footer.html');
?>
