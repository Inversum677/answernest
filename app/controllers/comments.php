<?php
date_default_timezone_set('Asia/Vladivostok');
$errorMessage = '';
$content = '';
$id_post = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-comment'])){
    
     $content = trim($_POST['comment']);
     if(!$_SESSION['id']){
      $errorMessage = 'Войдите в аккаунт,чтобы написать комментарий!'; 
    }
    
    elseif($content == ''){
        $errorMessage = 'Поле должно быть заполнено!';
        header(header:'location: ' . BASE_URL . 'single-post.php?id=' . $id_post . '#create-post');
    }
    elseif(mb_strlen($content) < 3){
        $errorMessage = 'Комментарий должен быть длиннее трёх символов!';
    }
    elseif(mb_strlen($content) > 250){
        $errorMessage = 'Максимальная длина комментария - 250 символов!';
    }
    else{
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
        'id_post' => $id_post,
        'content' => $content,
        'created' => $currentDate,
        'likes' => 0
        ];
        insert(table:'comment', values:$values);
        $content = '';
        //header(header:'location: ' . BASE_URL . 'single-post.php?id=' . $id_post);
        
        
    
  
    }   
    
    
      
    
    
}
?>