$(document).ready(function(){
	var userId = sessionStorage.getItem('userId');
	if(sessionStorage.getItem('lastPage')){
		var friendId=sessionStorage.getItem('lastPage');
		$.getJSON("api/userDetails.php",{userId:userId,friendId:friendId})//ajax(friendId  and userId) to get friends details from userDetails.php
		.done(function(data){
			regDataAndPosts(data); // all the regular data and posts
			//check request
			if(data.requests){			
				var request = data.requests;
				if(request['status']==1){   //friends, there is secret data in the object
					secData(data);
					
				}
				else if(request.sender_id==userId){		//show sent request and date
					$('#request_button').text('request sent').addClass('sent');		
				}
				else if(request['status']==2){  //show accept button
					$('#request_button').text('accept').addClass('sent');
				}
			}
			else{      //+ add button
				$('#request_button').text('add friend');
				$('#request_button').on('click',function(){
					$(this).text('request sent').addClass('sent');
				});
			}
		})
	}
	else{ 									//load user page
		$('#new_post').show();
		$('#new_post button').click(function(){
		var newPost = $('#new_post textarea').val();
			if(newPost){
				var time = timeConverter(Math.round((new Date()).getTime() / 1000));

				$.post('api/operations.php',{post:newPost})
				.done(function(){
					var post = $("<p class='user_post'>"+newPost+"<span class='post_date'>"+time+"</span>");
					$("#posts_view").prepend(post);
				})
			}
			
		});
		$.getJSON("api/userDetails.php",{userId:userId})
		.done(function(data){
			regDataAndPosts(data);
			secData(data);
		})
	}
});



function regDataAndPosts(data){
	var tmp = data.regData;
	$("#user_details").children().each(function(){
		var key = $(this).attr("name");
		this.innerHTML = tmp[key];
	});
	$("#profile-picture img").attr("src",tmp['image_path']);
	for(var prop in data.posts){
		
		var date = timeConverter(Math.round((new Date(Date.parse(data.posts[prop]['post_date']))).getTime() / 1000));
		var post = $("<p class='user_post'>"+data.posts[prop]['post']+"<span class='post_date'>"+date+"</span>");
		$("#posts_view").append(post);
	}
}


function secData(data){
	$('#request_button').hide();
	if(data.secret){
		$('#secret_data').show();
		$("#secret_data p").text(data.secret.user_secret_image); 
		$("#secret_data img").attr("src",data.secret.user_secret_note);
	}

}

function timeConverter(UNIX_timestamp){
  var a = new Date(UNIX_timestamp*1000);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var zero = '';
  if(min<10){
	min = '0'+min;
  }
  var time = date + ',' + month + ' ' + year + ' ' + hour + ':' + min;
  return time;
}