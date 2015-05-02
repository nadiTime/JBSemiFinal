 <?php
	require_once('templates/head.html');
	$filename = basename(preg_replace('/\.php$/', '', __FILE__));
	echo "<script src='js/".$filename.".js'></script>";
 	require_once('templates/header.html');
 ?>
 	<section>
 		<h1>userInfotmp</h1>
 		<div class="row ">
			<div class="4u$">
				<input type="email" name="user_email" placeholder="email" class="activeInput fromServer" required autofocus/>
			</div> 
 			<div class="4u">	
  				<input type="password" name="user_password" placeholder="password" class="activeInput" required/>
			</div> 
			<div class="4u$">
			<input type="password" name="re_enter_password" placeholder="re-enter password" class="activeInput" required />
			</div>
			<div class="4u$">	
				<input type="text" name="user_nickname" placeholder="nickname" class="activeInput fromServer" required />
			</div>
			<div class="4u$">
				<input type="date" name="user_birthdate" class="activeInput fromServer" required />
			</div>
			<div class="4u">
				<textarea placeholder="about myself" name="user_about" class="activeInput fromServer"></textarea> 
			</div>
			<div class="2u$"><button id="update-register">register</button></div>

		 </div>
 	</section>


<?php
	require_once('templates/footer.html');
?>