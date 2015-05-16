$(document).ready(function(){
	
	var blurValidate;
	$(".activeInput").each(function(){
		$(this).bind('blur',function(e){
			blurValidate = checkInput(e);
		})
	});

	$.getJSON('api/userDetails.php?userId&userInfo')
	.done(function(data){
		if(data.success){
			$("#update-register").text("update");
        	$(".fromServer").each(function(e){
				var key = $(this).attr("name");
				this.value=data.regData[key];
			});
			$("#update-register").on('click',function(){ 	//UPDATE USER
				var map = {"update":1};
				$(".activeInput").each(function() {
				    map[$(this).attr("name")] = $(this).val();
				});
				if(validate(map,blurValidate)){
					$.post( "api/operations.php", map)
				 	.done(function(data){
					  	var parsed_data = JSON.parse(data);
					    if(parsed_data.success){
					    	alert('update success');
					    	window.location.href = "index.php";
					    }
				  	});
				}
			});
			$('#showSecretUpdate').click(function(){
				$('#secret').show();
				$('#secret').click(function(e){
					if( e.target !== this ){ 
	      				return;
						
					}
					else{
						$(this).hide();
					}
				});
			});
			$('#choose_file').on('click',function(){
				$('input[type=file]').trigger('click');
			});
			var files;
			$('input[type=file]').on('change', function(e){
				files = event.target.files;
				$('#choose_file').text(files[0]['name'])
			});
			$('#uploadSecret').click(function(){
				var data = new FormData();
				var image = files[0];
				data.append('pic', image);
				var note = $('#secret_note').val();
				$.ajax({
			        url: 'api/operations.php?updateSecret='+note,
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
			             	alert('update success');
					    	window.location.href = "index.php";	  
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
		else{
			$("#update-register").on('click',function(){   //REGISTER USER
				var map = {};
				$(".activeInput").each(function() {
				    map[$(this).attr("name")] = $(this).val();
				});
				if(validate(map,blurValidate)){
				$.post( "api/operations.php", map)
				  .done(function(data) {
				  	var parsed_data = JSON.parse(data);
				    if(parsed_data.success){
				    	var id = parsed_data.success;
				    	sessionStorage.setItem("userId",id);
				    	alert('welcome '+map.user_nickname+'! you just registered');
				    	window.location.href = "index.php";
				    }
				  });
				}
			})
		}
	});
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
	if(map.user_password.length<6){
		alert("password must be 6 or more characters");
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