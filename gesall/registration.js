$(document).ready(function() {

	//make only characters work
	$(".alpha").on("input", function(){
	  	var alpha = /[^a-zA-Z]/g;
	 	if($(this).val().match(alpha)){
	    	$(this).val( $(this).val().replace(alpha,'') );
	  	}
	});

	//make only characters and numbers work
	$(".alphaNum").on("input", function(){
	  	var alphaNum = /[^a-zA-Z-0-9]/g;
	 	if($(this).val().match(alphaNum)){
	    	$(this).val( $(this).val().replace(alphaNum,'') );
	  	}
	});
	
});

//checks if password match
function Validate() {

    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("repeat_password").value;

    //if passwords does not match
    if (pass1 != pass2) {
        alert("Passwords do not match");

        return false;
    }
    else {
        return true;
    }
    return false;
}
