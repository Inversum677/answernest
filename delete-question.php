<?php
require('app/database/db.php');
require('path.php');
$id = $_GET['id'];
$post = selectOne(table:'post', params:['id' => $id]);
if($_SESSION['id'] !== $post['id_user']){
    header(header:'location: ' . BASE_URL);
}else{
    deleteById(table:'post',id:$id);
    header(header:'location: ' . BASE_URL . 'profile.php?id=' . $_SESSION['id']);
}
?>