$(document).ready(function(){
	
		var friendsOrigin = sessionStorage.getItem('friendsOrigin');// check which link was clicked "find friends" or "my friends"
		/*
		if findfriends{
			ajax to api/getFriends.php that echos back all friends
		}
		if myfriends{
			ajax to api/myfriends.php that echos back my friends

		}
		build relevant page
	 */
	$('.userSelect').on('click',function(){
		sessionStorage.setItem('lastPage',$(this).attr("data-user-id"))
	})
})

/*




filter bar 
	on	change listener send ajax to relevant php file and get right users
		no results show message
	if empty show all users
	
radio button ajax to relevant php with order ASC DESC

*/