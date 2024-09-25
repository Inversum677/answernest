<?php
require("../app/database/db.php");
$errorMessage = '';
$name = '';
$editTopic = '';
//Создание категории
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-button'])){
    $name = $_POST['topic-name'];
    $ishave = selectOne(table:'topic',params:['name' => $name]);
    if($name == ''){
        $errorMessage = "Поле с названием должно быть заполнено!";
    }
    elseif(mb_strlen($name) < 3){
        $errorMessage = "Название категории должно содержать более двух символов!";
    }
    elseif(mb_strlen($name) > 30){
        $errorMessage = "Название категории должно содержать менее 30 символов!";
    }
    elseif($ishave == ''){
        insert(table:'topic', values:['name' => $name]);
        $errorMessage = "Категория " . "<strong>" . $name . "</strong>" . " успешно была добавлена!";
        header(header:'location: ' . BASE_URL . "admin/admin-topics.php");
    }else{
        $errorMessage = "Категория <strong>" . $name . "</strong> уже существует!";
    }
}
//Редактирование категории
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
$editTopic = selectOne(table:'topic', params: ['id' => $_GET['id']]);
$name = $editTopic['name'];
$id = $editTopic['id'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-topic-button'])){
    $name = $_POST['edit-topic-name'];
    if($errorMessage == ''){
    $id = $_POST['id'];  
    }
    $ishave = selectOne(table:'topic',params:['name' => $name]);
    
        if($name == ''){
            $errorMessage = "Поле с названием должно быть заполнено!";
        }
        elseif(mb_strlen($name) < 3){
            $errorMessage = "Название категории должно содержать более двух символов!";
        }
        elseif(mb_strlen($name) > 30){
            $errorMessage = "Название категории должно содержать менее 30 символов!";
        }
        elseif($ishave != ''){
            $errorMessage = "Категория <strong>" . $name . "</strong> уже существует!";
        }
        else{
        updateById(table:'topic',id:$id,params:['name' => $_POST['edit-topic-name']]);
        header(header:'location: ' . BASE_URL . 'admin/admin-topics.php');
        }
        
        
    
}
?>

