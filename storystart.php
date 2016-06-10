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

$category=$_POST['category'];
$_SESSION['category']=$_POST['category'];
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
    <body>
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
		    print($thirdcol);
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
                &copy; <a href="http://smarttutorials.net/" target="_blank">Smart Tutorials </a>2013
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
 
header( 'Location: http://localhost/input.php' ) ;
 
}
?>

