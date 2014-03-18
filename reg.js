$(document).ready(function(){
  //
  //var valid = function (login,password,re_password,email) {
  //  
  //}
  
  $("#myform").submit(function(e) {
    e.preventDefault();
  });
  
  $("#submit-form").click(function(){
    var login= $("#login").val();
    var password= $("#password").val();
    var re_password= $("#re_password").val();
    var email= $("#email").val();
    var errors = new Array();
    var error = 1;
    var error_login='';
    var error_pass='';
    var bu = '';
    if (login.length < 1 ) {  
      errors.push('not entered login');
      error = 2;
    } else{
    $.ajax({
      type: 'POST',
      async: false,
      url: 'validation/reg_login.php',
      data: 'login='+login,
      success: function(res){
        if (res.indexOf('user_with_thant_name_exist')>-1) {
         // $('.login').append("<span class="error">Erorr</span>");
        errors.push('user witht hant login exist');
        error = 2;
        }
      }
    });
    }
  
    if (password.length < 1 ) {
      errors.push('not entered password');
      error = 2;
    }
    if (re_password.length < 1 ) {
      errors.push('not entered re_password');
      error = 2;
    }
    if (password !== re_password) {
      error = 2;
      errors.push('password and Repassword');
    }
    var  regexp =  /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    
    var pos = email.search(regexp);
    if (email.length <1 || pos < 0) {
      errors.push('wrong email');
      error = 2;
    }else{
      $.ajax({
      type: 'POST',
      async: false,
      url: 'validation/reg_email.php',
      data: 'email='+email,
      success: function(res){
        if (res.indexOf('user_with_thant_email_exist')>-1) {
         // $('.login').append("<span class="error">Erorr</span>");
        errors.push('user with thant email exist');
        error = 2;
        }
      }
    });
    }
    if (error == 1) {
     $.ajax({
      type: 'POST',
      async: false,
      url: 'reg_js.php',
      data: {
        login: login,
        email: email,
        password: password,
      },
      success: function(res){
        document.location.href = 'index.php';
      }
    });
    }else{
      alert( errors);
    }
  });
});