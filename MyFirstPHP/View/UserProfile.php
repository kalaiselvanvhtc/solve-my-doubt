<?php
/**
 * @author           Pierre-Henry Soria <phy@hizup.uk>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SMD | Profile</title>
		  
		<!-- Bootstrap -->
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet">
		 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/themes/base/jquery-ui.min.css" rel="stylesheet">
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
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-2">
<?php require 'InCompleteRegistrationForm.php' ?>
<form action="" class="form-signin" method="post">

 <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
					<div class="form-group">
                                            <img src="<?=$_SESSION['Profilehoto']?>" class="width100Per" title="Profile Photo" />
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group marginB5">
                                            <h1 class="marginT0"><?=$this->oUserInfo->FullName?></h1>
					</div>
				</div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group marginB5">
                                            <span><?=$this->oUserInfo->Field?></span>
					</div>
				</div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group marginB5">
                                            <span><?=$this->oUserInfo->Degree?></span>
					</div>
				</div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group marginB5">
                                            <span><?=$this->oUserInfo->Specialization?></span>
					</div>
				</div>
			</div>
    <div class="row marginT20">
        <div class="col-xs-12 col-sm-6 col-md-10 col-lg-10">
					<div class="form-group">
                                            <p>
                                                I am a software engineer, product owner and entrepreneur - my core strength lies in envisaging and creating consumer facing software products from the ground up and taking them to market. I have done this for a consumer based eCommerce application, a social network and eCollection application.
                                            </p>
					</div>
				</div>
        <div class="col-xs-12 col-sm-6 col-md-10 col-lg-10">
					<div class="form-group">
                                            <h4>Senior Sofware engineer Htc Global Services</h4>
                                            <p>
                                              Creator of consumer facing software products in the healthcare space(web applications and Android and IOS apps for DigiClinic and Clinician1). My responsibilities range from business (market research, hiring, budgeting) to product(product owner, road map, requirments, focus groups, demos) to engineering (team lead, tech stack, design, QA, tools, processes).
                                            </p>
					</div>
				</div>
        <div class="col-xs-12 col-sm-6 col-md-10 col-lg-10">
					<div class="form-group">
                                            <h3>Content authored on Solve My Doubt</h3>
                                            <div>   <a href="#">
                                                    <span> Interpreting linear expressions</span>
                                                </a></div>
                                            <div>  <a href="#">
                                                    <span>  Algebra foundations</span>
                                            </a>
                                            </div>
					</div>
				</div>
    </div>
	
        <h1><a href="<?=ROOT_URL?>?p=blog&amp;a=post&amp;id=<?=$this->oUserInfo->UserID?>"></a></h1>

</form>
</div>
    
</div>
        </div>
       <?php require 'inc/footer.php' ?>
     

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <script
			  src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
			  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
			  crossorigin="anonymous"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        <script src="static/jquery.autocomplete.multiselect.js"></script>
         <script src="static/default.js"></script>
          
    
</body>
</html>
