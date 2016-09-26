<?php
session_start();
?>
<!---
Site :Nudge
Author :Dowell Lab
--->
 
<?php
require 'config.php';

//Form Validation via PHP
// define variables and set to empty values
$userPassErr = $catErr = $newUserErr = $emailErr = $newPassErr = $passErr = ""; //Error message variables
$name = $email = $category = $password = ""; // login information 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['newUser'])) { // Error checking for new user being created
		$name = test_input($_POST["name"]); 
		$email = test_input($_POST["email"]);
		$password = test_input($_POST["password"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$q2=mysql_query("SELECT * from users where name='$name'") or die(mysql_error());
			$r2=mysql_fetch_array($q2);						
			if(empty($r2) == true && valid_password($password) == true){
				//add username, email, and password to the database
				mysqli_query($con, "INSERT INTO users (id, user_name,score,category_id,name,password )VALUES ('NULL','$email',0,5,'$name', '$password')") or die(mysql_error());
				mysqli_query($con, "INSERT INTO played (name) VALUES('$name')") or die(mysql_error());
				header("Location: newuser.php"); 
			} else{
				if(empty($password) == true){
					$newPassErr = "Please type in a password."; 
				} else if(valid_password($password) == false) { 
					$newPassErr = "Password must contain 1 number and be at least 5 characters long."; 
				} else{
					$newUserErr = "Username already taken."; 
				}
			}
			
		} else {
			$emailErr = "Invalid email address."; 
		} 
	}
	if (isset($_POST['currentUser'])) { // Validating login information of a current user. 
	  $name = test_input($_POST["name"]);
	  $email = test_input($_POST["email"]);
	  //$category = test_input($_POST["category"]); 
	  $q2=mysqli_query($con, "SELECT * from users where name='$name' and password='$email'") or die(mysql_error());
	  $r2=mysqli_fetch_array($q2);
	  
	  if(!empty($r2)){ // May need to add this back into the if statement if the menu doesn't go over well \'&& $category != "0"\'
		//$_SESSION['category'] = $category; 
		$_SESSION['name'] = $name;  
		//header("Location: copy2.php");
		header("Location: menu.php");  
		exit(); 
	  } else{
		if(empty($r2)){
			$userPassErr = "Incorrect Username or Password"; 
		} 
		if($category == "0"){
			$catErr = "Please select a category"; 
		}
	  }
	} 
}

function valid_password($pass) { // A valid password will have at least 5 characters and contain at least one number
	$flag = false; 
	
	if( strlen($pass) >=5 ) {
		preg_match_all("/[0-9]/", $pass, $matches);
		$count["num"] = count($matches[0]);
		
		if($count["num"] > 0){ // check if there is atleast one number character in the password
			$flag = true; 
		} else{
			$passErr = "Password must contain at least one number."; 
			$flag = false; 
		}
	} else {
		$passErr = "Password must be at least 5 characters and contain one number"; 
		$flag = false; 
	}
	
	return $flag; 
	
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} //-- End of Form Validation 
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
		<p class="text-center">Welcome  <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];} ?></p>
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
					<form class="form-signin" method="post" id='signin' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="signin">
                        <div class="form-group">
                            <input type="text" id='name' name='name' class="form-control" placeholder="Enter your Username"/>
                            <span class="help-block"><?php echo $userPassErr;?></span>
                        </div>
				</div>
                <div class="col-xs-10 col-sm-5 col-lg-5">
                    <div class="intro">
                        <?php if(empty($_SESSION['name'])){?>
                        <form class="form-signin" method="post" id='signin' name="signin">
                            <div class="form-group">
                                <input type="password" id='email' name='email' class="form-control" placeholder="Enter your password"/>
                                <span class="help-block"></span>
                            </div>
                            <!--div class="form-group">
                                <select class="form-control" name="category" id="category">
                                    <option value="0">Choose your category</option>
									<option value="temptest">temptest</option>
									<option value="Authorship">Authorship</option>
                                </select>
                                <span class="help-block"><?php echo $catErr;?></span>
                            </div-->
 
                            <br>
                            <button class="btn btn-success btn-block" type="submit" name="currentUser">
                                Next
                            </button>
                        </form>
                        <br>
                        <br>
						<div class="intro">	
							<h4 class="centered">Or Create a new account</h4>
						</div> 
						<form class="form-signin" method="post" id='newUserSignIn' name="newUserSignIn">
                            <div class="form-group">
                                <input type="text" id='name' name='name' class="form-control" placeholder="Enter your Username"/>
                                <span class="help-block"><?php echo $newUserErr;?></span>
                            </div>
						<form class="form-signin" method="post" id='newUserSignIn' name="newUserSignIn" action="newuser.php">
                            <div class="form-group">
                                <input type="text" id='email' name='email' class="form-control" placeholder="Enter your E-Mail"/>
                                <span class="help-block"><?php echo $emailErr;?></span>
                            </div>
						<form class="form-signin" method="post" id='newUserSignIn' name="newUserSignIn" action="newuser.php">
                            <div class="form-group">
                                <input type="text" id='password' name='password' class="form-control" placeholder="Enter your Password"/>
                                <span class="help-block"><?php echo $newPassErr;?></span>
                                <span class="help-block"><?php echo $passErr;?></span>
                            </div>
							<br>
							<button class="btn btn-success btn-block" type="submit" name="newUser">
                                Next
                            </button>
						</form> 
					</div> 
                        <?php }else{?>
								 <h1>Critical Error.</h1>
								 <h1><a href="http://localhost/Nudge/index.php">Click here to return to login screen.</a></h1> 
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <footer style="margin-top:120px;">
            <p class="text-center" id="foot">&copy; <a href="http://dowell.colorado.edu/" target="_blank">Dowell Lab 2014 </a></p>
        </footer>
    </body>
</html>
