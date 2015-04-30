/*
ajax to ../api/global.php to check session
	returned email nickname birthdate about
	
	build relevant page
	put in relevant fields
	update button

	else there is no session and fields remail empty
	build relevant page
	register button

	email field on focus
*/
$(document).ready(function(){
	$("#update-register").on('click',function(){

		var map = {};
		$(".activeInput").each(function() {
		    map[$(this).attr("name")] = $(this).val();
		});
		validate(map);
		$.post( "api/operations.php", map)
		  .done(function(data) {
		  	var parsed_data = JSON.parse(data);
		  	console.log(parsed_data.success);
		    if(parsed_data.success){
		    	alert('welcome '+map.user_nickname+'! you just registered');
		    	window.location.href = "index.php";
		    }
		  });
	})
});

function validate(map){
	return 1;
}