<?php
require('../database/db.php');
require('../../path.php');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])){
    $search = trim($_POST['search-term']);
    header(header:'location: ' . BASE_URL . 'index.php?search=' . $search);
}
?>