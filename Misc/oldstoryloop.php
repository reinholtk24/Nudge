<?php
session_start();
?>
<!---
Site : http:www.smarttutorials.net
Author :muni
--->

<?php
print("Hello");
print($category)
?>
 
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
if(!empty($_SESSION['name'])){
?>
<?php
print("Hello");
print($category)
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Responsive Quiz Application Using PHP, MySQL, jQuery, Ajax and Twitter Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
 
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
                <form class="form-horizontal" role="form" id='login' method="post" action="result.php">
                    <?php
                    $res = mysql_query("select * from storytable where storytitle='$category' and position=0") or die(mysql_error());
                    $rows = mysql_num_rows($res);
                    $row = mysql_fetch_row($res);
		    $secondcol = $row[2];
		    $thirdcol = $row[3];
		    print($secondcol);
		    echo nl2br("\n");
		    print($thirdcol);
		    $i=1;
		    ?>
		</form>
		</hr>
            </div>
	</div>

	<div class="container answer">
            <div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
                <p>                    Answers
                </p>
                <hr>
                <form class="form-horizontal" role="form" id='login' method="post" action="result.php">
                    <?php
                    $res = mysql_query("select answer from answers where storytitle='$category' and storylinetite='start'") or die(mysql_error());
                    $rows = mysql_num_rows($res);
                    $i=1;
                while($result=mysql_fetch_array($res)){?>	
                    <?php if($i==1){?>
                    <div id='question<?php echo $i;?>' class='cont'>
                    <p class='questions' id="qname<?php echo $i;?>"> <?php echo $i?>.<?php echo $result['question_name'];?></p>
                    <input type="radio" value="1" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer1'];?>
                   <br/>
                    <input type="radio" value="2" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer2'];?>
                    <br/>
                    <input type="radio" value="3" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer3'];?>
                    <br/>
                    <input type="radio" value="4" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer4'];?>
                    <br/>
                    <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/>                                                                      
                    <br/>
                    <button id='next<?php echo $i;?>' class='next btn btn-success' type='button'>Next</button>
                    </div>    
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

