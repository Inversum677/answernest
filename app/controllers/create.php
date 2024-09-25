<?php
date_default_timezone_set('Asia/Vladivostok');
require('app/database/db.php');
require('path.php');
$title = '';
$content = '';
if($_SESSION['id'] == ''){
    header(header:'location: ' . BASE_URL . 'login.php');
}
else{
$errorMessage = '';
$fileType = '';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-post-button'])){
    $_POST['img'] = '';

    //Картинка
if(!empty($_FILES['img']['name'])){

    $imgName = time() . '_' .  $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileType = $_FILES['img']['type'];
    $destination = ROOT_PATH . '\assets\img\posts\\' . $imgName;

    if(strpos($fileType, needle:'image') === false){
        die("Можно загружать только картинки!");
    }
    if($_FILES['img']['size'] > 5000000){
        die("Картинка должна весить менее 5МБ");
    }
    else{
    $result = move_uploaded_file($fileTmpName, $destination); 

    if($result){
        $_POST['img'] = $imgName;
         
    }
    else{
        $errorMessage = "Картинка не загрузилась на сервер!";
    }   

    }
}

$_monthsList = array(".01." => "января", ".02." => "февраля", 
".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня", 
".07." => "июля", ".08." => "августа", ".09." => "сентября",
".10." => "октября", ".11." => "ноября", ".12." => "декабря");
 
//текущая дата
$currentDate = date("d.m.Y");
//переменная $currentDate теперь хранит текущую дату в формате 22.07.2015
 
//но так как наша задача - вывод русской даты, 
//заменяем число месяца на название:
$_mD = date(".m."); //для замены
$currentDate = str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);


$values = [
'id_user' => $id_user = $_SESSION['id'],
'title' => $title = trim($_POST['title']),
'content' => $content = trim($_POST['content']),
'topic' => $topic = $_POST['topic'],
'img' => $_POST['img'],
'status' => 1,
'created' => $currentDate,
'views' => 0,
'likes' => 0
];

if($title == '' || $content == ''){
    $errorMessage = "Все поля должны быть заполнены!";
}
elseif(mb_strlen($title) < 10 || mb_strlen($content) < 10){
    $errorMessage = "Заголовок и основной текст должны быть длиннее десяти символов!";
}
elseif(mb_strlen($title) > 100 || mb_strlen($content) > 2000){
    $errorMessage = "Слишком большой заголовок или основной текст!";
}
else{
    insert(table:'post', values:$values);
    header(header:'location: ' . BASE_URL);
}
}
}
?>