
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Статья - AnswerNest</title>

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
    
    if(selectOne(table:'post', params:['id' => $_GET['id']]) == []){
      header(header:'location: ' . BASE_URL);
    }
    
     $id = $_GET['id'];
     
      if($_SESSION['id-post-' . $id] !== 1){
     $post = selectOne(table:'post',params:['id' => $id]);
     $views = $post['views'] + 1;
     updateById(table:'post',id:$id,params:['views' => $views]);
     $_SESSION['id-post-' . $id] = 1;
     }
     
     
     
    ?>
    <!-- HEADER END -->



    

    <!-- Блок MAIN -->
    <?php showSinglePost();
    include("app/controllers/comments.php");
    ?>



        <div id="create-comm"  class="answer-section">
          <h2>Написать комментарий</h2>
          <p><?php echo $errorMessage;?></p>
          <form method="post" action="single-post.php?id=<?php echo $id_post . '#create-comm';?>">
              <textarea name="comment" rows="4" type="text" placeholder="Введите комментарий..."><?php echo $content;?></textarea>
              <button name="create-comment" type="submit"><i class="fa-solid fa-paper-plane"></i> Отправить</button>
          </form>
        </div>


        



        <div class="another-answer">
          
        <?php showComments();?>
           
          


        </div>
      </div>
    </div>


    <?php
    include("app/include/sidebar.php");
    ?>
      
    
    </div>
  </div>
</div>
    <!-- Блок MAIN END -->

     <!--FOOTER-->

     <?php
    include("app/include/footer.php");
    ?>

     <!--FOOTER END-->
     
    <script src="assets/script/script.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771c5afccd.js" crossorigin="anonymous"></script>
  </body>
</html>