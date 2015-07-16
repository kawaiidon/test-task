<?php	session_start(); ?>
<?php include("source/header.php"); ?>
<?php require_once("/source/db.php"); ?>


<div class="container">
	<div class="span12">
		<div class='header_block'>
			<a href="/"><button class="btn btn-info top_button" ><i class="icon-home icon-white"></i></button></a>
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


//Берем название нужной категории из URL
if(isset($_GET['cat_id'])){
        $sqlQuery = "SELECT * FROM news, category WHERE category_id = ".$_GET['cat_id']." and cat_id = category_id ORDER BY date DESC";
    }else{
        echo "В данной категории новостей нет";
    }
    // делаем запрос к бд и получаем новости
    $sql = mysql_query($sqlQuery) ;
    $rows = array();
    while($r = mysql_fetch_array($sql, MYSQL_ASSOC)){
        $rows[] = $r;
    }

include('tpl/news_list.html');	

?> 
	</div>
		<div class='right_menu'>
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
</div>

<?php include("source/footer.php"); ?>
