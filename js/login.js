$(document).ready(function(){
	$('button').click(function(){
		var map = {};
		$(".activeInput").each(function() {
		    map[$(this).attr("name")] = $(this).val();
		});

		$.getJSON("api/services.php",map)
		.done(function(data){
				console.log(data);
			if(data.success){
				sessionStorage.setItem("userId",data.userId);
				alert("welcome back "+data.nickname);
				window.location.href = "index.php";
			}
			else alert("login failed");
		})
	})
})