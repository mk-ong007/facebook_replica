$(document).ready( function(){

	//Validate first name
    var firstname_error = true;
    $('#signupFirstname').keyup( function () {
        validateFirstname();
    });

    function validateFirstname()
    {
        var firstNameValue = $('#signupFirstname').val();
        if(firstNameValue.length == '')
        {
            firstname_error = true;
            $('#fname_error').html(" What's your name?");
        } else {
            $('#fname_error').html("");
            firstname_error = false;
        }
        return firstname_error;
    }


    //Validate last name
    var lastname_error = true;
    $('#signupSurname').keyup( function () {
        validateLastname();
    });

    function validateLastname()
    {
        var lastNameValue = $('#signupSurname').val();
        if(lastNameValue.length == '')
        {
            lastname_error = true;
            $('#lname_error').html(" What's your name?");
        } else {
            $('#lname_error').html("");
            lastname_error = false;
        }
        return lastname_error;
    }

    // Validate Email Mobile No.
    var emailMobileError = true;
    $('#signupEmailMobileNo').keyup( function () {
        validateEmailMobile();
    });

    function validateEmailMobile() {
        var signupEmailMobileNo = document.getElementById("signupEmailMobileNo").value;
        var regexEmail = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
        var regexMobile = /^[6-9]{1}[0-9]{9}$/;

        if( regexEmail.test(signupEmailMobileNo) == true  ||  regexMobile.test(signupEmailMobileNo) == true)
        {
            $('#email_mobile_error').html("");
            $('#signupEmailMobileNo').addClass("is-valid");
            emailMobileError = false;
        } else if ( signupEmailMobileNo == "" ){
            emailMobileError = true;
            $('#signupEmailMobileNo').removeClass("is-valid");
            $('#email_mobile_error').html(" You'll use this when you log in and if you ever need to reset your password.");
        } 
         else {
            emailMobileError = true;
            $('#signupEmailMobileNo').removeClass("is-valid");
            $('#email_mobile_error').html(" Please enter a valid mobile number email address.");

        }
        return emailMobileError;
      }

      //validate password
    var passwordError = true;
    $('#signupPassword').keyup( function()
    {
        validatePass();
    });

    function validatePass()
    {
        var signupPassword = $('#signupPassword').val();
        var strength = 0;
        //console.log(signupPassword.length);
        if( signupPassword.length == '')
        {
            passwordError = true;
            $('#password_error').html(" Enter a combination of at least six numbers, latters and punctuation marks (such as ! and &)")
        } else if( signupPassword.length < 6  || !signupPassword.match( /([a-z])/) || !signupPassword.match( /([A-Z])/) || !signupPassword.match(/([0-9])/) || !signupPassword.match(/([!,%,&,@,#,$,^,*,?,_,~])/) ) {
            passwordError = true;
            $('#password_error').html(" Passwords must contain at least 6 characters, including uppercase, lowercase letters, numbers and special character. !");
        } else {
            passwordError = false;
            $('#password_error').html("");

        }
        return passwordError;
    }

    //validate gender
     $('.gender').change( function(){     	
	    if( $('input[id="custom"]:checked').length == 1 ) 
	    { 
	      $('#genderOptional').removeAttr("hidden");
	      $('#selectPronoun').removeAttr("hidden");
	    }
	    else
	    {     
	      $('#genderOptional').prop("hidden","0");
	      $('#selectPronoun').prop("hidden","0");
	    }
		validateGender();
	  });

     var genderError = true;
     function validateGender()
    {

        var gender = $("input[name='gender']:checked").val();
        //console.log(gender);
        if ( gender != undefined )
        {
            $('#gender_error').html("");
            genderError = false;
        } 
        else {
            genderError = true;
            $('#gender_error').html('Please choose a gender.');
        } 
        
        return genderError;
    }

    //date of birth
    var day = $('#day').val();
    var month = $('#month').val();
    var year = $('#year').val();

    $('.dob').change( function(){
        getDob();
    });

    function getDob()
    {
        var monthNo = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

         day = $('#day').val();
         month = $('#month').val();
         year = $('#year').val();

         monthIndex = monthNo.indexOf(month)+1;
        if(monthIndex<10)
        {
            monthIndex = "0"+monthIndex;
        }    
        if(day<10)
        {
            day = "0"+day;
        } 

       dob = year+"-"+monthIndex+"-"+day;
    }
  


    $('#signup').click( function () {
        validateFirstname();
        validateLastname();
        validateEmailMobile();
        validatePass();
        validateGender();
        getDob();

        if( (firstname_error == true) || (lastname_error == true) || (emailMobileError == true) || (passwordError == true) || (genderError == true) )
        {
            return false;
        } else {
            
             	var myKeyVals = { firstName : $('#signupFirstname').val(), lastName : $('#signupSurname').val(), emailMobile : $('#signupEmailMobileNo').val(), password : $('#signupPassword').val(), gender : $("input[name='gender']:checked").val(), dob : dob }
                // jQuery Ajax
                $.ajax({ 
                    type : "POST",
                    url : "http://localhost/MeetMyFriend/login/signup", 
                    data : myKeyVals,  
                    success: function(result){
                            $("#message").html(result);
                            // $("#message").fadeTo(3000, 500).slideUp(500, function() {
                            // $("#message").slideUp(500);});                                     
                    } 
                });

                $("form").each(function(){ this.reset() });
        }
    });
});