<?php
require('../app/database/db.php');
require('../path.php');
$id = $_GET['id'];
$post = selectOne(table:'post', params:['id' => $id]);
if($_SESSION['admin'] == 0){
    header(header:'location: ' . BASE_URL);
}else{
    deleteById(table:'post',id:$id);
    header(header:'location: ' . BASE_URL . 'admin/admin-posts.php?id=' . $_SESSION['id']);
}
?>