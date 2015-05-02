$(document).ready(function(){
	var userId = sessionStorage.getItem('userId');
	if(sessionStorage.getItem('lastPage')){ //id if from friendships.php or friends.php 0 from else
		var friendId=sessionStorage.getItem('lastPage');
		/*ajax(friendId  and userId) to get friends details from userDetails.php
		
		data returned
		 reg details +sec details + requsests
			build friends page 
			name, birth, email, image, about, posts, secret image, secret data, 
		|| reg details+request status
			name, birth, email, image, about, hisRequest status 1 -> show accept button, 
			myRequest status 1 -> show request sent + date 
		|| reg details
			name name, birth, email, image 
			show add button
*/

	}
	/*take user id from sessionStorage and get user details from userDetails.php
		name, birth, email, image, posts, secret image, secret data
	*/


})


