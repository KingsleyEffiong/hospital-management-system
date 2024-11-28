function _next_page(next_id) {
    $('.overlay').css('display', 'block'); // Display overlay
    $('.hidden')
    $('.login-div').hide(); // Hide elements with class 'login-div'
    $('.login-div').removeClass('hidden');
    $('#'+next_id).fadeIn(1000); // Fade in element with specified ID
}

function cancel(){
    $('.overlay').css('display', 'none'); // Display overlay
    $('.login-div').hide(); // Hide elements with class 'login-div'
}



const admin_alert =  document.querySelector('.admin_alert');

function s_sign_in(){ 
    var email = $('#admin_email').val();
    var password = $('#admin_password').val();
    if((email!='')&&(password!='')){
        suser_login(email,password);
        $('#admin_verification').removeClass('hide');
        $('#admin_verification').removeClass('vf');
        $('#admin_verification').html('<div>LOGIN SUCCESSFUL! <i class="bi bi-hand-thumbs-up-fill"></i></div> ').fadeIn(100).fadeOut(1000);
    }else{
        $('#admin_verification').removeClass('hide');
        $('#admin_verification').addClass('vf');
        $('#admin_verification').html(`Fill in the neccessary field <i class="bi-exclamation-triangle"></i></i>`)
        $('#admin_verification').fadeIn(500).delay(2000).fadeOut(1000);
    }
}


function suser_login(email,password){
    var action='alogin_check';
    
   //////////////// get btn text ////////////////
   var btn_text=$('#login_btn').html();
   $('#login_btn').html('Authenticating...');
   document.getElementById('login_btn').disabled=true;
   ////////////////////////////////////////////////	
    
    var dataString ='action='+ action+'&email='+ email + '&password='+ password;
   
   $.ajax({
   type: "POST",
   url: "config/code.php",
   data: dataString,
   dataType: 'json',
   cache: false,
   success: function(data){
    var scheck = data.check;

   if(scheck==1){
    $('#success-div').html('<div><i class="bi-check"></i></div> LOGIN SUCCESSFUL!').fadeIn(500).delay(5000).fadeOut(100);
    $('#aloginform').submit();
   }else if(scheck==2){
           $('#warning-div').html('<div><i class="bi-exclamation-triangle"></i></div> Account Suspended<br /><span>Contact the admin for help</span>').fadeIn(500).delay(5000).fadeOut(100);
    }else{
    $('#warning-div').html('<div><i class="bi-exclamation-triangle"></i></div> Login Error!<br /><span>Invalid Email or Password</span>').fadeIn(500).delay(5000).fadeOut(100);

    }
    $('#login_btn').html(btn_text);
    document.getElementById('login_btn').disabled=false;
       $('#login_btn').html('<i class="fa fa-sign-in"></i> Log-In');
   }
   });
}




//////////////////////////////////
function _sign_in(){ 
    var email = $('#email').val();
    var password = $('#password').val();
    var user_id = $('#user_id').val();
    if((email!='')&&(password!='')&&(user_id!='')){
        user_login(email,password,user_id);
    }else{
        $('#staff_verification').removeClass('hide');
        $('#staff_verification').addClass('vf');
        $('#staff_verification').html(`Field in the neccessary field <i class="bi-exclamation-triangle"></i></i>`)
        $('#staff_verification').fadeIn(500).delay(2000).fadeOut(1000);
    }
};


