<?php
session_start();
?>
<?php
require 'config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nudge</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/html5shiv.js"></script>
        <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
 
    </head>
    <body>
        <header>
            <p class="text-center">
                Welcome <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
            </p>
        </header>


