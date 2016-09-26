<?php
session_start();
?>
<!---
Site : http:www.smarttutorials.net
Author :muni
--->

 
<?php
require 'config.php';
$category='';
if(!empty($_POST['name'])){     
     $name=$_POST['name'];
     $pass=$_POST['password'];
     $email=$_POST['email'];
     $category=$_POST['category'];
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysql_insert_id();
}
$category=$_POST['category'];
$_SESSION['category']=$_POST['category'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)){
mysql_query("INSERT INTO users (id, user_name,score,category_id,name,password )VALUES ('NULL','$email',0,'$category','$name', '$pass')") or die(mysql_error());
mysql_query("INSERT INTO played(name) VALUES('$name')") or die(mysql_error());
?>

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

    <body ng-controller="MyController">
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
            <li><a href="nudge.html">USE NUDGE</a></li>
            <li class='active'><a href="comments.php">COMMENTS</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
    </div>
        <header>
            <p class="text-center">
                Welcome to nudge: <?php if(!empty($_SESSION['email'])){echo $_SESSION['email'];}?>
            </p>
        </header>
<div class ="centered">
 <h2> Thank you for registering. You can now log in and use NUDGE! </h2>
</div>


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
 
        <script>
        $('.cont').addClass('hide');
        count=$('.questions').length;
         $('#question'+1).removeClass('hide');
 
         $(document).on('click','.next',function(){
             element=$(this).attr('id');
             last = parseInt(element.substr(element.length - 1));
             nex=last+1;
             $('#question'+last).addClass('hide');
 
             $('#question'+nex).removeClass('hide');
         });
 
         $(document).on('click','.previous',function(){
             element=$(this).attr('id');
             last = parseInt(element.substr(element.length - 1));
             pre=last-1;
             $('#question'+last).addClass('hide');
 
             $('#question'+pre).removeClass('hide');
         });
 
        </script>
    </body>
</html>
<?php }else{
 
   echo "Please enter a valid email";
   header( 'Location nudge/index.php' ) ;
 
}
?>

