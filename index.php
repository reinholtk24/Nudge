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
        <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="assets/css/main.css" rel="stylesheet" media="screen">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/html5shiv.js"></script>
        <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
 
    </head>
    <body>
        <header>
    <!-- Fixed navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.php"><img src="assets/img/logo.png" width="100px"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">HOME</a></li>
            <li><a href="about.html">ABOUT</a></li>
            <li class="active"><a href="index.php">USE NUDGE</a></li>
            <li><a href="comments.php">COMMENTS</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <?php unset($_SESSION['name']); ?>
    <p class="text-center">
                Welcome  <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];} ?>
            </p>
        </header>
      
        <div class="container">
            <div class="row">
                <div class="col-xs-14 col-sm-7 col-lg-7">
                    <div class='image'>
                        <img src="assets/img/logo.png" class="img-responsive"/>
                    </div>
                </div>

         <div class="col-xs-10 col-sm-5 col-lg-5">
                    <div class="intro">
                        <h4 class="centered">
                            Please login
                        </h4> 
                       </div>
                  <form class="form-signin" method="post" id='signin' name="signin" action="copy2.php">
                            <div class="form-group">
                                <input type="text" id='name' name='name' class="form-control" placeholder="Enter your Username"/>
                                <span class="help-block"></span>
                            </div>
                </div>
                <div class="col-xs-10 col-sm-5 col-lg-5">
                    <div class="intro">
                        <?php if(empty($_SESSION['name']))
                               {?>
                        <form class="form-signin" method="post" id='signin' name="signin" action="copy2.php">
                            <div class="form-group">
                                <input type="password" id='email' name='email' class="form-control" placeholder="Enter your password"/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category" id="category">
                                    <option value="0">Choose your category</option>
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
                        <br>
                        <br>
			<div class="intro">	
                        <h4 class="centered">
                            Or Create a new account
                        </h4>
                       </div> 
		<form class="form-signin" method="post" id='signin' name="signin" action="newuser.php">
                            <div class="form-group">
                                <input type="text" id='name' name='name' class="form-control" placeholder="Enter your Username"/>
                                <span class="help-block"></span>
                            </div>
		    <form class="form-signin" method="post" id='signin' name="signin" action="newuser.php">
                            <div class="form-group">
                                <input type="text" id='email' name='email' class="form-control" placeholder="Enter your E-Mail"/>
                                <span class="help-block"></span>
                            </div>
				<form class="form-signin" method="post" id='signin' name="signin" action="newuser.php">
                            <div class="form-group">
                                <input type="text" id='password' name='password' class="form-control" placeholder="Enter your Password"/>
                                <span class="help-block"></span>
                            </div>
				<br>
                    <button class="btn btn-success btn-block" type="submit">
                                Next
                            </button> 
</div> 
                        <?php }else{?>
                            <form class="form-signin" method="post" id='signin' name="signin" action="storystartcopy.php">
                            <div class="form-group">
                                <select class="form-control" name="category" id="category"
                                    <option value="">Choose your category</option>
                                  <option value=1>temptext</option>
				  <option value=2>Authorship</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
 
                            <br>
                            <button class="btn btn-success btn-block" type="submit">
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
                &copy; <a href="http://dowell.colorado.edu/" target="_blank">Dowell Lab 2014 </a>
            </p>
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"</script>
 
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
