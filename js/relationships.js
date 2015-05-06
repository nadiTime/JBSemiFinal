$(document).ready(function(){



	$('.userSelect').on('click',function(){
		sessionStorage.setItem('lastPage',$(this).attr("data-user-id"))
	})
})

/*
ajax to api/getAllUsers.php
	returns id userpicpath usernickname requeststatus,0 1 2 
	build correct page

	1 friend lists
	2 waiting acceptens list
	0	declined list
items listener saves friend's id to local javascript or sends to server
*/