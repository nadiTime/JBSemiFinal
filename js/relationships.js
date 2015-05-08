$(document).ready(function(){
	const api = 'api/relationships.php';
	$.getJSON(api,{relationships:1})
		.done(function(data){	
			appendData(data);
		})	
	$('.userSelect').on('click',function(){
		sessionStorage.setItem('lastPage',$(this).attr("data-user-id"))
	})
});


function appendData(data){
	for(var obj in data){
		extractData(obj,data[obj]);
	}
}

function extractData(object, data){

	for(var obj in data){
		var details = [];
		details['imgSrc'] = data[obj].image_path;
		details['user_nickname'] = data[obj].user_nickname;
		details['register_date'] = data[obj].register_date;
		details['friend_id'] = data[obj].id;
		var selector;
		
		var userSelect = $("<div class ='userSelect row' data-user-id="+details['friend_id']+"><div class = '2u'><img src ='"+details['imgSrc']+"'/></div><div class='3u'><p class='friend_nickname'>"+details['user_nickname']+"</p></div><div class = '4u$'><p class='register_date'>"+details['register_date']+"</p></div></div>");
		

		if(object=='friends'){
			selector = '#relationships-friends';
		}
		else if(object=='request'){
			selector = '#relationships-requests';	
		}
		else if(object=='declined'){
			selector = '#relationships-declined';
		}
		$(selector).append(userSelect);
	}
	$('.userSelect').each(function(){
		$(this).click(function(){
			console.log("click");
			sessionStorage.setItem('lastPage',$(this).attr("data-user-id"));
			window.location.href = "index.php";
		})
	})

}

