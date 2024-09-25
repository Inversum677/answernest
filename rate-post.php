<?php
include('app/database/db.php');
include('path.php');
if($_SESSION['id']){
    
    $post = selectOne(table:'post', params:['id' => $_GET['id']]);
    $id = $post['id'];
    $likes = $post['likes'] + 1;
    updateById(table:'post',id:$_GET['id'],params:['likes' => $likes]);
    $_SESSION['post' . $id] = 1;
    header(header:'location: ' . BASE_URL . 'single-post.php?id=' . $id);  

}
else{
    header(header:'location: ' . BASE_URL . 'login.php');
}


?>