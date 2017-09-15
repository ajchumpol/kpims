/**
 * validate user form function.
 */
function validateUser(str){

		var vu = validateUsername();
		var ve = validateEmail();
		var vp = validatePassword();
	
		if(vu && ve && vp)	confirmation(str);
}

/**
 * validate password form function.
 */
function validateUserPassword(str){

		var opassword = document.getElementById("i_opassword");
		var vp = false;
		var vo = false;
		opassword.setCustomValidity("");
		if(opassword.value.length < 6){
  			opassword.setCustomValidity("The current password min length 6 characters, please try again!");
			vo = false;
		}else{
			vp = validatePassword();
			vo = true;
		}
		if(vo && vp) confirmation(str);

}

/**
 * validate update user form function.
 */
function validateUpdateUser(str){

	$(document).ready(function(){
	    $("#i_email").on("keyup", function(){
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

}

/**
 * validate password function.
 */
function validatePassword() {
	
  	var password = document.getElementById("i_password");
  	var confirm_password = document.getElementById("i_confirm_password");
	if(password.value.length < 6){
  		password.setCustomValidity("The password min length 6 characters, please try again!");
		return false;
	}else{
		password.setCustomValidity('');
		if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Passwords Don't Match!");
			return false;
		} else {
			confirm_password.setCustomValidity('');
			return true;
		}
	}
	
}

/**
 * validate username/e-mail function.
 */
function validateUsername(){
	$(document).ready(function(){
	    $("#i_username").on("keyup", function(){
	        $.post("../User/validateUsername",
	        {
	          i_username: $("#i_username").val()
	        },
	        function(data, status){
	        	var obj = JSON.parse(data);
	        	if(obj.type == 0){
	        		$("#i_username").css("color","green");
	        		$("#i_username")[0].setCustomValidity('');
					return true;
	        	}else{
	        		$("#i_username").css("color","red");
					$("#i_username")[0].setCustomValidity(obj.error);
					$("#i_username").focus();
					return false;
	            }
	        });
	    });
	});
}

function validateEmail(){
	$(document).ready(function(){
	    $("#i_email").on("keyup", function(){
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
					$("#i_email")[0].setCustomValidity(obj.error);
					$("#i_email").focus();
					return false;
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

function uploading(){

	$(document).ready(function (e) {
		$("#file_upload").on('submit', (function(e) {
			alert('a');
			e.preventDefault();
			$("#message").empty();
			$('#loading').show();
			$.ajax({
				url: "ManageUser/uploading", // Url to which the request is send
				type: "GET",             // Type of request to be send, called as method
				data: { user_id: $_SESSION['s_user_id'] }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
					alert(data);
					$('#loading').hide();
					$("#message").html(data);
				}
			});
		}));
	});

} // end uploading

function onDev(){
	alert("อยู่ระหว่างการพัฒนา?");
}
