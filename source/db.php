<?php
include("/../source/config.php"); 

 // Пытаемся соединиться с сервером базы данных MySQL
 $db = @mysql_connect($db_loc,$db_user,$db_pass);
 //Проверяем, удачно ли прошло подключение
 if(!$db)
 {
 echo( '<center--><p><b>Невозможно подключиться к серверу базы данных !</b></p>');
 exit();
 }
 //Проверяем доступность нужной БД
 if(!@mysql_select_db($db_name,$db))
 {
 echo( '<center><p><b>База данных '.$db_name.' недоступна!</b></p></center>');
 exit();
 }
 //Вывод сообщения об удачном выполнении подключения
 //Строку, расположенную ниже, после отладки удалить
 //echo( '<center><p><b>Подключение к базе данных '.$db_name.' выполнено.</b></p></center>');
  
 ?>