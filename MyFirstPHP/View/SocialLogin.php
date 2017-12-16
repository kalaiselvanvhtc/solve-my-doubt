<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SMD | Log In or Sign Up</title>
		    <meta name="google-signin-client_id" content="676124198523-iiq5kq7iicsvmk1etpu2ltqacqppv8v0.apps.googleusercontent.com">
		<!-- Bootstrap -->
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		
                <link href="static/style.css?v=1" rel="stylesheet" type="text/css"/>
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
<body>
    <?php require 'inc/header.php' ?>
<div id="background-carousel">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
          <div id="bg-one" class="item active">
              <img src="images/Globaloria_students_working.jpg" />
          </div>
          <div id="bg-two" class="item">
              <img src="images/play-184783_1920.jpg" />
          </div>
          <div id="bg-third" class="item">
              <img src="images/education2.png" alt=""/>
            
          </div>  
      </div>
    </div>
</div>
    
 <div id="content-wrapper">
	<div class="container">
	<div class="login-form">
            <div class="NetworkLogo"><a class="logo" href="#"><span class="logotext">Login or Join</span></a>
             <h2 class="tagline hidden">Spread the knowledge!</h2>
            </div>
               
		<form id="login-form" method="post" class="form-signin" action="?p=SocialLogin&amp;a=add">
                     <?php require 'inc/msg.php' ?>
			<input name="email" id="email" type="number" class="form-control"placeholder="Phone number" autofocus> 
			<input name="password" id="password" type="password" class="form-control disable" placeholder="Password">
			<button class="btn btn-block bt-login btn-affermative" type="submit">Sign In</button>
		
                          <div class="fb-login-button" data-max-rows="1" data-width="440px" onlogin="checkLoginState();" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-scope="email,user_hometown,user_birthday,user_education_history,user_website,user_work_history" data-use-continue-as="true"></div>
                        
            <input type="submit" name="social_authenticate" id="social_authenticate" value="Login" style="display: none" />
            <input type="hidden" name="social_user_info" id="social_user_info" />
            <!-- HTML for render Google Sign-In button -->
<div id="gSignIn"></div>
            </form>
            
<!-- HTML for displaying user details -->

           
            <div class="form-footer">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<i class="fa fa-lock"></i> 
					<a href="#"> Forgot password? </a>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6">
					<i class="fa fa-check"></i> 
                                        <a href="<?=ROOT_URL?>?p=Registration&amp;a=register"> Click here to register </a>
				</div>
			</div>
		</div>
	</div>
</div>
     <?php require 'inc/footer.php' ?>
     </div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
        <script>
            function onGSuccess(googleUser) {
    var profile = googleUser.getBasicProfile();
    gapi.client.load('plus', 'v1', function () {
        var request = gapi.client.plus.people.get({
            'userId': 'me'
        });
        //Display the user details
        request.execute(function (resp) {
            var profileHTML = '<div class="profile"><div class="head">Welcome '+resp.name.givenName+'! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></div>';
            profileHTML += '<img src="'+resp.image.url+'"/><div class="proDetails"><p>'+resp.displayName+'</p><p>'+resp.emails[0].value+'</p><p>'+resp.gender+'</p><p>'+resp.id+'</p><p><a href="'+resp.url+'">View Google+ Profile</a></p></div></div>';
            
            
            document.getElementById('social_user_info').value =resp.displayName+','+resp.emails[0].value;
            document.getElementById("social_authenticate").click();
            
        });
    });
}
function onGFailure(error) {
    alert(error);
}
function renderButton() {
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 400,
        'height': 40,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onGSuccess,
        'onfailure': onGFailure
    });
}
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        $('#gSignIn').slideDown('slow');
    });
}
            function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
              function statusChangeCallback(response) {
                   if (response.status === 'connected') {
                  FB.api('/me', { locale: 'tr_TR', fields: 'name, email,birthday, hometown,education,gender,website,work' },function(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
   
      // Logged into your app and Facebook.
       document.getElementById('social_user_info').value =response.name+','+response.email;
       document.getElementById("social_authenticate").click();
    
    });
    }
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '683155105225636',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.10'
    });
      
    FB.AppEvents.logPageView();   
   FB.getLoginStatus(function(response) {
       if (response.status === 'connected') {
    FB.api('/me', { locale: 'tr_TR', fields: 'name, email,birthday, hometown,education,gender,website,work' },function(response) {
                   document.getElementById('social_user_info').value =response.name+','+response.email;
                   document.getElementById("social_authenticate").click();
               });
           }
  });

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
</script>
    
</body>

</html>
