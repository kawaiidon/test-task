<?
include ('source/db.php');

// Делаем выборку из базы данных
$result = mysql_query("SELECT tags FROM news");
$myrow = mysql_fetch_array($result);
// Запускаем цикл, в котром выведем все тэги через зщапятую
	do{
//Создатим переменную в котрую будем дописывать метки
	$tags .= $myrow['tags'].', ';
	}
	while($myrow = mysql_fetch_array($result));
// Разобъем строку $tags на элементы массива
$tag = explode(',',$tags);
$tag = array_unique($tag);
	foreach ($tag as $val){
	preg_match_all ('/'.$val.'/', $tags, $matches);
	$metka[$val] = count($matches[0]);
	}
arsort($metka);
$metka = array_slice($metka, 1, 15); // выбираем первые 10 элементов массива
$i = 0;
	foreach($metka as $key => $val){
	$i++;
	$link[] = '<a href="tags.php?tag='.$key.'" class="link_'.$i.'">'.$key.'</a> ';
	}
echo '<div class="cloud_tags">';
foreach($link as $tag){
echo $tag;
}
echo '</div>';
?>