$(document).ready(function(){
	const api = 'api/userFriends.php';	
	var friendsOrigin = sessionStorage.getItem('friendsOrigin');// check which link was clicked "find friends" or "my friends"

	if(friendsOrigin=='findFriends'){
		$.getJSON(api,{origin:'findFriends'})
		.done(function(data){	
			extractData(data);
		})
	}
	if (friendsOrigin=='myFriends'){
		$.getJSON(api,{origin:'myFriends'})
		.done(function(data){
			extractData(data);
		})
	}
	var search, order;
	$('#search_friends').keyup(function(){
		var data = {origin:friendsOrigin};
		data.search = $(this).val();
		search = $(this).val();
		data.order=order;
		$.getJSON(api,data)
		.done(function(data){
			$('.userSelect').remove();
			extractData(data);
		})
	});

	$('.order').click(function(){
		console.log('here');
		var data = {origin:friendsOrigin};
		data.search = search
		data.order = $(this).val();
		order = $(this).val();
		if($('div.userSelect').length!=1){
			$.getJSON(api,data)
			.done(function(data){
				$('.userSelect').remove();
				extractData(data);
			})
		}
	})
});

function extractData(data){
	for(var obj in data){
		var details = [];
		details['imgSrc'] = data[obj].image_path;
		details['user_nickname'] = data[obj].user_nickname;
		details['register_date'] = data[obj].register_date;
		details['friend_id'] = data[obj].id;
		
		var userSelect = $("<div class ='userSelect row' data-user-id="+details['friend_id']+"><div class = '2u'><img src ='"+details['imgSrc']+"'/></div><div class='3u'><p class='friend_nickname'>"+details['user_nickname']+"</p></div><div class = '4u$'><p class='register_date'>"+details['register_date']+"</p></div></div>");
		$('#friends').append(userSelect);
	}
	$('.userSelect').each(function(){
		$(this).click(function(){
			console.log("click");
			sessionStorage.setItem('lastPage',$(this).attr("data-user-id"));
			window.location.href = "index.php";
		})
	})

}

/*




filter bar 
	on	change listener send ajax to relevant php file and get right users
		no results show message
	if empty show all users
	
radio button ajax to relevant php with order ASC DESC

*/