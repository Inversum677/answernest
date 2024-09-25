<?php
 include("app/controllers/create.php");
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Создать статью - AnswerNest</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    <!-- HEADER -->
<?php 
//include("app/include/header.php");
?>
    <!-- HEADER END -->




    <!-- Блок MAIN -->
<div class="container">
  <div class="create-question row">
  <a class="to-main-page" href="index.php">Отмена</a>
    <h2>Создание статьи</h2>
    
        <form class="create-question-form" method="post" action="create-question.php" enctype="multipart/form-data">
        <p class="errortext"><?php echo $errorMessage;?></p>
                <div class="col">
                    <input value="<?php echo $title;?>" name="title" class="title-create" type="text" placeholder="Введите заголовок статьи">
                </div>
                <div class="col">
                    <textarea name="content" rows="10" class="text-create" type="text" placeholder="Введите текст статьи здесь"><?php echo $content;?></textarea>
                </div>
                    <div class="input-img col input-group mb-3">
                        
                            <input name="img" type="file" class="form-control" id="inputGroupFile02">
                            <label class="add-img input-group-text" for="inputGroupFile02">Загрузить</label>
                        
                    </div>
                    <select name="topic" aria-label="Default select example">
                            <option value="0" selected>Без категории</option>
                            <?php
                            topicShowForSelected();
                            ?>
                        </select>
                    <div class="col-12">
                        <button name="create-post-button" class="btn-create-question" type="submit">Создать статью</button>
                    </div>

        </form>
  </div>
</div>
    <!-- Блок MAIN END -->

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