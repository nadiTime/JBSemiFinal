$(document).ready(function(){
	if(sessionStorage.getItem('lastPage')){ //id if from friendships.php or friends.php 0 from else
		$friendId=sessionStorage.getItem('lastPage');
	}
	/*ajax/or javascript session request check session last page global.php
		if true return friend id{
			ajax to get friend details from friendDetails and if friends get secret stuff
			build correct page
		}

		else {
			ajax request to get user details from userDetails.php
			build correct page
		}

	*/

})


