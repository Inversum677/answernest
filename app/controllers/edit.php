<?php
require('app/database/db.php');
require('path.php');

$errorMessage = '';
$id = $_GET['id'];
$post = selectOne(table:'post',params:['id' => $id]);
$id_user = $post['id_user'];
if($id_user !== $_SESSION['id']){
    header(header:'location: ' . BASE_URL);
}else{
    $title = $post['title'];
    $content = $post['content'];
    $topicId = $post['topic'];
    $topicName = selectOne(table:'topic',params:['id' => $topicId])['name'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-post-button'])){
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
        $values = [
            'title' => $title = trim($_POST['title']),
            'content' => $content = trim($_POST['content']),
            'topic' => $topic = $_POST['topic'],
            'img' => $_POST['img'],
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
                updateById(table:'post',id:$id, params:$values);
                header(header:'location: ' . BASE_URL . 'profile.php?id=' . $_SESSION['id']);
            }
            

}
?>