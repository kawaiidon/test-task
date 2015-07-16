<?php	session_start(); ?>
<?php include("source/header.php"); ?>


<?php

if ($_SESSION['session_username']=='admin' )    {
		
		// Если пусты, то мы не выводим ссылку
		include('tpl/admin.html');
		}
		else		{

		// Если не пусты, то мы выводим ссылку
		include('tpl/admin_error.html');	
    }
?>
 
<?php include("source/footer.php"); ?>
