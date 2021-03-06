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
		<title><?=htmlspecialchars($this->oPost->title)?></title>
		  
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
    <div class="col-xs-12 col-sm-12 col-md-10 moduleContainer-normalView">    
        <?php require 'InCompleteRegistrationForm.php' ?>
<?php if (empty($this->oPost)): ?>
    <p class="error">The post can't be be found!</p>
<?php else: ?>
    <div class="breadcrumb">
        <a href="/MyFirstPHP/?p=blog&a=all" class="breadcrumbLink"><span>Home</span></a>><a href="/" class="breadcrumbLink"><span>Question</span></a>
         <?php
            $oPost = $this->oPost;
            require 'inc/control_buttons.php';
        ?>
    </div>
    <div class="blog-detail-container">
    <div class="title-container">  
 <p >  <?=nl2br(htmlspecialchars($this->oPost->body))?></p>     
  </div>  
 <div class="detail-main-container">
   
     </div>
          <div class="pull-left tag"> <ul class="list-row-tags">
            <?php foreach (explode(',', $this->oPost->Tag) as $tag): ?>
            <li><a href="#"><?=$tag?></a></li>
    <?php endforeach ?>
</ul></div>
       
   <div class="detail-main-container blog-author">     <div class="blog-author-bio">         <div class="blog-author-all">     
 <div class="pull-left">                 <span class="blog-comments-author">                  
 By <a rel=" noopener noreferrer" href="#" class="SocialLink"><?=$this->oPost->AuthorName?></a>                 </span>     
 </div>             <div class="pull-right">                 <span><?=$this->oPost->createdDate?></span>       
 </div>         </div>         </div> </div>

<?php endif ?>
 </div>
    <div class="row">
         
        <div class="col-xs-12 col-sm-12 col-md-12">
            
<?php include('answerdata.php'); ?>
            
        </div></div>
    
    
	</div>
               <form  method="post"  action="">
            <div style='display: none' class='col-xs-12 col-sm-12 col-md-12 moduleContainer-normalView' id='postAnswerCont'>
                      <?php if($this->oPost->createdbyuserid!=(int)$_SESSION['userId']): ?>                    

                <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 marginT5">

        <div class="form-group col-xs-12 col-sm-6 col-md-6">
           <input type="checkbox" id="AllowConsultation" name="AllowConsultation" checked value='allowconsult' />
           <label for="AllowConsultation">Also offer 1-1 consultation</label>
                       </div>  
    </div></div> 
                <?php endif; ?>

    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10">
       <div class="form-group col-xs-12 col-sm-10 col-md-10">
                         <textarea name="answerbody" id="answerbody" rows="5" cols="35" class="form-control" placeholder="Answer" required="required"></textarea>
                       </div>  
       
    </div></div>
             <div class="form-group col-xs-12 col-sm-12 col-md-2 pull-left paddingL0 paddingR0">
                            <input class="btn btn-block bt-login btn-affermative" name="submit_answer" id="submit_answer" type="submit" value="Submit" />
                        </div>
            </div>  
                   </form>
     <div class="form-group col-xs-12 col-sm-12 col-md-2 pull-left paddingR0 marginT20">
                            <input class="btn btn-block bt-login btn-affermative" name="add_answer" id="add_answer" type="button" value="Answer this question .." />
                        </div>
              <?php if((int)$this->oPost->createdbyuserid===(int)$_SESSION['userId']): ?>      
            <a href="<?=ROOT_URL?>?p=blog&amp;a=edit&amp;id=<?=$this->oPost->id?>" class="pull-right edit-blog-entry" rel=" noopener noreferrer">
        <img src="<?=ROOT_URL?>/images/ic_edit.png"></a>
            <?php endif; ?>
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