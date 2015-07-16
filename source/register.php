<?php include("../source/header.php"); ?>
<?php require_once("/../source/db.php"); ?>
<div class="adm_main">
	<div class="row row_background">

		<h1>Регистрация</h1>
		<form action="register.php" id="registerform" method="post"name="registerform">
			<p><label for="user_pass">Имя пользователя<br>
			<input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
			<p><label for="user_pass">E-mail<br>
			<input class="input" id="email" name="email" size="32"type="email" value=""></label></p>
			<p><label for="user_pass">Пароль<br>
			<input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
			<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
			<p class="regtext">Уже зарегистрированы? <a href= "login.php">Введите имя пользователя</a>!</p>
		 </form>

	</div>
</div>

<?php
	
	if(isset($_POST["register"])){
	
	if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {

$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$query=mysql_query("SELECT * FROM users WHERE username='".$username."'");
$numrows=mysql_num_rows($query);


if($numrows==0)   {
	
	$sql="INSERT INTO users
  ( email, username,password) 	VALUES('$email', '$username', '$password')";
  $result=mysql_query($sql);
 if($result){
	$message = "Аккаунт создан";
} else {
 $message = "Failed to insert data information!";
  }
	} else {
	$message = "Этот ник уже занят!";
   }
	} else {
	$message = "Необходимо заполнить все поля!";
	}
	}
?>

<?php if (!empty($message)) {echo "<p class=\"error\">" . "MESSAGE: ". $message . "</p>";} ?>




<?php include("../source/footer.php"); ?>