<?php
	session_start();
	if(!isset($_SESSION["session_username"])) {
   header("location:login.php");
	} else {
	header("Refresh: 5; URL = /");
?>
<?php include("/../source/header.php"); ?>
<?php require_once("/../source/db.php"); ?>

<div class="adm_main">
	<div class="row row_background">


	<h3>Добро пожаловать, <span><?php echo $_SESSION['session_username'];?>! </span></h3>
	
	<div class="alert alert-info">Через 5 секунд вы будете перенаправлены на главную страницу .</div><br>
	
   <a href="logout.php">Выйти</a> из системы</p><p><a href="/">Главная</a> 

   
	
<?php
	}
?>




<?php include("/../source/footer.php"); ?>




