<?php
include('app/controllers/users.php');
include('path.php');
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Авторизация - AnswerNest</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/loginstyle.css" rel="stylesheet">
  </head>
  <body>
    <!--FOOTER-->


    <?php
  include("app/include/footer-bottom.php")
    ?>
  
       <!--FOOTER END-->




  <div class="container">
    <form class="row reg-form justify-content-center" method="post" action="login.php">
      <h2>Авторизация</h2>
      <div class="mb-3 col-12 col-md-4 err">
        <p><?php echo $errorMessage?></p>
    </div>
    <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Имя пользователя</label>
            <input name="username" value="<?php echo $username;?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите имя пользователя...">
          </div>

          <div class="w-100"></div>

        <div class="mb-3 col-12 col-md-4">
          <label for="exampleInputPassword1" class="form-label">Пароль</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль...">
        </div>

        <div class="w-100"></div>

          <div class="mb-3 col-12 col-md-4">
            <button name="button-log" type="submit" class="btn btn-primary">Войти</button>
            <a href="reg.php">Зарегистрироваться</a>
          </div>
        
      </form>
  </div>
    












     
      <script src="assets/script/script.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/771c5afccd.js" crossorigin="anonymous"></script>
    </body>
  </html>