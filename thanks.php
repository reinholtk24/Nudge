<?php
session_start();
?>
<!---
Site : http:www.smarttutorials.net
Author :muni
--->

 
<?php
require 'config.php';     
     $name=$_POST['name'];
     $email=$_POST['email'];
     $comment=$_POST['comment'];

//if (filter_var($email, FILTER_VALIDATE_EMAIL)){
mysql_query("INSERT INTO comments (id, name, email, comment)VALUES ('NULL','$name','$email','$comment')") or die(mysql_error());
//?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nudge | Dowell Lab</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
      
         <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="assets/css/main.css" rel="stylesheet" media="screen">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen"> 
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/html5shiv.js"></script>
        <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->

    <!-- Fixed navbar -->
    </head>  
     
  <body ng-controller="MyController">

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
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
            <li><a href="nudge.html">USE NUDGE</a></li>
            <li class='active'><a href="comments.php">COMMENTS</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

        <div id="blue">
                <div class="container">
                        <div class="row centered">
                                <div class="col-lg-8 col-lg-offset-2" ng-hide="loginObj.user">
                                        <h4>Thank You!</h4>
                                        <p>your comments are very valuable to us.</p>
                                </div>
                        </div><!-- row -->
                </div><!-- container -->
        </div><!--  bluewrap -->


       <footer>
            <p class="text-center" id="foot">
                &copy; <a href="http://dowell.colorado.edu/" target="_blank">Dowell Lab </a>2013
            </p>
        </footer>
 
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
 
    </body>
</html>
<?//php }else{
 
//   echo "Please enter a valid email";
 //  header( 'Location nudge/index.php' ) ;
 
//}
?>
