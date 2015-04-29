<!-- 
this page shows three lists side by side
	1. friends list:
		displays a list of user's friends (small pic and nickname)
	2. requests list:
		displays a list of the user's requests sent by other users
		each item on the list will display:
			a. user small pic
			b. nickname
			c. accept button
			d. decline button
		when clicking on accept the user will move to friends list + ajax
		when clicking on decline the user will move to declined llist + ajax
	3. declined list:
		displays a list of the users that our user declined
		each item on the list will display:
			a. user small pic
			b. nickname
			c. "regret" button
		when clicking on regret the user will move to friends list + ajax
	4. display the navigation menu
	5. clicking on any item from the list (exept buttons) will redirect to index.php and show the user
	   details as metioned in friends.php
 -->
<?php
	require_once('templates/head.html');
	$filename = basename(preg_replace('/\.php$/', '', __FILE__));
	echo "<script src='js/".$filename.".js'></script>";
 	require_once('templates/header.html');
?>
	<section>
		<div class="row">
			<div class="3u$">
				<h1>relationships</h1>
			</div>
		</div>
		<div class="row">
			<div class="4u" id="relationships-friends">
				<h3>friends</h3>
			</div>
			<div class="4u" id="relationships-requsts">
				<h3>requests</h3>
			</div>
			<div class="4u" id="relationships-declined">
				<h3>declined</h3>
			</div>
		</div>
	</section>