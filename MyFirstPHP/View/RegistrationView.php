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
		<title>Generate OTP</title>
		  
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
		<form id="login-form" method="post" class="form-signin" action="?p=Registration&amp;a=add">
                    <h2 class="tagline">We will send and SMS with a 4 digit verification code to the phone number provided below. You will need to enter this code in the next screen in order to finish your registration.</h2>
                    <?php require 'inc/msg.php' ?>
                    <div class="form-group paddingL0 col-md-4 col-lg-4 col-sm-12 col-xs-12">
				<input name="phoneNumber" min="10" max="10" id="phoneNumber" style="margin-bottom: 20px;" type="text" class="form-control input-lg" placeholder="Phone number" autofocus /> 
		<input class="btn btn-block bt-login form-control btn-affermative" type="submit" name="generateOTP" id="generateOTP" value="Generate OTP"  />	
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
          </script>
          
    
</body>
</html>
