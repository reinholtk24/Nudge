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
$category='';
if(!empty($_POST['name'])){
     $name=$_POST['name'];
     $category=$_POST['category'];
     mysqli_query($con, "INSERT INTO users (id, user_name,score,category_id)VALUES ('NULL','$name',0,'$category')") or die(_error());
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysql_insert_id();
}
$category=$_SESSION['category'];
$theanswer=$_SESSION['theanswer'];
$storylinetite=$_SESSION['storylinetite'];
$name = $_SESSION['name']; 

//Verify an answer choice was made before moving on to the next page. 
$answerErr = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!empty($_POST['theanswer'])){
		$_SESSION['theanswer'] = $_POST['theanswer']; 
		$_SESSION['storylinetite']=$_SESSION['gotostorylinetite'];
		header("Location: storyloop.php"); 
		exit();
	} else{
		$answerErr = "Please select an answer choice to move on."; 
	}
}// End of answer choice verification


if(!empty($_SESSION['name']) and !empty($category)){
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Responsive Quiz Application Using PHP, , jQuery, Ajax and Twitter Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap >
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="assets/css/style.css" rel="stylesheet" media="screen"-->
        
        <!-- Using style sheets for local server, remove later--> 
        <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="assets/css/main.css" rel="stylesheet" media="screen">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
        <script type="text/javascript"> 
			function onImagesLoaded($container, callback) {
				var $images = $container.find("img");
				var imgCount = $images.length;
				if (!imgCount) {
					callback();
				} else {
					$("img", $container).each(function () {
						$(this).one("load error", function () {
							imgCount--;
							if (imgCount == 0) {
								callback();
							}
						});
						if (this.complete) $(this).load();
					});
				}
			}
		</script>
 
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
    <script type="text/javascript">
		onImagesLoaded($("div.storyboard-image-large-container"), imagesLoaded);
	</script>
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
            <li class='active'><a href="index.php">USE NUDGE</a></li>
            <li ><a href="comments.php">COMMENTS</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>     
        </div><!--/.nav-collapse -->
    </div>
	<div class="container gameplay">
		<div class="row">
			<div class="col-md-12">
				<div class="game-info">
					<p>
						<img class="dollar-bill" src="assets/img/fundingScore.png">
						<?php
						$QU= mysqli_query($con, "select score from users where name ='$name';") or die(_error());
						$QRow= mysqli_fetch_row($QU);
						$score = $QRow[0];
						print "<h2 class=\"score\">$".$score."</h2>"; 
						?>
						<div class="col-md-10 col col-md-offset-1" style="margin-top: -50px; position: relative;">
							Welcome to nudge: <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
						</div>
						<?php //This is to populate the badge table with the number of badges the user currently has. 
						$endings = mysqli_query($con, "select distinct ending from play where storyname='$category' and name='$name'") or die(mysql_error());
						$current_badges = array(); 
						
						while( $row = mysqli_fetch_array($endings) ){ 
							$ending = $row['ending']; 
							$ending_query = mysqli_query($con, "select end_id from rewardss where end='$ending'") or die(mysql_error());
							$end_id = mysqli_fetch_row($ending_query); 
							array_push($current_badges, $end_id[0]); 
						}
						?> 
						<table class="badge-table" align="right"> 
							<tbody>
								<tr>
									<td>
										<?php 
										if(in_array('4',$current_badges)){ 
											print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['4']."\">"; 
										} else{
											print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
										}
										?>
									</td>
									<td>
										<?php 
										if(in_array('5',$current_badges)){ 
											print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['5']."\">"; 
										} else{
											print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
										}
										?>
									</td>
									<td>
										<?php 
										if(in_array('7',$current_badges)){ 
											print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['7']."\">"; 
										} else{
											print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
										}
										?>
									</td>
									<td>
										<?php 
										if(in_array('19',$current_badges)){ 
											print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['19']."\">"; 
										} else{
											print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
										}
										?>
									</td>
									<td>
										<?php 
										if(in_array('16',$current_badges)){ 
											print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['16']."\">"; 
										} else{
											print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
										}
										?>
									</td>
									<td>
										<?php 
										if(in_array('18',$current_badges)){ 
											print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['18']."\">"; 
										} else{
											print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
										}
										?>
									</td>
									<td>
										<?php 
										if(in_array('17',$current_badges)){ 
											print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['17']."\">"; 
										} else{
											print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
										}
										?>
									</td>
									<td>
										<?php 
										if(in_array('0',$current_badges)){ 
											print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['0']."\">"; 
										} else{
											print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</p>
				</div>
			</div>
		</div>
		<hr>
		<div class="row"> 
			<div class="col-md-12">
				<span class="help-block"><?php echo $answerErr;?></span>
			</div>
		</div>
		<form style="margin-top: -35px;" class="form-horizontal" role="form" id='loadStory' method="post">
			<?php  
			$pos = -1; //initialize position to negative one. This is for the event: "the user forgets to select an answer." 
						// We still want to display the previous scenario and answer choices. $pos holds the value of whether the current scenario is an end, beginning, or middle
			$randnum=rand(0,100);
			
			$result = mysqli_query($con, "select gotostorylinetite  from results where storytitle='$category' and storylinetite='$storylinetite' and answer='$theanswer' and startprob<'$randnum' and stopprob>='$randnum';"); 
			$row_cnt = mysqli_num_rows($result);
			$row = mysqli_fetch_row($result); // $row at this point only contains one value, the title of the next scenario, known as gotostorylinetite. 
			
			if(!empty($row)){
				$gotostorylinetite = $row[0]; 
				echo nl2br("\n");
				$res = mysqli_query($con, "select * from storytable where storytitle='$category' and storylinetite='$gotostorylinetite'") or die(_error());
				$row = mysqli_fetch_row($res);
				$storylinetitle = $row[2]; // secondcol contains storylinetite(I call this the scenario title)
				$thirdcol = $row[3]; // thirdcol contains the storyline for the scenario title
				$pos = $row[4]; // pos keeps track of whether the current scenario title is a start - 0   end - 1   or   middle - 2 
				$i=1;
				$_SESSION['gotostorylinetite'] = $gotostorylinetite; 
				$clip = preg_replace('/\s+/', '', $_SESSION['gotostorylinetite']); 
				print "<audio controls class=\"audio\">"; 
				print "<source src=\"assets/img/".$category."/recordings/".$clip.".mp3\" type=\"audio/mpeg\">";
				print "</audio>";  
				$comic = ""; 
				$comic = $images[$storylinetitle];  
			} else {
				//Do nothing because an answer was not selected and we want to load the same scenario and answers from before. Do this until the user 
				// chooses an answer choice. 
			}
			?>
		</form>
		<div class="row">
			<div class="col-md-12 ">
				<table style="margin:0px auto; margin-left: -10px;">
					<tbody>
						<tr>
							<td style="width:auto;">
								<div id="storyboard-image-large-container">
									<?php print "<a><img src=\"".$comic."\"</a>"; ?> 
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">	
				<?php if($pos!=1){?>
				<form class="form-horizontal" role="form" id='login' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<?php
				$res2 = mysqli_query($con, "select * from answers where storylinetite='$gotostorylinetite' and storytitle='$category';") or die(_error());
				?>
				<div id='question<?php echo $i;?>' class='cont answers' style="margin-top: -20px;">
					<br/>
					<?php while($row = mysqli_fetch_array($res2)){?>
					<input type="radio" value="<?php echo htmlspecialchars($row['answer']); ?>" name="theanswer" /><?php echo " ";?><?php echo $row['answerchoice'];?>
					<br/>
					<?php }?>	
					<br/>	
				</div>
				<button class="btn btn-success btn-block" style="margin-bottom: 10px;" type="submit">Next</button>
				</form>
			</div>
		</div>
	 </div>
		<?php } else {?> 
		<?php  
		$K=$row[0];
		
		$final= mysqli_query($con, "select * from rewardss where end_id='$K';") or die(_error());
		$finalrow = mysqli_fetch_row($final);
		
		$statement = $finalrow[2];
		$points = $finalrow[3];
		$endid = $finalrow[6];
		
		$name =  $_SESSION['name'];
		
		$QU = mysqli_query($con, "select * from users where name ='$name';") or die(_error());
		$QRow = mysqli_fetch_row($QU);
		$score = $QRow[2];

		$in = mysqli_query($con, "INSERT INTO  play(name, storyname, ending) VALUES('$name', '$category', '$endid')") or die(_error());  
		$total = $score+$points;

		$count = mysqli_query($con, "SELECT COUNT(Distinct ending) from play where storyname='$category' and name='$name';") or die(_error());
		$scorerow = mysqli_fetch_row($count);
		$badge = "";
		$badge = $badges[$K];  
		?>
		<div class='row'>
			<div class="col-md-12 reward-container" style="margin: 0px auto;">
				<br>
				<table style="margin:0px auto;">
					<tbody>
						<tr>
							<td>
								<?php print "<a><img src=\"".$badge."\"</a>"; ?>
							</td>
							<td>
								<h3> <?php print($statement); ?> </h3>
							</td>
						</tr>
					</tbody>
				</table>
				<h3> Worth  <?php print($points); ?>  points! </h3>
				<?php  
				mysqli_query($con, "UPDATE users SET score=$total WHERE name ='$name';"); 
				$tots2 = mysqli_query($con, "SELECT COUNT(*) from rewardss;");
				$tots = mysqli_fetch_row($tots2);
				?>
				<br>
				<h3> You have reached <?php print($scorerow[0]); ?>/<?php print($tots[0]); ?> different endings!
				<h3> You now have <?php print($total); ?> total points! </h3>
				<br>
				<h3> 
				<a href="menu.php">Please Play Again! </a>
				<?php
				session_unset(); 
				$_SESSION['name'] = $name; 
				?>
				</h3>
				<br>
				<br>
			</div>
		</div>
		<?php  } ?>
		</hr>
		<footer>
			<p class="text-center" id="foot">
				&copy; <a href="http://dowell.colorado.edu" target="_blank">Dowell Lab Home </a>2014
			</p>
		</footer>
	</div>
<?php } else{
			header("Location: index.php"); 
		}?>
 
    </body>
</html>
 

