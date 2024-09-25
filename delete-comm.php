<?php
include("app/database/db.php");
include("path.php");

$comm = selectOne(table:'comment',params:['id' => $_GET['id']]);
$isYou = $comm['id_user'];
$idpost = $comm['id_post'];

if($_SESSION['id'] == $isYou){
deleteById(table:'comment',id:$_GET['id']);  
header(header:'location: ' . BASE_URL . "single-post.php?id=" . $idpost . '#create-comm');
}
else{
header(header:'location: ' . BASE_URL);    
}



?>