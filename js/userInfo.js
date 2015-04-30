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
	$.getJSON("api/userDetails.php",{user_id:'1'})
	.done(function(data){
		if(data.session){
			var tmp = data.data;
			for(key in tmp){
				if($(".fromServer").attr('name')==key){
					
					$(this).value=tmp.key;
				}
			}
		}
	});
	var blurValidate;
	$(".activeInput").each(function(){
		$(this).bind('blur',function(e){
			blurValidate = checkInput(e);
		})
	})
	$("#update-register").on('click',function(){

		var map = {};
		$(".activeInput").each(function() {
		    map[$(this).attr("name")] = $(this).val();
		});

		if(validate(map,blurValidate)){
		$.post( "api/operations.php", map)
		  .done(function(data) {
		  	var parsed_data = JSON.parse(data);
		    if(parsed_data.success){
		    	alert('welcome '+map.user_nickname+'! you just registered');
		    	window.location.href = "index.php";
		    }
		  });
		}
	})
});

function checkInput(e){
	if($(e.target).context.name=='user_password'){
		var tmp = alphanumeric($(e.target).val());
		return tmp;
	}
	else{
		return true;
	}
}

function validate(map,blurValidate){
	if(map.user_nickname.length<2){
		alert("nickname must be more than one letter");
		return false;
	}

	if(map.user_password!=map.re_enter_password){
		alert("passwords must match");
		return false;
	}
	if(!blurValidate){
		return false;
	}
	return true;
}

function alphanumeric(alphane){
	var numaric = alphane;
	for(var j=0; j<numaric.length; j++){
		var alphaa = numaric.charAt(j);
		var hh = alphaa.charCodeAt(0);
		if((hh > 47 && hh<58) || (hh > 64 && hh<91) || (hh > 96 && hh<123)){
		}
		else{
			alert("password contains letters and numbers only"); return false;
		}
	}
	return true;
}