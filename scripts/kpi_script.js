/**
 * validate user form function.
 */
function validateUser(str){

	$(document).ready(function(){

	    $("#i_email").one("change", function(){
	        $.post("../User/validateUsername",
	        {
	          i_email: $("#i_email").val()
	        },
	        function(data, status){
	        	var obj = JSON.parse(data);
	        	if(obj.type == 0){
	        		$("#i_email").css("color","green");
	        		$("#i_email")[0].setCustomValidity('');
	        		return true;
	        	} else {
	        		$("#i_email").css("color","red");
	        		$("#i_email").focus();
					$("#i_email")[0].setCustomValidity(obj.error);
					return false;
	        	}
	        });
	    });

	    // check form
	    var username = document.getElementById("i_username");
	    var password = document.getElementById("i_password");
		var confirm_password = document.getElementById("i_confirm_password");
		if(username.value.length >= 4) {
			if(!validateUpdateUser(str)){
				username.setCustomValidity("Username is already exist!");
				return false;
			}
		} else if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Passwords Don't Match!");
			return false;
		} else {
			if(password.value.length < 6) {
				password.setCustomValidity("The password min length 6 characters, please try again!");
				return false;
			} else {
				password.setCustomValidity('');
				confirm_password.setCustomValidity('');
				return true;
			}
		}

		// call confirmation script, after validate
		//confirmation(str);
	});

}

/**
 * validate update user form function.
 */
function validateUpdateUser(str){

	$(document).ready(function(){
	    $("#i_email").one("change", function(){
	        $.post("../User/validateUsername",
	        {
	          i_email: $("#i_email").val()
	        },
	        function(data, status){
	        	var obj = JSON.parse(data);
	        	if(obj.type == 0){
	        		$("#i_email").css("color","green");
	        		$("#i_email")[0].setCustomValidity('');
	        		return true;
	        	} else {
	        		$("#i_email").css("color","red");
	        		$("#i_email").focus();
					$("#i_email")[0].setCustomValidity(obj.error);
					return false;
	        	}
	        });
	    });
	});

	//if(confirm(str))
	//	return true;
	//return false;
}

/**
 * validate password function.
 */
function validatePassword(){
  var password = document.getElementById("i_password");
  var confirm_password = document.getElementById("i_confirm_password");
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match!");
  } else {
  	if(password.value.length < 6)
  		password.setCustomValidity("The password min length 6 characters, please try again!");
  	else
  		password.setCustomValidity('');
    confirm_password.setCustomValidity('');
  }
}

/**
 * validate username/e-mail function.
 */
function validateUsername(){
	$(document).ready(function(){
	    $("#i_username").one("change", function(){
	        $.post("../User/validateUsername",
	        {
	          i_username: $("#i_username").val()
	        },
	        function(data, status){
	        	var obj = JSON.parse(data);
	        	if(obj.type == 0){
	        		$("#i_username").css("color","green");
	        		$("#i_username")[0].setCustomValidity('');
	        	}else{
	        		$("#i_username").css("color","red");
	            	$("#i_username").focus();
					$("#i_username")[0].setCustomValidity(obj.error);
	            }
	        });
	    });
	});
}

function validateEmail(){
	$(document).ready(function(){
	    $("#i_email").one("change", function(){
	        $.post("../User/validateUsername",
	        {
	          i_email: $("#i_email").val()
	        },
	        function(data, status){
	        	var obj = JSON.parse(data);
	        	if(obj.type == 0){
	        		$("#i_email").css("color","green");
	        		$("#i_email")[0].setCustomValidity('');
	        	} else {
	        		$("#i_email").css("color","red");
	        		$("#i_email").focus();
					$("#i_email")[0].setCustomValidity(obj.error);
	        	}
	        });
	    });
	});
}

function confirmation(str){
	if(confirm(str))
		return true;
	return false;
}
