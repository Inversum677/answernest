
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Профиль - AnswerNest</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    <!-- HEADER -->
<?php 
include("app/include/header.php");

$haveUser = selectOne(table:'user',params:['id' => $_GET['id']]);
if($haveUser == []){
  echo '<p color="white">Пользователь не найден!</p>';
  exit();
}
?>
    <!-- HEADER END -->

<div class="container">
    <div class="row profile">
        <h2>Информация об аккаунте</h2>
        <div class="profile-info">
            <ul>
                <?php
                
                showProfile();
                ?>
                 
            </ul>
            
    
        
      </div>
      <div class="your-questions col-md-12 col-12">
      <?php showProfileQst();?>
        </div>


      


    
</div>
</div>
</div>


    <!--FOOTER-->
<?php
include("app/include/footer.php");
?>
     <!--FOOTER END-->
    <script src="script/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771c5afccd.js" crossorigin="anonymous"></script>
  </body>
</html>