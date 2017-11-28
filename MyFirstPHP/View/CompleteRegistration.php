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
		<title>SMD | Sign Up</title>
		  
		<!-- Bootstrap -->
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		
                <link href="static/style.css" rel="stylesheet" type="text/css"/>
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
<body>
    
    
 <div id="content-wrapper">
	<div class="container">
	<div class="login-form">
            <div class="NetworkLogo"><a class="logo" href="#"><span class="logotext">Step1: Complete your registration</span></a>
            </div>
               
		<form id="login-form" method="post" class="form-signin" action="?p=Registration&amp;a=update">
                    <?php require 'inc/msg.php' ?>
			<input name="verificationCode"  style="margin-bottom: 30px;" value="" required="required" id="verificationCode" type="number" class="form-control"placeholder="Verification Code" autofocus> 
                        <input name="name" id="name" style="margin-bottom: 30px;" required="required" type="text" class="form-control"placeholder="Name" /> 
                        <input name="email" id="email" style="margin-bottom: 30px;" required="required" type="email" class="form-control"placeholder="Email" /> 
                        <input name="password" id="password" required="required" type="password" class="form-control"placeholder="Password" /> 
			<input name="OTPhidden" type="hidden" value="<?=htmlspecialchars($_SESSION["OTP"])?>" />
                        <input name="numberhidden" type="hidden" value="<?=htmlspecialchars($_SESSION["PhoneNumber"])?>" />
			<button class="btn btn-block bt-login" type="submit">Submit</button>
		
           
            </form>
            
<!-- HTML for displaying user details -->

           
	</div>
</div>
     </div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script>
          </script>
    
</body>
</html>
