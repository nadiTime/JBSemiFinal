<!-- 
1. show list of items as users
	each item show:
		a. user picture
		b. nickname
		c. register date
	-if the user got here from "find friends" link -> show all users
	-if -"- -"- -"- -"- -"- -"- "my friends" link -> show only users friends
	*make shure not to show the loged in user
2. filter menu:
	search by name:
		a. typing in the input will display the results dynamically (ajax)
		b. empty input will display all the results
		c. if there are no results show a message
	order results ASC or DESC (with radio buttons) (ajax)
		a. on selection the display will change dynamically

 -->

<?php
	require_once('templates/head.html');
	$filename = basename(preg_replace('/\.php$/', '', __FILE__));
	echo "<script src='js/".$filename.".js'></script>";
 	require_once('templates/header.html');
 ?>
  <section>
  	<div class="row" id="filter">
  		<div class="3u$">
  			<h1>friends</h1>
  		</div>
  		<div class="3u">
  			<label id="search-label">
  				<i class="fa fa-search"></i>
   		 		<input type="text" id="search_friends" placeholder="search..." />
   		 	</label>
  		</div>
  		<div class="5u$">
  			<div class="radio">
			  <input class="order" type="radio" id="myRadio" name="order" value="asc">
			  <label for="myRadio">a-z</label>
			  <input class="order" type="radio" id="myRadio1" name="order" value="desc">
			  <label for="myRadio1">z-a</label>
			</div>
  		</div>
  	</div>
  	<div class="row">
  		<div class="5u$" id="friends">

  		</div>
  	</div>
  </section>