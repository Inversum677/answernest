<?php
require('../app/database/db.php');
require('../path.php');
$id = $_GET['id'];
$user = selectOne(table:'user', params:['id' => $id]);
if($_SESSION['admin'] !== 1){
    header(header:'location: ' . BASE_URL);
}else{
    deleteById(table:'user',id:$id);
    header(header:'location: ' . BASE_URL . 'admin/admin-users.php');
}
?>