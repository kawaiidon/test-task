<?php
include ('/source/db.php');
//mysql_query("DROP TABLE blog");


mysql_query('CREATE TABLE `news` (
                `id` BIGINT NOT NULL AUTO_INCREMENT ,
                `category_id` INT( 11 ) NULL ,
                `name` TEXT NOT NULL ,
                `tags` TEXT NOT NULL ,
				`short_text` MEDIUMTEXT NOT NULL, 
				`full_text` LONGTEXT NOT NULL ,
				`date` DATETIME NOT NULL ,
				`news_img` CHAR( 128 ) NOT NULL ,				
                PRIMARY KEY ( `id` ) 
                )
         ;');

mysql_query('CREATE TABLE `category` (
                `cat_id` BIGINT NOT NULL AUTO_INCREMENT ,
                `category_name` CHAR( 128 ) NOT NULL ,
                PRIMARY KEY ( `cat_id` )
                )
         ;');
		 
	 
mysql_query('CREATE TABLE `users` (
                `id` BIGINT NOT NULL AUTO_INCREMENT ,
                `username` VARCHAR( 128 ) NOT NULL ,
                `password` VARCHAR( 128 ) NOT NULL ,
                `email` VARCHAR( 128 ) NOT NULL ,
				`date` TIMESTAMP ,
                PRIMARY KEY ( `id` )
                )
         ;');
//Добавляем админа		 
mysql_query('INSERT INTO  `news_base`.`users` (
				`id` ,
				`username` ,
				`password` ,
				`email` ,
				`date`
				)
				VALUES (
				NULL , 
				 "admin", 
				 "12345",  
				 "admin@domain.com", 
				CURRENT_TIMESTAMP
				)
		;');
		 
//Создаём связь между таблицами 	 
mysql_query('ALTER TABLE  `news` ADD FOREIGN KEY (  `id` ) REFERENCES  `news_base`.`category` (
				`cat_id`
				) ON DELETE RESTRICT ON UPDATE RESTRICT ;
					
		');
//Пока категории добавляются вручную через базу и редактоирование шаблонов
mysql_query('INSERT INTO  `news_base`.`category` (
				`cat_id` ,
				`category_name`
				)
				VALUES (
				NULL ,  "Новости"
				), (
				NULL ,  "Анонсы"
				), (
				NULL ,  "Гаджеты"
				), (
				NULL ,  "Железо"
				), (
				NULL ,  "Программы"
				), (
				NULL ,  "Игры"
				)
		;');


?>
<br> Готово!