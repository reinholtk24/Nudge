<?php
session_start();
?>
<!---
Site : http:www.smarttutorials.net
Author :muni
--->

 
<?php
require 'config.php';
require 'image_dictionary.php'; 

if(!empty($_POST['name'])){     
	 $name=$_POST['name'];
     $email=$_POST['email'];
     $category=$_POST['category'];
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysqli_insert_id($con);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nudge | Dowell Lab</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
       
        <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="assets/css/menu.css" rel="stylesheet" media="screen">
        <link href="assets/css/main.css" rel="stylesheet" media="screen">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen"> 
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/html5shiv.js"></script>
        <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
        <style>
            .container {
                margin-top: 110px;
            }
            .error {
                color: #B94A48;
            }
            .form-horizontal {
                margin-bottom: 0px;
            }
            .hide{display: none;}
        </style>
    </head>

    <body ng-controller="MyController" class="MyMenu">
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.html"><img src="assets/img/logo.png" width="100px"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.html">HOME</a></li>
            <li><a href="about.html">ABOUT</a></li>
            <li><a href="index.php">USE NUDGE</a></li>
            <li class='active'><a href="comments.php">COMMENTS</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
    </div>
    <div class="container question">
		<div class="row">
			<div class="col-md-12 col-md-offset">
				<div class="myMenu-instruction">
					<div class="col-md-10 col-md-offset-1"> 
						<div class='row extra-bottom-padding'>	
							<div style="margin-left: 20px;" class='main-menu-logo'>
								<img src="assets/img/Instructions.png" class="img-responsive"/>
							</div>
						</div>
						<hr style="margin-bottom: 30px;">	
					</div>				
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					  <!-- Indicators -->
					  <ol class="carousel-indicators hidden">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
					  </ol>

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
						<div class="col-md-10 col-md-offset-1 item active">
							<img src="assets/img/selectScreen.png" style="margin-left: auto; margin-right: auto;" class="img-responsive" alt="Chania">
							<div class="col-md-8 carousel-caption">
									<p style="margin-left: -40px;">
										Upon clicking start, you will see a character select screen. There are two characters to choose from, a graduate student and a post-doc. With each character comes a different ethically challenging story-line where your decisions influence the outcomes of you and your research team. 
									</p>
							</div>
						</div>

						<div class="col-md-10 col-md-offset-1 item">
						  <img src="assets/img/questionScreen.png" style="margin-left: auto; margin-right: auto;" class="img-responsive" alt="Chania">
						  <div class="col-md-10 carousel-caption"><p  style="margin-left: -150px;">After selecting a character you will be presented with a scenario, and have the ability to make decisions by clicking on one of the answer choices presented.</p></div>
						</div>
						
						<div class="col-md-10 col-md-offset-1 item">
							<table style="margin-left: auto; margin-right: auto;">
								<tr>
									<td>
										<img src="assets/img/Authorship/badges/4.png" class="img-responsive" alt="Chania">
									</td>
								</tr>
							</table>
						  <p style="color: white; margin-top: 20px;">The goal of the game is to learn about ethical situations and collect all of the ethics badges!</p>
						  <p style="color: white; margin-top: -20px;">Each badge corresponds to alternative ending, collect 4 to unlock the next story-line!</p>
						  <H3 style="color: white; margin-top: -15px;">Good Luck!</H3>
						</div>
					  </div>

					  <!-- Left and right controls -->
					  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div>
					<a href="menu.php"><img id="sm-menu-logo" class="image-back-to-menu img-responsive" src="assets/img/smMenuLogo.png"></a>
				</div>
				<div class="footer">
					<p style="margin-top: -90px;" class="text-center" id="foot">
						&copy; <a href="http://dowell.colorado.edu/" target="_blank">Dowell Lab </a>2013
					</p>
				</div class="footer">
			</div>
		</div>
	</div>
	</body>
</html>

