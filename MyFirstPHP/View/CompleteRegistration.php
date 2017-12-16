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
		<title>SMD | Complete Registration</title>
		  
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
 
	<div class="container">
	<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10">    
               
		<form id="login-form" method="post" class="form-signin" action="?p=Registration&amp;a=update">
                    <h2 class="tagline">Complete your registration</h2>
                    <?php require 'inc/msg.php' ?>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                         <input name="verificationCode"  style="margin-bottom: 30px;" value="" required="required" id="verificationCode" type="number" class="form-control"placeholder="Verification Code" autofocus> 
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						 <input name="name" id="name" style="margin-bottom: 30px;" required="required" type="text" class="form-control"placeholder="Name" /> 
					</div>
				</div>
			</div>
		
                   
                       <div class="form-group">
                        <input name="email" id="email" style="margin-bottom: 30px;" required="required" type="email" class="form-control"placeholder="Email" /> 
                       </div>
                        <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                         <input name="password" id="password" required="required" type="password" class="form-control" placeholder="Password" /> 
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						  <input name="confirm_password" id="confirm_password" required="required" type="password" class="form-control" placeholder="Confirm Password" /> 
					</div>
				</div>
			</div>
                       
                       
			<input name="OTPhidden" type="hidden" value="<?=htmlspecialchars($_SESSION["OTP"])?>" />
                        <input name="numberhidden" type="hidden" value="<?=htmlspecialchars($_SESSION["PhoneNumber"])?>" />
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 pull-right paddingR0">
                            <button class="btn btn-block bt-login btn-affermative" type="submit">Submit</button>
                        </div>
		
           
            </form>
            
<!-- HTML for displaying user details -->

        </div>   
	</div>
</div>
      <?php require 'inc/footer.php' ?>
     

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script>
            var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
          </script>
    
</body>
</html>
