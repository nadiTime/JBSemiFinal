$(document).ready(function(){
	$('a[href="index.php"').click(function(){
		sessionStorage.setItem('lastPage',0);
	});
	$('.friends').click(function(){
		var friendsOrigin = $(this).attr("name");
		sessionStorage.setItem('friendsOrigin',friendsOrigin);
	});
	
})