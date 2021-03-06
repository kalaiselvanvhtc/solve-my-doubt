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
		<title>Ask Question</title>
		  
		<!-- Bootstrap -->
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
               <?php require 'InCompleteRegistrationForm.php' ?>
<?php if (empty($this->oPost)): ?>
    <p class="error">Post Data Not Found!</p>
<?php else: ?>
    
    <form action="" method="post">
         <h2 class="tagline">Edit Question</h2>
                    <?php require 'inc/msg.php' ?>
      <div class="row">
                           <div class="form-group col-xs-12 col-sm-6 col-md-6">
            <input type="text" name="title" id="title" class="form-control" value="<?=htmlspecialchars($this->oPost->title)?>" required="required" />
                           </div>
      </div>

        <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
            <textarea name="body" id="body" rows="5" cols="35" class="form-control" required="required"><?=htmlspecialchars($this->oPost->body)?></textarea>
        </div>
</div>
          <div class="form-group col-xs-12 col-sm-12 col-md-2 pull-left paddingL0 paddingR0">
                            <input class="btn btn-block bt-login btn-affermative" name="edit_submit" id="edit_submit" type="submit" value="Update" />
                        </div>
        
    </form>
<?php endif ?>
     
<!-- HTML for displaying user details -->

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
