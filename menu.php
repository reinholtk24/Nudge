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

//$category = ""; 
//$category = $_SESSION['category'];
 
if(!empty($_POST['name'])){     
	 $name=$_POST['name'];
     $email=$_POST['email'];
     $category=$_POST['category'];
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysqli_insert_id($con);
}
//$_POST['category'] = $category; 

/*
//Verify an answer choice was made before moving on to the next page. 
$answerErr = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['theanswer'])){
		$_SESSION['theanswer'] = $_POST['theanswer']; 
		echo $_SESSION['name'];  
		header("Location: storyloop.php"); 
		exit(); 
	} else{
		$answerErr = "Please select an answer choice to move on."; 
		
	}
}// End of answer choice verification*/
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
			<div class="col-md-8 col-md-offset-2">
				<div class="myMenu">
					<div class="col-md-10 col-md-offset-1"> 
						<div class='row extra-bottom-padding'>	
							<div style="margin-left: 20px;" class='main-menu-logo'>
								<img src="assets/img/MainMenuLogo.png" class="img-responsive"/>
							</div>
						</div>
						<hr style="margin-bottom: 20px;">	
						<h3 style="color: white; margin-bottom: 30px; text-center;"><b><?php echo "Welcome: ".$_SESSION['name'];?></b></h3>
					</div>				
					<div class='row extra-bottom-padding'>	
						<div class="col-md-4 col-md-offset-4">
							<div class='image-start'>
								<a href='select_character.php'><img src="assets/img/Start.png" class="img-responsive"/></a>
							</div>
						</div>
					</div>
					<div class='row extra-bottom-padding'>	
						<div class="col-md-6 col-md-offset-3">
							<div class='image-instructions'>
								<a href="instructions.php"><img src="assets/img/Instructions.png" class="img-responsive"/></a>
							</div>
						</div>
					</div>
					<div class='row'>	
						<div class="col-md-4 col-md-offset-4">
							<div class='image-exit'>
								<a href="index.php"><img src="assets/img/Exit.png" class="img-responsive"/></a>
							</div>
						</div>
					</div>
					<footer>
						<p style="margin-top: 40px;" class="text-center" id="foot">
							&copy; <a href="http://dowell.colorado.edu/" target="_blank">Dowell Lab </a>2013
						</p>
					</footer>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>

