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
     $email=$_POST['email'];
     $category=$_POST['category'];
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysql_insert_id();
}

$category=$_POST['category'];
$_SESSION['category']=$_POST['category'];
$q2=mysql_query("SELECT * from users where name='$name' and password='$email'") or die(mysql_error());
$r2=mysql_fetch_array($q2);

if(!empty($r2)){
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
            <li><a href="index.php">USE NUDGE</a></li>
            <li class='active'><a href="comments.php">COMMENTS</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
    </div>
        <header>
            <p class="text-center">
                Welcome to nudge: <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
            </p>
        </header>
 
        <div class="container question">
            <div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
                <p>
                    Responsible conduct of research
                </p>
                <hr>
                <form class="form-horizontal" role="form" id='login' method="post">
                    <?php
                    $res = mysql_query("select * from storytable where storytitle='$category' and position=0") or die(mysql_error());
                    $row = mysql_fetch_row($res);
		    $secondcol = $row[2];
		    $thirdcol = $row[3];
		    echo nl2br("\n");
		    print($thirdcol); //prints storyline from storytable
		    $i=1;
		    ?>
		</form>
		<form class="form-horizontal" role="form" id='login' method="post" action="storyloop.php">
                    <?php
		    $_SESSION['storylinetite']='start';
                    $res2 = mysql_query("select * from answers where storylinetite='start' and storytitle='$category';") or die(mysql_error());
		    $n=1;
		    ?>
		    <div id='question<?php echo $i;?>' class='cont'>
                    <br/>
		    <?php while($row = mysql_fetch_array($res2)){?>
		    <input type="radio" value="<?php echo htmlspecialchars($row['answer']); ?>" name="theanswer" /><?php echo " ";?><?php echo $row['answerchoice'];?>
		    <br/>
		    <?php $n++; }?>
		   <br/>
		   </div>
		   <button class="btn btn-success btn-block" type="submit">
                                Next
                            </button>
                </form>
		</hr>
            </div>
	</div>

       <footer>
            <p class="text-center" id="foot">
                &copy; <a href="http://dowell.colorado.edu/" target="_blank">Dowell Lab </a>2013
            </p>
        </footer>
 
    </body>
</html>
<?php
}else{
echo "Username or Password incorrect";
}
