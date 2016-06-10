<?php
session_start();
?>
<!---
Site :Nudge
Author :Dowell Lab
--->
 
<?php
require 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nudge</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../assets/css/style.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/html5shiv.js"></script>
        <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
    <!-- Custom styles for this template -->
    <link href="../css/main.css" rel="stylesheet">

	<script src="../assets/js/Chart.js"></script> 
        
    </head>
    <body>

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
            <li class="active"><a href="index.html">HOME</a></li>
            <li><a href="about.html">ABOUT</a></li>
            <li><a href="nudge.html">USE NUDGE</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

        <header>
            <p class="text-center">
                Welcome <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
            </p>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-xs-14 col-sm-7 col-lg-7">
                    <div class='image'>
			<img src="assets/img/logo.png" width=400px"/>
		    </div>
                </div>
                <div class="col-xs-10 col-sm-5 col-lg-5">
                    <div class="intro">
                        <p class="text-center">
                            Please enter your name
                        </p>
                        <?php if(empty($_SESSION['name'])){?>
                        <form class="form-signin" method="post" id='signin' name="signin" action="storystart3.php">
                            <div class="form-group">
                                <input type="text" id='name' name='name' class="form-control" placeholder="Enter your Name"/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category" id="category">
                                    <option value="">Choose your category</option>
                                  <option value="temptest">temptest</option>
				  <option value="Authorship">Authorship</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
 
                            <br>
                            <button class="btn btn-success btn-block" type="submit">
                                 Next
                            </button>
                        </form>
 
                        <?php }else{?>
                            <form class="form-signin" method="post" id='signin' name="signin" action="storystart3.php">
                            <div class="form-group">
                                <select class="form-control" name="category" id="category">
				    <option value="">Choose your story</option>
                                  <option value="temptest">temptext</option>
				  <option value="Authorship">Authorship</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
 
                            <br>
                          <!--  <button color class="btn btn-success btn-block" type="submit"> -->
			    <button style="color:#404040" type="submit">
			    <button style="color:#404040" type="submit" class="btn btn-success btn-block">
			      Next
                          
			    </button>
                        </form>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p class="text-center" id="foot">
                &copy; <a href="http://smarttutorials.net/" target="_blank">Smart Tutorials </a>2013
            </p>
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="../js/jquery.js"></script>
        <script src="../js/js/bootstrap.min.js"></script>
 
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/js/jquery.validate.min.js"></script>
 
        <script>
            $(document).ready(function() {
                $("#signin").validate({
                    submitHandler : function() {
                        console.log(form.valid());
                        if (form.valid()) {
                            alert("sf");
                            return true;
                        } else {
                            return false;
                        }
 
                    },
                    rules : {
                        name : {
                            required : true,
                            minlength : 3,
                            remote : {
                                url : "check_name.php",
                                type : "post",
                                data : {
                                    username : function() {
                                        return $("#name").val();
                                    }
                                }
                            }
                        },
                        category:{
                            required : true
                        }
                    },
                    messages : {
                        name : {
                            required : "Please enter your name",
                            remote : "Name is already taken, Please choose some other name"
                        },
                        category:{
                            required : "Please choose your category to start Quiz"
                        }
                    },
                    errorPlacement : function(error, element) {
                        $(element).closest('.form-group').find('.help-block').html(error.html());
                    },
                    highlight : function(element) {
                        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                    },
                    success : function(element, lab) {
                        var messages = new Array("That's Great!", "Looks good!", "You got it!", "Great Job!", "Smart!", "That's it!");
                        var num = Math.floor(Math.random() * 6);
                        $(lab).closest('.form-group').find('.help-block').text(messages[num]);
                        $(lab).addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
                    }
                });
            });
        </script>
 
    </body>
</html>
