$(document).ready(function(){
	var files;
	var userId = sessionStorage.getItem('userId');
	if(sessionStorage.getItem('lastPage')!=0){
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
		});
		$("#profile-picture img").css('cursor','pointer').click(function(){
			$('#myForm').addClass('animateForm');
		});
		var files;
		$('input[type=file]').on('change', function(e){
			files = event.target.files;
		});
		$('#uploadImage').click(function(){
			var data = new FormData();
			console.log(files[0]);
			var image = files[0];
			data.append('pic', image);
			$.ajax({
		        url: 'api/operations.php?image',
		        type: 'POST',
		        data: data,
		        cache: false,
		        dataType: 'json',
		        processData: false, // Don't process the files
		        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
		        success: function(data, textStatus, jqXHR)
		        {
		            if(typeof data.error === 'undefined')
		            {
		                // Success so call function to process the form
		                submitForm(event, data);
		            }
		            else
		            {
		                // Handle errors here
		                console.log('ERRORS: ' + data.error);
		            }
		        },
		        error: function(jqXHR, textStatus, errorThrown)
		        {
		            // Handle errors here
		            console.log('ERRORS: ' + textStatus);
		            // STOP LOADING SPINNER
		        }
    		});
		})
	}
});


function regDataAndPosts(data){
	var tmp = data.regData;
	$("#user_details").children().each(function(){
		var key = $(this).attr("name");
		this.innerHTML = tmp[key];
	});
	if(tmp['image_path']){
		$("#profile-picture img").attr("src",tmp['image_path']);
	}
	else{
		$("#profile-picture img").attr("src",'api/pics/default.jpg');
	}
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