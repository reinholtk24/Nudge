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
     $category=$_POST['category'];
     mysql_query("INSERT INTO users (id, user_name,score,category_id)VALUES ('NULL','$name',0,'$category')") or die(mysql_error());
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysql_insert_id();
}
$category=$_SESSION['category'];
$theanswer=$_POST['theanswer'];
$storylinetite=$_SESSION['storylinetite'];
if(!empty($_SESSION['name'])){
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Responsive Quiz Application Using PHP, MySQL, jQuery, Ajax and Twitter Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../assets/css/style.css" rel="stylesheet" media="screen">
 
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
		    $randnum=rand(0,100);
                    $goto = mysql_query("select gotostorylinetite  from results where storytitle='$category' and storylinetite='$storylinetite' and answer='$theanswer' and startprob<'$randnum' and stopprob>='$randnum';") or die(mysql_error());
		    $rows = mysql_num_rows($goto);
                    $row = mysql_fetch_row($goto);
		    $gotostorylinetite = $row[0];
		    echo nl2br("\n");
		    $res = mysql_query("select * from storytable where storytitle='$category' and storylinetite='$gotostorylinetite'") or die(mysql_error());
                    $row = mysql_fetch_row($res);
                    $secondcol = $row[2];
                    $thirdcol = $row[3];
		    $pos = $row[4]; #are we at the end yet? if you get a 1 you are at the end. If you are in the middle you will get a 2. You will never get a 0 becuase those are starts.
                    echo nl2br("\n");
                    print($thirdcol);
		    $i=1;
		    $_SESSION['storylinetite']=$gotostorylinetite;
		    ?>
		</form>
		<?php if($pos!=1){?>		<form class="form-horizontal" role="form" id='login' method="post" action="storyloop.php">
                    <?php
		    $res2 = mysql_query("select * from answers where storylinetite='$gotostorylinetite' and storytitle='$category';") or die(mysql_error());
		    ?>

		    <div id='question<?php echo $i;?>' class='cont'>
                    <br/>
		    <?php while($row = mysql_fetch_array($res2)){?>
		    <input type="radio" value="<?php echo htmlspecialchars($row['answer']); ?>" name="theanswer" /><?php echo " ";?><?php echo $row['answerchoice'];?>
		    <br/>
		    <?php }?>	
		   <br/>	
		   </div>
		   <button class="btn btn-success btn-block" type="submit">
                                Next
                            </button>
                </form>
		<?php } else {?>
 
<?php  
$K=$row[0];
$final= mysql_query("select * from rewardss where end_id='$K';") or die(mysql_error());
$finalrow = mysql_fetch_row($final);
$statement = $finalrow[2];
$points = $finalrow[3];
$endid = $finalrow[6];
$name=  $_SESSION['name'];
$QU= mysql_query("select * from users where name ='$name';") or die(mysql_error());
$QRow= mysql_fetch_row($QU);
$score = $QRow[2];


$in = mysql_query("INSERT INTO  play(name, storyname, ending) VALUES('$name', '$category', '$endid')") or die(mysql_error());  
$total= $score+$points;

$count = mysql_query("SELECT COUNT(Distinct ending) from play where storyname='$category' and name='$name';") or die(mysql_error());
$scorerow = mysql_fetch_row($count);

?>
 
  <h3> <?php print($statement); ?> </h3>
  <h3> Worth  <?php print($points); ?>  points! </h3>

<?php  mysql_query("UPDATE users SET score=$total WHERE name ='$name';"); 


$tots2 = mysql_query("SELECT COUNT(*) from rewardss;");
$tots = mysql_fetch_row($tots2);

?>
<br>
<h3> You have reached <?php print($scorerow[0]); ?>/<?php print($tots[0]); ?> different endings!
<h3> You now have <?php print($total); ?> total points! </h3>
<br>
<h3> 
<a href="http://dowell.colorado.edu/nudge/index.php">Please Play Again! </a>
</h3>
<br>
<br>

<?php  } ?>


		</hr>
            </div>
	</div>

       <footer>
            <p class="text-center" id="foot">
                <a href="http://dowell.colorado.edu" target="_blank">Dowell Lab Home </a>2014
            </p>
        </footer>
 
<?php } ?>
 
    </body>
</html>
 

