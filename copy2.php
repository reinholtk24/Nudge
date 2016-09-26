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

$category = ""; 
 
if(!empty($_POST['name'])){     
	 $name=$_POST['name'];
     $email=$_POST['email'];
     $category=$_POST['category'];
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysqli_insert_id($con);
}
$category=$_SESSION['category']; // change back to $_Session['category] after testing
$_POST['category'] = $category; 
$_SESSION['category']=$_POST['category']; // change back to $_POST["category"] after testing
$name = $_SESSION['name']; 

//Verify an answer choice was made before moving on to the next page. 
$answerErr = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['theanswer'])){
		$_SESSION['theanswer'] = $_POST['theanswer']; 
		header("Location: storyloop.php"); 
		exit(); 
	} else{
		$answerErr = "Please select an answer choice to move on."; 
	}
}// End of answer choice verification*/

if(!empty($_SESSION['name']) and !empty($category)){
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
       
        <script type="text/javascript">// Preload images 
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
	<script type="text/javascript">
		onImagesLoaded($("div.storyboard-image-large-container"), imagesLoaded);
	</script>
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
            <li class='active'><a href="index.php">USE NUDGE</a></li>
            <li><a href="comments.php">COMMENTS</a></li>
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
						$QU= mysqli_query($con, "select score from users where name ='$name';") or die(mysqli_error());
						$QRow= mysqli_fetch_row($QU);
						$score = $QRow[0];
						print "<h2 class=\"score\">$".$score."</h2>"; 
						?>
						<div class="col-md-10 col col-md-offset-1" style="margin-top: -50px; position: relative;">
							Welcome to nudge: <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
						</div>
						<?php //This is to populate the badge table with the number of badges the user currently has. 
						$endings = mysqli_query($con, "select distinct ending from play where storyname='$category' and name='$name'") or die(mysqli_error());
						$current_badges = array(); 
						
						while( $row = mysqli_fetch_array($endings) ){ 
							$ending = $row['ending']; 
							$ending_query = mysqli_query($con, "select end_id from rewardss where end='$ending'") or die(mysqli_error());
							$end_id = mysqli_fetch_row($ending_query); 
							array_push($current_badges, $end_id[0]); 
						}
						?> 
						<table class="badge-table" align="right"> 
							<tbody>
								<tr>
									<td>
										<?php if(in_array('4',$current_badges)){ 
												print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['4']."\">"; 
											} else{
												print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
											}
										?>
									</td>
									<td>
										<?php if(in_array('5',$current_badges)){ 
												print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['5']."\">"; 
											} else{
												print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
											}
										?>
									</td>
									<td>
										<?php if(in_array('7',$current_badges)){ 
												print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['7']."\">"; 
											} else{
												print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
											}
										?>
									</td>
									<td>
										<?php if(in_array('19',$current_badges)){ 
												print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['19']."\">"; 
											} else{
												print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
											}
										?>
									</td>
									<td>
										<?php if(in_array('16',$current_badges)){ 
												print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['16']."\">"; 
											} else{
												print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
											}
										?>
									</td>
									<td>
										<?php if(in_array('18',$current_badges)){ 
												print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['18']."\">"; 
											} else{
												print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
											}
										?>
									</td>
									<td>
										<?php if(in_array('17',$current_badges)){ 
												print "<img class=\"badge-spot one\" style=\"height: 32px; width: 32px;\"  src=\"".$badges['17']."\">"; 
											} else{
												print "<img class=\"badge-spot one\" src=\"assets/img/oval.png\">"; 
											}
										?>
									</td>
									<td>
										<?php if(in_array('0',$current_badges)){ 
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
				<!--div>Icons made by <a href="http://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div-->
			</div>
		</div>
		<hr>
		<?php
		print "<audio controls class=\"audio\">"; 
		print "<source src=\"assets/img/".$category."/recordings/Start.mp3\" type=\"audio/mpeg\">";
		print "</audio>"; 
		?>
		<?php
		$res = mysqli_query($con, "select * from storytable where storytitle='$category' and position=0") or die(mysqli_error());
		$row = mysqli_fetch_row($res);
		$storylinetitle = $row[2]; 
		$thirdcol = $row[3];
		$i=1;
		$comic = ""; 
		$comic = $images[$storylinetitle]; 
		?>
		<div class="row">
			<div class="col-md-12 ">
				<table style="margin:0px auto; margin-left:-9px;">
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
				<span class="help-block"><?php echo $answerErr;?></span>
				<form class="form-horizontal" role="form" id='login' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<?php
					$_SESSION['storylinetite']='start';
					$res2 = mysqli_query($con, "select * from answers where storylinetite='start' and storytitle='$category';") or die(mysqli_error());
					$n=1;
					?>
					<div id='question<?php echo $i;?>' class='cont answers' style="margin-top: -20px;">
						<br/>
						<?php while($row2 = mysqli_fetch_array($res2)){?>
						<input type="radio" value="<?php echo htmlspecialchars($row2['answer']); ?>" name="theanswer" /><?php echo " ";?><?php echo $row2['answerchoice'];?>
						<br/>
						<?php $n++; }?>
						<br/>
					</div>
					<button class="btn btn-success btn-block" type="submit">Next</button>
					<span class="help-block"><?php echo $answerErr;?></span>
				</form>
				</hr>
			</div>
		</div>
   </div>

   <footer>
		<p class="text-center" id="foot">
			&copy; <a href="http://dowell.colorado.edu/" target="_blank">Dowell Lab </a>2013
		</p>
	</footer>
	<?php } else{
				header("Location: index.php"); 
			}
		?>
	</body>
</html>

