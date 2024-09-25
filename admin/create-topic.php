<?php
include("../path.php");
include("../app/controllers/topics.php");
if($_SESSION['admin']):
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Административная панель - AnswerNest</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../assets/css/adminstyle.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <div class="row">
          <a class="exit-panel" href="<?php echo BASE_URL; ?>">Выйти из панели</a>
          <h1>Административная панель</h1>
          <h2 class="welcome">Добро пожаловать, <?php echo $_SESSION['login']?></h2>
          <?php
            include("../app/include/admin-sidebar.php");
            ?>
            <div class="posts col-md-9 col-12">
                <h2>Создание категории</h2>
                <form method="post" action="create-topic.php">
                  
                  <input value="<?php echo $name;?>" name="topic-name" class="col-md-9 create-topic-input" placeholder="Введите название категории">
                  <button name="topic-button" type="submit" class="create-topic-button col-md-2">Создать</button>
                  <p class="errortext"><?php echo $errorMessage;?></p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771c5afccd.js" crossorigin="anonymous"></script>
  </body>
</html>
<?php
else:
  header(header:'location: ' . BASE_URL);
endif;
?>