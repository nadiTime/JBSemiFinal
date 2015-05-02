<!-- 
1. user is logging in with email and password
2. link for registration page (userInfo.php)
3. if failed to login show error message (ajax)
4. success login redirects to index.php
5. while loged in cant get to login page, redirect to index.php
 -->

<?php
session_start();
	if(isset($_SESSION['id'])){
		header('Location:index.php');
		die;
	}
	require_once('templates/head.html');
	$filename = basename(preg_replace('/\.php$/', '', __FILE__));
	echo "<script src='js/".$filename.".js'></script>";
 	require_once('templates/header-only.html');
 ?>
	<section>
		<div class="row">
			<div class="3u$ -4u">
				<h1>Login</h1>
			</div>
			<div class="3u$ -4u">
				<input type="email" placeholder="email" name="user_email" class="activeInput">
			</div>
			<div class="3u -4u">
				<input type="password" placeholder="password" name="user_password" class="activeInput">
			</div>
			<div class="3u$ -2u">
				<a href="userInfo.php">register here</a>
			</div>
			<div class="3u$ -4u">
				<button>Go</button>
			</div>
		</div>
	</section>