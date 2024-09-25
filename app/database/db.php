<?php
session_start();
//Файл с подключением
require('connect.php');

//Красиво выводить значение
function pt($value){
   echo '<pre>';
    print_r($value);
    echo '</pre>';
}

//Проверка выполнения запроса
function checkError($query){

    $errorinfo = $query->errorInfo();

    if($errorinfo[0] !== PDO::ERR_NONE){
        echo $errorinfo[2];
        exit();
    }
}

//Запрос на получение данных из выбранной таблицы
function selectAll($table, $params = []){
    //Необходимо добавлять при работе с пдо
    global $pdo;

    //Запись запроса в переменную
    $sql = "SELECT * FROM $table";

     //Добавление кавычек в нечисловые элементы и добавление WHERE и AND к запросу 
    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if(!is_numeric($value)){
                $value = "'$value'";
            }
            if($i === 0){
                $sql = $sql . " WHERE $key = $value";
            }else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    
    //Подготовка и выполнение запроса
    $query = $pdo->prepare($sql);
    $query->execute();
    checkError($query);
    return $query->fetchAll();
}

//Тот же самый запрос на получение данных из таблицы,но только 1 пользователя
function selectOne($table, $params = []){
    //Необходимо добавлять при работе с пдо
    global $pdo;

    //Запись запроса в переменную
    $sql = "SELECT * FROM $table";

    //Добавление кавычек в нечисловые элементы и добавление WHERE и AND к запросу 
    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if(!is_numeric($value)){
                $value = "'$value'";
            }
            if($i === 0){
                $sql = $sql . " WHERE $key = $value";
            }else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    $sql = $sql . " LIMIT 1";   
    
    //Подготовка и выполнение запроса
    $query = $pdo->prepare($sql);
    $query->execute();
    checkError($query);
    return $query->fetch();
}







//Запись в таблицу БД
function insert($table, $values){
    
global $pdo;

$str1 = "";
$str2 = "";
$i = 0;

foreach($values as $key => $value){
    if($i === 0){
    $str1 = $str1 . "$key";
    $str2 = $str2 . "'$value'";
    }
    else{
    $str1 = $str1 . ", $key";
    $str2 = $str2 . ", '$value'";
    }
    
    $i++;
};
//Запрос
$sql = "INSERT INTO $table ($str1) VALUES ($str2)";

$query = $pdo->prepare($sql);
$query->execute();
checkError($query);

return $pdo->lastInsertId();
}

function updateById($table,$id,$params = []){
    global $pdo; 
    $i = 0;
    $str = "";
    foreach($params as $key => $value){
        if($i === 0){
            $str = "$key = '$value'";
        }
        else{
            $str = $str . ", $key = '$value'";
        }
        
        $i++;
    };

    $sql = "UPDATE $table SET $str WHERE id = $id";
   
    $query = $pdo->prepare($sql);
    $query->execute();
    checkError($query);
}

//Функция удаления строки из таблицы через обращение по id
function deleteById($table, $id){
    
    global $pdo;
    
    //Запрос
    $sql = "DELETE FROM $table WHERE id = $id";
    
    $query = $pdo->prepare($sql);
    $query->execute();
    checkError($query);
    
    };
//Функция аунтефикации пользователя
function userAugh($table,$username,$password){
    $checkUser = selectOne(table:'user',params:['username' => $username]);
    if($username == '' || $password == ''){
        $errorMessage = "Все поля должны быть заполнены!";
    }
    elseif(password_verify($password, $checkUser['password'])){
        
        $_SESSION['login'] = $checkUser['username'];
        $_SESSION['id'] = $checkUser['id'];
        $_SESSION['admin'] = $checkUser['admin'];
        $_SESSION['email'] = $checkUser['email'];
        $_SESSION['description'] = $checkUser['description'];
        $_SESSION['created'] = $checkUser['created'];
        header(header:'location: ' . BASE_URL);
        
    }else{
        $errorMessage = "Неверное имя пользователя или пароль!";
    }
    return $errorMessage;
}

//Вывод пользователей в админ панеле
function usersShow(){
    $users = selectAll(table:'user');
    foreach($users as $key => $value){
        $user = $users[$key];
        $idUser = $user['id'];
        $nameUser = $user['username'];
        $emailUser = $user['email'];
        $isAdmin = $user['admin'];
    echo '<div class="row post">
                    <div class="id col-md-1">' . $idUser . '</div>
                    <div class="username col-md-3"><a href="#">' . $nameUser . '</a></div>
                    <div class="isadmin col-md-5">' . $emailUser . '</div>
                    <div class="change col-md-1">' . $isAdmin . '</div>
                    <div class="delete col-md-2"><a href="delete-user.php?id=' . $idUser . '"><i class="fa-solid fa-trash"></i></a></div>
                </div>';
    }
};
//Вывод категорий в сайдбаре
function showTopicsSidebar(){
    $topics = selectAll(table:'topic');
    foreach($topics as $key => $value){
        $topic = $topics[$key];
        $nameTopic = $topic['name'];
        $idTopic = $topic['id'];
        if($idTopic == 0){

        }else{
            echo '<a href="' . BASE_URL . 'index.php?id=' . $idTopic . '"><li>' . $nameTopic . '</li></a>';
        }
    
    }
};

//Функция вывода категорий
function topicShow(){
    $topics = selectAll(table:'topic');
    foreach($topics as $key => $value){
        $topic = $topics[$key];
        $idTopic = $topic['id'];
        $nameTopic = $topic['name'];
    echo '<div class="row post">
    <div class="id col-md-1">' . $idTopic . '</div>
    <div class="username col-md-7">' . $nameTopic . '</div>
    <div class="change col-md-2"><a href="edit-topic.php?id=' . $idTopic . '"><i class="fa-solid fa-pen-nib"></i></a></div>
    <div class="delete col-md-2"><a href="delete-topic.php?id=' . $idTopic . '"><i class="fa-solid fa-trash"></i></a></div>
    </div>';
    }
    
}
//Показ категорий в выпадающем меню при создании вопроса
function topicShowForSelected(){
    $topics = selectAll(table:'topic');
    foreach($topics as $key => $value){
        $topic = $topics[$key];
        $idTopic = $topic['id'];
        $nameTopic = $topic['name'];
        if($idTopic === 0){

        }
        else{
            echo '<option value="' . $idTopic . '">' . $nameTopic . '</option>';
        }
        
    }
}






//Показ последних вопросов на главной странице
function showLastQuestions(){
    $titlelast = 'Последние статьи';
    if($_GET['search']){
        $search = $_GET['search'];
        $posts = selectAll(table:'post', params:['title' => $search]);
        $titlelast = 'Результаты поиска по тегу: <strong>' . $search . '</strong>';
        if($posts == []){
            $isHavePosts = 'Результатов не найдено!';
        }
    }
    elseif($_GET['id']){
        $idneedtopic = $_GET['id'];
        $nameneedtopic = selectOne(table:'topic', params:['id' => $idneedtopic])['name'];
        $posts = selectAll(table:'post', params:['topic' => $idneedtopic]);
        if($posts == []){
            $isHavePosts = 'Статей с такой категорией пока что нет!';
        }
        $titlelast = 'Категория: '. $nameneedtopic;
    }
    
    else{
    $posts = selectAll(table:'post');    
    }
    echo '<h2 class="lst-qst-ttl lastquestions-title">' . $titlelast . '</h2>';
    echo $isHavePosts;
    krsort(array:$posts);
    $i = 0;
    foreach($posts as $key => $value){
        if($i >= 20){
            break;
        }
        $singlepost = $posts[$key];
        $id = $singlepost['id'];
        $id_user = $singlepost['id_user'];
        $title = $singlepost['title'];
        $img = $singlepost['img'];
        $views = $singlepost['views'];
        $likes = $singlepost['likes'];
        $topicId = $singlepost['topic'];
        $topic = selectOne(table:'topic',params:['id' => $topicId]);
        $topicName = $topic['name'];
        
        $user = selectOne(table:'user', params:['id' => $id_user]);
        $username = $user['username'];

        
            echo 
            '<div class="post row" onclick="' . "location.href='single-post.php?id=" . $id . "'" . '">
            <div class="post-text">
            <h2>
              <p class="post-title">' . $title . '</p>
            </h2>
            
            <p class="about-post-p"><i class="fa-solid fa-user"></i> ' . $username . '</p>
            
            <p class="about-post-p"><i class="fa-solid fa-list"></i> ' . $topicName . '</p>
            <p class="about-post-p"><i class="fa-solid fa-thumbs-up"></i> ' . $likes . '           <i class="fa-solid fa-eye"></i> ' . $views . '</p>
            
          </div>
        </div>';
        $i++;
    }
}


//Вывод всех вопросов в админку
function adminShowPosts(){
    $posts = selectAll(table:'post');
    foreach($posts as $key => $value){
        $post = $posts[$key];
        $id = $post['id'];
        $title = $post['title'];
        $id_user = $post['id_user'];
        $user = selectOne(table:'user',params:['id' => $id_user]);
        $username = $user['username'];
        echo '<div class="row post">
                    <div class="id col-md-1">' . $id . '</div>
                    <div class="title col-md-5"><a href="#">' . $title . '</a></div>
                    <div class="autor col-md-2"><a href="#">'. $username . '</a></div>
                    <div class="change col-md-2"><a href="#"><i class="fa-solid fa-pen-nib"></i></a></div>
                    <div class="delete col-md-2"><a href="admin-delete-question.php?id=' . $id . '"><i class="fa-solid fa-trash"></i></a></div>
                </div>';

    }
}

function showSinglePost(){
    $post = selectOne(table:'post',params:['id' => $_GET['id']]);
    
        $id_user = $post['id_user'];
        $user = selectOne(table:'user',params:['id' => $id_user]);
        $topicId = $post['topic'];
        $topic = selectOne(table:'topic',params:['id' => $topicId]);
    $id = $_GET['id'];
    $title = $post['title'];
    $username = $user['username'];
    $content = $post['content'];
    $created = $post['created'];
    $topicName = $topic['name'];
    $img = $post['img'];
    $views = $post['views'];
    $likes = $post['likes'];

    
        echo '<div class="container">
  <div class="content row">
    <div class="main-content col-md-9 col-12">
      <h2 class="lastquestions-title">' . $title . '</h2>
      <div class="single-post row">';
        if($img !== ''){
            echo '<div class="img col-12">
          <img src="' . BASE_URL . 'assets/img/posts/' . $img . '" alt="Пикча к вопросу">
        </div>';
        }
        echo '<div class="single-post-text col-12">
        <p class="question-main-text">' . $content . '</p>
          <div class="about-post">
          <a href="profile.php?id=' . $id_user . '"><i class="fa-solid fa-user"></i> ' . $username . '</a>
          <p class="about-post-p"><i class="fa-solid fa-list"></i> ' . $topicName . '</p>
          <p class="about-post-p"><i class="fa-solid fa-calendar-days"></i> ' . $created . '</p> 
          <p class="section-info-post about-post-p"><i class="fa-solid fa-eye"></i> ' . $views;
          if($_SESSION['post' . $id] == 1){
            echo '<a class="post-rt rated" href="' . BASE_URL . 'unrate-post.php?id=' . $id . '"><i class="fa-solid fa-thumbs-up"></i> ' . $likes . '</a>';
          }
          else{
            echo '<a class="post-rt unrated" href="' . BASE_URL . 'rate-post.php?id=' . $id . '"><i class="fa-solid fa-thumbs-up"></i> ' . $likes . '</a>';
          }

        echo '</p></div>
          

        </div>';
    
    
}

function showProfile(){
$id_user = $_GET['id'];

$user = selectOne(table:'user',params:['id' => $id_user]);
$username = $user['username'];
$email = $user['email'];
$description = $user['description'];
$created = $user['created'];

if($id_user == $_SESSION['id']){
    echo
    '<li>Имя пользователя: <br><strong>' . $username . '</strong><a href="edit-username.php?id=' . $id_user . '" class="edit-profile"> Изменить</a></li>
                <li>Электронная почта: <br><strong>' . $email . '</strong><a href="edit-email.php?id=' . $id_user . '" class="edit-profile"> Изменить</a></li>
                <li><p class="description-user">Описание: <br><strong>' . $description . '</strong><a href="edit-description.php?id=' . $id_user . '" class="edit-profile"> Изменить</a></p></li>
                <li>Дата создания аккаунта: <br><strong>' . $created . '</strong></li>';
                    
                if($_SESSION['admin'] == 1){
                echo '<li><a href="admin/admin-posts.php" class="admin-panel">Админ панель</a></li>';
                }
                 
                 
}else{
    echo '<li>Имя пользователя: <br><strong>' . $username . '</strong></li>';
            if($description !== ''){
                echo '<li><p class="description-user">Описание: <br><strong>' . $description . '</strong></p></li>';
            }
                
                echo '<li>Дата создания аккаунта: <br><strong>' . $created . '</strong></li>';
}
}


function showProfileQst(){
$id_user = $_GET['id'];
$posts = selectAll(table:'post',params:['id_user' => $id_user]);
$user = selectOne(table:'user',params:['id' => $id_user]);
$username = $user['username'];
if($posts == []){
    
}else{
    if($id_user == $_SESSION['id']){
    echo '<h2>Ваши статьи</h2>';
}else{
    echo '<h2>Статьи аккаунта</h2>';
}
krsort(array:$posts);

    foreach($posts as $key => $value){
        $singlepost = $posts[$key];
        $id = $singlepost['id'];
        $id_user = $singlepost['id_user'];
        $title = $singlepost['title'];
        $img = $singlepost['img'];
        $topicId = $singlepost['topic'];
        $topic = selectOne(table:'topic',params:['id' => $topicId]);
        $topicName = $topic['name'];
        $views = $singlepost['views'];
        
        $user = selectOne(table:'user', params:['id' => $id_user]);
        $username = $user['username'];
        if($id_user == $_SESSION['id']){
            echo 
            '
            <div class="post row" onclick="' . "location.href='single-post.php?id=" . $id . "'" . '">
            <div class="post-text">
            <h2>
              <p class="post-title">' . $title . '</p>
            </h2>
            <div class="row">
                <div class="col-md-10 col-12">
                    <p class="about-post-p"><i class="fa-solid fa-user"></i> ' . $username . '</p>
                    <p class="about-post-p"><i class="fa-solid fa-list"></i> ' . $topicName . '</p>
                    <p class="about-post-p"><i class="fa-solid fa-eye"></i> ' . $views . '</p>
                </div>
                <div class="control-div col-md-2 col-12">
                    <a class="control-questions" href="edit-question.php?id=' . $id . '"><i class="fa-solid fa-pen-nib"></i></a>
                    <a class="control-questions" href="delete-question.php?id=' . $id . '"><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
          </div>
        </div>';
        }else{
            echo 
            '
            <div class="post row" onclick="' . "location.href='single-post.php?id=" . $id . "'" . '">
            <div class="post-text">
            <h2>
              <p class="post-title">' . $title . '</p>
            </h2>
            
            <p class="about-post-p"><i class="fa-solid fa-user"></i> ' . $username . '</p>
            <p class="about-post-p"><i class="fa-solid fa-list"></i> ' . $topicName . '</p>
            <p class="about-post-p"><i class="fa-solid fa-eye"></i> ' . $views . '</p>
            
          </div>
        </div>';
        }
            
}
}

}
function showComments(){
    $comments = selectAll(table:'comment', params:['id_post' => $_GET['id']]);
    $num = count($comments);
    krsort(array:$comments);
    echo '<h2>Комментарии (' . $num . ')</h2>';
    
    
    foreach($comments as $key => $value){
        $comment = $comments[$key];
        $content = $comment['content'];
        $id = $comment['id'];
        $id_user = $comment['id_user'];
            $user = selectOne(table:'user',params:['id' => $id_user]);
        $username = $user['username'];
        $created = $comment['created'];
        $likes = $comment['likes'];
        echo '<div class="another-answer-post" id="' . $id . '">
           
          <p class="another-answer-post-text">' . $content . '</p>
            <div class="info-answer-text row">
              <div class="col-md-10 col-12">
              <a href="profile.php?id=' . $id_user . '"><i class="fa-solid fa-user"></i> ' . $username . '</a>
             <p><i class="fa-solid fa-calendar-days"></i> ' . $created . '</p>
              </div>
              <div class="rate-answer col-md-2 col-12">';
                if($_SESSION['comm' . $id] == 1){
                   
                   echo '<a class="rated" href="' . BASE_URL . 'unrate-comm.php?id=' . $id . '"><i class="fa-solid fa-thumbs-up"></i> ' . $likes . '</a>';   
                }
                else{
                echo '<a class="unrated" href="' . BASE_URL . 'rate-comm.php?id=' . $id . '"><i class="fa-solid fa-thumbs-up"></i> ' . $likes . '</a>'; 
                }
              
                if($id_user == $_SESSION['id']){
                    echo '<a class="delete-comm" href="delete-comm.php?id=' . $id . '"><i class="fa-solid fa-trash"></i></a>';
                }
              echo 
              '</div>
            </div>
          </div>';
          
    }    
    
    
}
?>