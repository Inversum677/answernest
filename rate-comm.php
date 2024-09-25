<?php
include('app/database/db.php');
include('path.php');
if($_SESSION['id']){
    
    $comm = selectOne(table:'comment', params:['id' => $_GET['id']]);
    $id = $comm['id'];
    $likes = $comm['likes'] + 1;
    $id_post = $comm['id_post'];
    updateById(table:'comment',id:$_GET['id'],params:['likes' => $likes]);
    $_SESSION['comm' . $id] = 1;
    header(header:'location: ' . BASE_URL . 'single-post.php?id=' . $id_post . '#' . $id);  

}
else{
    header(header:'location: ' . BASE_URL . 'login.php');
}


?>