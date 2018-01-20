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
		<title>SMD | Answer</title>
		  
		<!-- Bootstrap -->
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href="static/app.css" rel="stylesheet" type="text/css">
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    
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
    <div class="col-xs-12 col-sm-12 col-md-10 moduleContainer-normalView">    
        <?php require 'InCompleteRegistrationForm.php' ?>

    <div class="breadcrumb">
        <a href="/MyFirstPHP/?p=blog&a=all" class="breadcrumbLink"><span>Home</span></a>><a href="/MyFirstPHP/?p=blog&a=post&id=<?=$this->oPost->PostId?>" class="breadcrumbLink"><span>Question</span></a>><a href="/" class="breadcrumbLink"><span>Answers</span></a>
        
    </div>
    <div class="blog-detail-container">
    <div class="title-container">  
 
<div class="blog-author">     <div class="blog-author-bio">         <div class="blog-author-all">     
 <div class="pull-left">                 <span class="blog-comments-author">                  
 <a rel=" noopener noreferrer" href="#" class="SocialLink"><?=$this->oPost->AuthorName?></a>                 </span>     
 </div>             <div class="pull-right">                 <span><?=$this->oPost->DateCreated?></span>       
 </div>         </div>         </div> </div>  </div>  
 <div class="detail-main-container">
     <?=nl2br(htmlspecialchars($this->oPost->Answer))?>
     </div>
         
   
      <?php if($this->oPost->IsConsultation>0 && ((int)$this->oPost->UserId===(int)$_SESSION['userId'] || (int)$this->oPost->DoubterUserId===(int)$_SESSION['userId'])): ?>                    
	
            <div class="col-xs-12 col-sm-12 col-md-10 moduleContainer-normalView"> 
                <label>Suggested consultation times:</label>
                <div class="paddingL0 col-xs-12 col-sm-12 col-md-10">
                    <div class="paddingL0 col-xs-12 col-sm-12 col-md-3 marginT5">
                        <span>
                        Sep 27(Wed) : 6:30(PM)         
                    </span>
                    </div>  

                    
                    <div class="paddingL0 col-xs-12 col-sm-12 col-md-2">
                        <?php if((int)$this->oPost->IsUserAcceptConsult==0 && (int)$this->oPost->DoubterUserId===(int)$_SESSION['userId']): ?>                    
                     <input class="btn btn-block bt-login btn-affermative" name="accept_consult" id="accept_consult" type="button" value="Accept" />
                        <?php endif; ?>
                         <?php if((int)$this->oPost->IsUserAcceptConsult>0): ?>                    
                     <input class="btn btn-block bt-login btn-affermativeOne" name="accepted_consult" id="accepted_consult" type="button" value="Accepted" />
                     <input class="btn btn-block bt-login btn-affermativeOne" style="display:none" name="disconnectSession" id="disconnectSession" type="button" value="End Session" />
                     <input class="btn btn-block bt-login btn-affermativeOne" style="display:none"  name="startSession" id="startSession" type="button" value="Start Session" />
                     <div  id="videos">
        <div id="subscriberId"></div>
        <div id="publisherId"></div>
    </div>
 <?php endif; ?>

                    </div>
          
                </div>
            
            
        </div>
<?php endif; ?>

 </div>
        
	</div>
</div>
    <input type="hidden" name="apiKeyhdn" id="apiKeyhdn" value="<?= $_SESSION['apiKey'] ?>" />
              <input type="hidden" name="sessionIdhdn" id="sessionIdhdn" value="<?= $_SESSION['sessionId'] ?>"/>
               <input type="hidden" name="tokenhdn" id="tokenhdn" value="<?= $_SESSION['token'] ?>"/>
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
                        <script type="text/javascript" src="static/app.js"></script>
    
    
    
</body>
</html>
