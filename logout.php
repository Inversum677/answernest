<?php
session_start();

require('path.php');

$_SESSION = [];
header(header:'location: ' . BASE_URL);

?>