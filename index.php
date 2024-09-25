
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная - AnswerNest</title>

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


$bestId1 = 63;
$bestId2 = 66;
$bestId3 = 64;
$best1 = selectOne(table:'post', params:['id' => $bestId1]);
$best2 = selectOne(table:'post', params:['id' => $bestId2]);
$best3 = selectOne(table:'post', params:['id' => $bestId3]);
?>
    <!-- HEADER END -->



    <!-- Карусель -->
 <div class="container carousel">
  <div class="row">
    <h2 class="bestquestions-title">Лучшие статьи</h2>

  </div>
  <div id="carouselExampleDark" class="carousel carousel-dark slide">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <img src="<?php if($best1['img'] == ''){echo BASE_URL . 'assets/img/default.png';}else{echo BASE_URL . 'assets/img/posts/' . $best1['img'];}?>" class="d-block w-100" alt="img1">
        <div class="carousel-caption d-none d-md-block">
          <h5><a href="single-post.php?id=<?php echo $bestId1;?>"><?php echo $best1['title'];?></a></h5>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <img src="<?php if($best2['img'] == ''){echo BASE_URL . 'assets/img/default.png';}else{echo BASE_URL . 'assets/img/posts/' . $best2['img'];}?>" class="d-block w-100" alt="img2">
        <div class="carousel-caption d-none d-md-block">
          <h5><a href="single-post.php?id=<?php echo $bestId2;?>"><?php echo $best2['title'];?></a></h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="<?php if($best3['img'] == ''){echo BASE_URL . 'assets/img/default.png';}else{echo BASE_URL . 'assets/img/posts/' . $best3['img'];}?>" class="d-block w-100" alt="img3">
        <div class="carousel-caption d-none d-md-block">
          <h5><a href="single-post.php?id=<?php echo $bestId3;?>"><?php echo $best3['title'];?></a></h5>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
 </div>
    

    <!-- Карусель END -->

    <!-- Блок MAIN -->
<div class="container">
  <div class="content row">
    <div class="main-content col-md-9 col-12">
      
      

      <?php
      showLastQuestions()
      ?>

    </div>

    <?php
    include("app/include/sidebar.php");
    ?>
  </div>
</div>
    <!-- Блок MAIN END -->

     <!--FOOTER-->
<?php
include("app/include/footer.php");
?>
     <!--FOOTER END-->

     



    <script src="assets/script/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771c5afccd.js" crossorigin="anonymous"></script>
  </body>
</html>