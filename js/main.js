$(document).ready(function(){
	$('.friends').click(function(){
		var friendsOrigin = $(this).attr("name");
		sessionStorage.setItem('friendsOrigin',friendsOrigin);
	})
})