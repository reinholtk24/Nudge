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
$uname=$r2['user_name'];
print($name);
print($email);
echo $r2['name'];

?>
