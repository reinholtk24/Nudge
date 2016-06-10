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
                    echo nl2br("\n");
                    print($thirdcol);
		    $i=1;
		    $_SESSION['storylinetite']=$gotostorylinetite;
		    ?>
		</form>
		<form class="form-horizontal" role="form" id='login' method="post" action="storyloop.php">
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
		</hr>
            </div>
	</div>

       <footer>
            <p class="text-center" id="foot">
                &copy; <a href="http://smarttutorials.net/" target="_blank">Smart Tutorials </a>2013
            </p>
        </footer>
 
<?php
 
if(isset($_POST[1])){
   $keys=array_keys($_POST);
   $order=join(",",$keys);
 
   //$query="select * from questions id IN($order) ORDER BY FIELD(id,$order)";
  // echo $query;exit;
 
   $response=mysql_query("select id,answer from questions where id IN($order) ORDER BY FIELD(id,$order)")   or die(mysql_error());
   $right_answer=0;
   $wrong_answer=0;
   $unanswered=0;
   while($result=mysql_fetch_array($response)){
       if($result['answer']==$_POST[$result['id']]){
               $right_answer++;
           }else if($_POST[$result['id']]==5){
               $unanswered++;
           }
           else{
               $wrong_answer++;
           }
 
   }
 
   echo "right_answer : ". $right_answer."<br>";
   echo "wrong_answer : ". $wrong_answer."<br>";
   echo "unanswered : ". $unanswered."<br>";
}
?>
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

