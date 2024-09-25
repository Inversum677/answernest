<?php
include('app/database/db.php');
include('path.php');
$post = selectOne(table:'post', params:['id' => $_GET['id']]);
$id = $post['id'];
if($_SESSION['post' . $id] == 1){
    
    $likes = $post['likes'] - 1;
    updateById(table:'post',id:$_GET['id'],params:['likes' => $likes]);
    unset($_SESSION['post' . $id]);
    header(header:'location: ' . BASE_URL . 'single-post.php?id=' . $id);  

}
else{
    header(header:'location: ' . BASE_URL);
}


?>