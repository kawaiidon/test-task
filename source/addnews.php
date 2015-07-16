<?php include("/../source/header.php"); ?>
<?php require_once("/../source/db.php"); ?>
<?php


$name = $_POST['name']; 
$category_id = $_POST['category_id']; 
$short_text = $_POST['short_text'];
$full_text = $_POST['full_text'];
$tags = $_POST['tags'];
date_default_timezone_set('UTC+3');
$date = date('Y-m-d H:i:s');
$date_img = time();


if (empty($_FILES['imgupload']['name'])){
//если переменной не существует то выставляем картинку по дефолту, иначе - загружаем картинку 
$news_img = "no_image.png";
}
else
{
$path_directory = '../img/news/';
//папка, куда будет загружаться начальная картинка и ее сжатая копия
if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(png)|(PNG)$/',$_FILES['imgupload']['name']))
//проверка формата исходного изображения
     { 
        $filename = $_FILES['imgupload']['name'];
        $source = $_FILES['imgupload']['tmp_name'];
        $target = $path_directory . $filename;
        move_uploaded_file($source, $target);
        //загрузка оригинала в папку $path_directory

    if(preg_match('/[.](PNG)|(png)$/', $filename)) {
    $im = imagecreatefrompng($path_directory.$filename) ;
    //если оригинал был в формате png, то создаем изображение в этом же формате. Необходимо для последующего сжатия
    }  
    if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
    $im = imagecreatefromjpeg($path_directory.$filename);
    //если оригинал был в формате jpg, то создаем изображение в этом же формате. Необходимо для последующего сжатия
    }
//СОЗДАНИЕ КВАДРАТНОГО ИЗОБРАЖЕНИЯ И ЕГО ПОСЛЕДУЮЩЕЕ СЖАТИЕ
// dest - результирующее изображение
// w - ширина изображения
// ratio - коэффициент пропорциональности
$w = 200;
$w_src = imagesx($im); //вычисляем ширину
$h_src = imagesy($im); //вычисляем высоту изображения
// создаём пустую квадратную картинку
// важно именно truecolor!, иначе будем иметь 8-битный результат
$dest = imagecreatetruecolor($w,$w);
// вырезаем квадратную серединку по x, если фото горизонтальное
if ($w_src>$h_src)
imagecopyresampled($dest, $im, 0, 0,
round((max($w_src,$h_src)-min($w_src,$h_src))/2),
0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));
// вырезаем квадратную верхушку по y,
// если фото вертикальное (хотя можно тоже серединку)
if ($w_src < $h_src)
imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
min($w_src,$h_src), min($w_src,$h_src));
// квадратная картинка масштабируется без вырезок
if ($w_src==$h_src)
imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);

imagejpeg($dest, $path_directory.$date_img.".jpg");
//сохраняем изображение формата jpg в нужную папку, подставялем дату как имя
$news_img = $date_img.".jpg";
//путь до картинки
$delfull = $path_directory.$filename;
unlink ($delfull);
//удаляем оригинал загруженного изображения
}
else{
//в случае несоответствия формата, выдаем соответствующее сообщение
exit ("Картинка должна быть в формате <strong>JPG или PNG</strong>");
}
}
//Отправка данных и формы в базу
$sql = 'INSERT INTO news(name, category_id, short_text, full_text, tags, date, news_img)
VALUES("'.addslashes($name).'", "'.$category_id.'", "'.addslashes($short_text).'", "'.addslashes($full_text).'", "'.addslashes($tags).'", "'.$date.'", "'.$news_img.'")';

//Проверяем введение данных
if(!mysql_query($sql)){
	echo '<center><p><b>Ошибка при добавлении данных!</b></p></center>';

}
else{
include('/../tpl/news_add.html');	
}
?>

<?php include("/../source/footer.php"); ?>