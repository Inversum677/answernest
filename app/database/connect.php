<?php
$driver = 'mysql';
$host = 'localhost';
$db_name = 'answernest';
$db_user = 'root';
$db_pass = 'mysql';
$charset = 'uft8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try{
    $pdo = new PDO(
        dsn:"$driver:host=$host;dbname=$db_name;charset = $charset",username:$db_user, password:$db_pass, options:$options
);

}catch(PDOException $i){
    die("Ошибка при подключении к базе данных");
}
?>