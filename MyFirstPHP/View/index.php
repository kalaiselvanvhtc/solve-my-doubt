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
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet">
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
         
    <div class="col-xs-12 col-sm-12 col-md-12"> 
        
     <?php require 'InCompleteRegistrationForm.php' ?>
<?php if (empty($this->oPosts)): ?>
    <p class="bold">There is no Blog Post.</p>
    <p><button type="button" onclick="window.location='<?=ROOT_URL?>?p=blog&amp;a=add'" class="bold">Add Your First Blog Post!</button></p>
<?php else: ?>
    
       
	</div>
    <div  id="post-data" class="col-xs-12 col-sm-12 col-md-12">
<?php include('data.php'); ?>
    </div>
<?php endif ?>
</div>
</div>
<div class="ajax-load text-center" style="display:none">

    <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>

</div>


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
          
    
<script type="text/javascript">
    
var offSet = 1;
    $(window).scroll(function() {

        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            loadMoreData();

        }

    });


    function loadMoreData(){

      $.ajax(

            {

                url: '/MyFirstPHP/?p=blog&a=index&offSet=' + offSet,

                type: "get",

                beforeSend: function()

                {

                    $('.ajax-load').show();

                }

            })

            .done(function(data)

            {

                $('.ajax-load').hide();

                $("#post-data").append(data);
                offSet++;

            })

            .fail(function(jqXHR, ajaxOptions, thrownError)

            {

                  alert('server not responding...');

            });

    }

</script>



    
    
</body>
</html>
