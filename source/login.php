<?php	session_start(); ?>
<?php require_once("/../source/db.php"); ?>
<?php
	
	if(isset($_SESSION["session_username"])){
	// вывод "Session is set"; // в целях проверки
	header("Location: intropage.php");
	}

	if(isset($_POST["login"])){

	if(!empty($_POST['username']) && !empty($_POST['password'])) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$query =mysql_query("SELECT * FROM users WHERE username='".$username."' AND password='".$password."'");
	$numrows=mysql_num_rows($query);
	if($numrows!=0)
 {
while($row=mysql_fetch_assoc($query))
 {
	$dbusername=$row['username'];
  $dbpassword=$row['password'];
 }
  if($username == $dbusername && $password == $dbpassword)
 {
	// старое место расположения
	//  session_start();
	 $_SESSION['session_username']=$username;	 
 /* Перенаправление браузера */
   header("Location: intropage.php");
	}
	} else {
	//  $message = "Invalid username or password!";
	
	echo  "Invalid username or password!";
 }
	} else {
    $message = "All fields are required!";
	}
	}
?>
<?php include("../source/header.php"); ?>
<div class="adm_main">
	<div class="row row_background">
		<form action="" id="loginform" method="post"name="loginform">
			<p><label for="user_login">Имя опльзователя<br>
			<input class="input" id="username" name="username"size="20"
			type="text" value=""></label></p>
			<p><label for="user_pass">Пароль<br>
			<input class="input" id="password" name="password"size="20"
			 type="password" value=""></label></p> 
			<p class="submit"><input class="button" name="login"type= "submit" value="Log In"></p>
			<p class="regtext">Еще не зарегистрированы?<a href= "register.php">Регистрация</a>!</p>
		</form>
	</div>
</div>



<?php include("../source/footer.php"); ?>