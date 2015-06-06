<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cabildear</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php getURL('/lib/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php getURL('/lib/css/styleCustom.css');?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php getURL('/lib/css/thumbnail-gallery.css');?>" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.3&appId=289774607765195";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

   
	<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#FFF;border-color: #FFF;">
        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="padding-top: 10px;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>           
				<a href="<?php getURL('/');?>"><img src="<?php getURL('/lib/img/logo2.png');?>" alt="Smiley face" width="200" height="50"></a>
            </div>
	        
			<form class="navbar-form navbar-right" role="search">
			<a href="<?php getURL('/login/twitter');?>" class="btn btn-default navbar-btn" role="button">Ingresar</a>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar..">
				</div>
				<button type="submit" class="btn btn-default">Buscar</button>
			</form>            
            </div>    
        </div>
        <!-- /.container -->
    </nav>
    