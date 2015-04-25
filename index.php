<!-- 
1. If not logged in redirect to login.php
2. Display user data:
	personal info
	profile picture
	secret picture
	secret note
	user posts (message+date)
3. Navigation menu:
	home -> index.php
	find friends -> friends.php
	my friends -> friends.php
	relatiionships ->relationships.php
	settings -> userInfo.php
4. user can write new posts

 -->

 <?php
	require_once('templates/head.html');
 ?>
 	<script type="text/javascript" src="js/index.js"></script>

 <?php
 	require_once('templates/header.html');
	require_once('templates/navbar.html');
 ?>
 	<div id="info">info div</div>
 	<div id="request">requests</div>
 	<div id="posts">posts here</div>


<?php
	require_once('templates/footer.html');
?>
