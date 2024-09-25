<?php
date_default_timezone_set('Asia/Vladivostok');
require('app/database/db.php');
include("path.php");
include("blockerrors.php");
$errorMessage = '';
$haveUserByLogin = '';
$haveUserByEmail = '';
$checkUser = '';
$username = '';
$email = '';
$password = '';
$description = $_SESSION['description'];
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){
    $admin = 0;
    $username = trim($_POST['username']);
    $email = trim($_POST['mail']);
    $password = trim($_POST['password']);
    $confpassword = trim($_POST['confpassword']);

        $haveUserByLogin = selectOne(table:'user',params:['username' => $username]);
        $haveUserByEmail = selectOne(table:'user',params:['email' => $email]);

    if($username === '' || $email === '' || $password === '' || $confpassword === ''){
        $errorMessage = 'Все поля должны быть заполнены!';
    }
    elseif(mb_strlen($username) < 3){
        $errorMessage = 'Имя пользователя должно быть не короче трёх символов!';
    }
    elseif(mb_strlen($username) > 20){
        $errorMessage = 'Имя пользователя должно быть короче 20 символов!';
    }
    elseif($password !== $confpassword){
        $errorMessage = 'Пароли должны совпадать!';
    }
    elseif($haveUserByLogin != ''){
      $errorMessage = 'Пользователь с таким именем пользователя уже существует!';
    }
    elseif($haveUserByEmail != ''){
        $errorMessage = 'Пользователь с такой почтой уже существует!';
      }
    else{
        $_monthsList = array(".01." => "января", ".02." => "февраля", 
".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня", 
".07." => "июля", ".08." => "августа", ".09." => "сентября",
".10." => "октября", ".11." => "ноября", ".12." => "декабря");
 
//текущая дата
$currentDate = date("d.m.Y");
//переменная $currentDate теперь хранит текущую дату в формате 22.07.2015
 
//но так как наша задача - вывод русской даты, 
//заменяем число месяца на название:
$_mD = date(".m."); //для замены
$currentDate = str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);

        $password = password_hash($password, algo:PASSWORD_DEFAULT);
         $post = [
        'admin' => $admin,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'description' => '',
        'created' => $currentDate
    ]; 
    $id = insert(table:'user', values:$post);
    $user = selectOne(table:'user',params:['id' => $id]);
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['description'] = $user['description'];
    $_SESSION['created'] = $user['created'];
    header(header:'location: ' . BASE_URL);
    }
     
}



if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
    $post = [
    $username = trim($_POST['username']),
    $password = trim($_POST['password'])
    ];
    
    $errorMessage = userAugh(table:'user',username:$username,password:$password);

}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-username-button'])){
    $username = $_POST['username'];
    $isHave = selectOne(table:'user', params:['username' => $username]);
    if($username === ''){
        $errorMessage = 'Поле должно быть заполнено!';
    }
    elseif($username == $_SESSION['login']){
        $errorMessage = 'Новое имя пользователя должно отличаться от старого!';
    }
    elseif(mb_strlen($username) < 3){
        $errorMessage = 'Имя пользователя должно быть не короче трёх символов!';
    }
    elseif(mb_strlen($username) > 20){
        $errorMessage = 'Имя пользователя должно быть короче 20 символов!';
    }
    elseif($isHave != ''){
        $errorMessage = 'Такое имя пользователя уже существует!';
    }
    else{
    updateById(table:'user',id:$_SESSION['id'],params:['username' => $username]);
    $_SESSION['login'] = $username;
    header(header:'location: ' . BASE_URL . 'profile.php?id=' . $_SESSION['id']);   
    }
    
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-email-button'])){
    $email = $_POST['email'];
    $isHave = selectOne(table:'user', params:['email' => $email]);
    if($email === ''){
        $errorMessage = 'Поле должно быть заполнено!';
    }
    elseif($email == $_SESSION['email']){
        $errorMessage = 'Новая почта должна отличаться от старой!';
    }
    elseif(mb_strlen($email) < 3){
        $errorMessage = 'Почта должна быть не короче трёх символов!';
    }
    elseif(mb_strlen($email) > 100){
        $errorMessage = 'Почта должна быть короче 100 символов!';
    }
    elseif($isHave != ''){
        $errorMessage = 'Эта почта уже занята!';
    }
    else{
    updateById(table:'user',id:$_SESSION['id'],params:['email' => $email]);
    $_SESSION['email'] = $email;
    header(header:'location: ' . BASE_URL . 'profile.php?id=' . $_SESSION['id']);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-description-button'])){
    $description = $_POST['description'];
    if($description === ''){
        $errorMessage = 'Поле должно быть заполнено!';
    }
    elseif($description === $_SESSION['description']){
        updateById(table:'user',id:$_SESSION['id'],params:['description' => $description]);
    $_SESSION['description'] = $description;
    header(header:'location: ' . BASE_URL . 'profile.php');
    }
    elseif(mb_strlen($description) < 3){
        $errorMessage = 'Описание должно быть не короче трёх символов!';
    }
    elseif(mb_strlen($description) > 150){
        $errorMessage = 'Описание должно быть короче 150 символов!';
    }
    else{
    updateById(table:'user',id:$_SESSION['id'],params:['description' => $description]);
    $_SESSION['description'] = $description;
    header(header:'location: ' . BASE_URL . 'profile.php?id=' . $_SESSION['id']);
    }
}

?>