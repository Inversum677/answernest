<?php
include('app/database/db.php');
include('path.php');
$comm = selectOne(table:'comment', params:['id' => $_GET['id']]);
$id = $comm['id'];
if($_SESSION['comm' . $id] == 1){
    
    $comm = selectOne(table:'comment', params:['id' => $_GET['id']]);
    $id = $comm['id'];
    $likes = $comm['likes'] - 1;
    $id_post = $comm['id_post'];
    updateById(table:'comment',id:$_GET['id'],params:['likes' => $likes]);
    unset($_SESSION['comm' . $id]);
    header(header:'location: ' . BASE_URL . 'single-post.php?id=' . $id_post . '#' . $id);  

}
else{
    header(header:'location: ' . BASE_URL);
}


?>