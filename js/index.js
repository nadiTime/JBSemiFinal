$(document).ready(function(){
	var userId = sessionStorage.getItem('userId');
	sessionStorage.setItem('lastPage',6);
	if(sessionStorage.getItem('lastPage')){ //id if from friendships.php or friends.php 0 from else
		var friendId=sessionStorage.getItem('lastPage');
		$.getJSON("api/userDetails.php",{userId:userId,friendId:friendId})//ajax(friendId  and userId) to get friends details from userDetails.php
		.done(function(data){
			console.log(data);
		})
		
		/*data returned
		 reg details +sec details + requsest  status 1
			build friends page 
			name, birth, email, image, about, posts, secret image, secret data, 
		|| reg details+request status 2 or 0 
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
	else{$.getJSON("api/userDetails.php",{userId:userId})
		.done(function(data){
			var tmp = data.regData;
			$("#user_details").children().each(function(){
				var key = $(this).attr("name");
				this.innerHTML = tmp[key];
			});
			$("#profile-picture img").attr("src",tmp['image_path']);
			$("#secret_data p").text(data.secret.user_secret_image); 
			$("#secret_data img").attr("src",data.secret.user_secret_note);
			for(var prop in data.posts){
				var post = $("<p class='user_post'>"+data.posts[prop]['post']+"<span class='post_date'>"+data.posts[prop]['post_date']+"</span>");
				$("#posts_view").append(post);
			}
			
		})}

})


