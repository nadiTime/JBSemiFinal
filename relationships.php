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
			<div class="4u" id="relationships-requests">
				<h3>requests</h3>
			</div>
			<div class="4u" id="relationships-declined">
				<h3>declined</h3>
			</div>
		</div>
	</section>