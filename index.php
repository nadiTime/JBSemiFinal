 <?php
 session_start();

 	if(!isset($_SESSION['id'])) {
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
		 		<img src=""/>
		 		<div class="row" id="myForm">
			      <div class="12u"><button id="choose_file">choose file</button><input type="file" name="pic" id="userFile" /></div>
			      <div class="12u"><button id="uploadImage">Upload</button></div>
		    	</div>  
		 	</div>
			<div id="user_details" class="4u">
				<p name="user_nickname"></p>
				<p name="user_birthdate"></p>
				<p name="user_email"></p>
				<button id="request_button"></button>
				<button id="decline_button"></button>
			</div>

			<div id="secret_data" class="4u$">
				<p name = "user_secret_note"></p>
				<div class="6u">
					<img name = "user_secret_image" src=""/>
				</div>
			</div>
		</div>
		<div id="posts" class="row">
			<div id="new_post" class="10u$">
				<textarea placeholder="Whats on yur mind?"></textarea>
				<div class="2u"><button>Post</button></div>
			</div>

			<div class="10u$">
				<div id="posts_view"></div>
			</div>
			
		</div>
	 	<div id="request"></div>
	 	
	 </section>


<?php
	require_once('templates/footer.html');
?>
