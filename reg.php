<?php

include('app/controllers/users.php');
include('path.php');
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация - AnswerNest</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/regstyle.css" rel="stylesheet">
  </head>
  <body>
  <?php
  include("app/include/footer-bottom.php")
  ?>




  <div class="container">
    <form class="row reg-form justify-content-center" method="post" action="reg.php">
      <h2>Регистрация</h2>
      <div class="mb-3 col-12 col-md-4 err">
        <p><?php echo $errorMessage;?></p>
    </div>
    <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Имя пользователя</label>
            <input value="<?php echo $username;?>" name="username" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите имя пользователя...">
          </div>

          <div class="w-100"></div>

        <div class="mb-3 col-12 col-md-4">
          <label for="exampleInputEmail1" class="form-label">Электронная почта</label>
          <input value="<?php echo $email;?>" name="mail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите вашу электронную почту...">
          <div id="emailHelp" class="form-text">Мы никогда не передадим ваш адрес электронной почты кому-либо еще.</div>
        </div>

        <div class="w-100"></div>

        <div class="mb-3 col-12 col-md-4">
          <label for="exampleInputPassword1" class="form-label">Пароль</label>
          <input value="<?php echo $password;?>" name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Придумайте и введите пароль...">
        </div>

        <div class="w-100"></div>

        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword2" class="form-label">Подтверждение пароля</label>
            <input name="confpassword" type="password" class="form-control" id="exampleInputPassword2" placeholder="Повторите ваш пароль...">
          </div>

          <div class="w-100"></div>

          <div class="mb-3 col-12 col-md-4">
            <button type="submit" class="btn btn-primary" name="button-reg">Зарегистрироваться</button>
            <a href="login.php">Войти</a>
          </div>
        
      </form>
  </div>
    












     <!--FOOTER-->



  
       <!--FOOTER END-->
      <script src="assets/script/script.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/771c5afccd.js" crossorigin="anonymous"></script>
    </body>
  </html>