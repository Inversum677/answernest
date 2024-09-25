<?php
include("../path.php");
include("../app/controllers/topics.php");
if($_SESSION['admin']):
$id = $_GET['id'];
deleteById(table:'topic',id:$id);
header(header:'location: ' . BASE_URL . 'admin/admin-topics.php');
?>

<?php
else:
  header(header:'location: ' . BASE_URL);
endif;
?>