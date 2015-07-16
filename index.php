<?php	session_start(); ?>
<?php include("source/header.php"); ?>
<?php require_once("/source/db.php"); ?>


<div class="container">
	<div class="span12">
		<div class='header_block'>
				
<?	if ($_SESSION['session_username'] == 'admin'){	?>	
			<a href="/admin.php"><button class="btn btn-warning top_button" type="submit"><i class="icon-pencil icon-white"></i></button></a>
<?	}		?>
	
<?	if ($_SESSION == true){		?>	
			<a href="source/logout.php"><button class="btn btn-info top_button" type="submit"><i class="icon-share-alt icon-white"></i></button></a>	
<?	}		
		else {
?>			
			<a href="source/login.php"><button class="btn btn-info top_button" type="submit"><i class="icon-user icon-white"></i></button></a>
<?	}

?>

	
					
			<h3 class='title'>Get some news!</h3>
		</div>
	<div class="row">
	<div class="span9">
	


<?php



//Выбираем все записи
$sql="SELECT *  FROM news, category WHERE cat_id = category_id  ORDER BY date DESC";
//В переменной $res сохраняем результаты выборки
$res=mysql_query($sql);

//Пагинация 
$rows_max = mysql_num_rows($res); // Количество новостей в базе
$show_pages = 5; // Новостей на страницу
$this_page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT); // Номер текущей страницы

if ($this_page){
$offset = (($show_pages * $this_page) - $show_pages);
}
else{
$this_page = 1; // Ставим в единицу (первая страница) если не передан параметр $_GET['page']
$offset = 0;
}
 
// Выводим отсортированные новости
 
$query_limited = "SELECT *  FROM news, category WHERE cat_id = category_id  ORDER BY date DESC LIMIT $offset, $show_pages";
$final_result = mysql_query($query_limited);

include('tpl/news_index.html');	

?>
<div class="pagination pagination-centered">

<?
//Вывод пагинации  
if ($rows_max > $show_pages){
       $r = 1;
       while ($r <= ceil($rows_max/$show_pages)){
           if ($r != $this_page){          
                echo '<ul><li><a href="?page=' . $r . '">',$r,'</a></li></ul>';
           }
           else{
               echo "<ul><li class='disabled'><a>",$r,'</a></li></ul>'; // Текущая строка
            }
            $r++;      
       }
}
?> 
</div>
	</div>
		<div class='right_menu'>
	  	<div class="span2 right_blocks">
				<span class='nav-header'>Привет,  
								
					<?php 
					
					if ($_SESSION==true){
						echo $_SESSION['session_username'].'!';
					}
					else {
						echo 'Гость! ';
					}
					?>
					
				</span>
		</div>		
		<div class="span2 right_blocks">
			<ul class="nav nav-list">
			<li class="nav-header">Категории:</li>
			<li ><a href="/">Главная</a></li>
			<li><a href="/category.php?cat_id=1">Новости</a></li>
			<li><a href="/category.php?cat_id=2">Анонсы</a></li>
			<li><a href="/category.php?cat_id=3">Гаджеты</a></li>
			<li><a href="/category.php?cat_id=4">Железо</a></li>
			<li><a href="/category.php?cat_id=5">Программы</a></li>
			<li><a href="/category.php?cat_id=6">Игры</a></li>
			</ul>
		</div>
	  	<div class="span2 right_blocks">
			<span class="nav-header">Теги:</span>
			<?include ('source/tag_cloud.php');?>
		</div>
  </div>
	</div>
	</div>

<?php include("source/footer.php"); ?>
