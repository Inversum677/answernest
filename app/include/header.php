<?php
include('app/controllers/users.php');

?>
<header class="container-fluid">
      <div class="container">
          <div class="row">
              <div class="col-4">
                  <h1>
                    <a href="<?php echo BASE_URL ?>">AnswerNest</a>
                  </h1>
                </div>
                  <nav class="col-8">
                    
                      
                      
                  <div class="drop">
                        <button class="droptoggle" onClick='this.innerHTML=="Показать функции" ? this.innerHTML="Скрыть" : this.innerHTML="Показать функции"'>
                          Показать функции
                        </button>
                        <div class="drop-menu">
                          
                            <a href="<?php echo BASE_URL?>">Главная</a>
                            <?php if(isset($_SESSION['id'])): ?>
                            <a href="create-question.php">Создать статью</a>
                            <a href="profile.php"><i class="fa-solid fa-user"></i> <?php echo $_SESSION['login'];?></a>
                            <a href="<?php echo BASE_URL . 'logout.php' ?>"><i class="fa-solid fa-right-from-bracket"></i> Выход</a>
                            <?php else: ?>
                              <a href="login.php">Создать статью</a>
                              <a href="login.php"><i class="fa-solid fa-door-open"></i> Вход</a>
                              <?php endif;?>
                        </div>
                      </div>
                    
                      <ul class="panel">
                        <li><a href="<?php echo BASE_URL ?>">Главная</a></li>
                        <?php if(isset($_SESSION['id'])): ?>
                          <li><a href="create-question.php">Создать статью</a></li>
                        <li>
                            <a href="profile.php?id=<?php echo $_SESSION['id']?>"><i class="fa-solid fa-user"></i> <?php echo $_SESSION['login'];?></a>
                            <li><a href="<?php echo BASE_URL . 'logout.php' ?>"><i class="fa-solid fa-right-from-bracket"></i> Выход</a></li>
                            <?php else: ?>
                              <li><a href="login.php">Создать статью</a></li>
                              <li>
                              <a href="login.php"><i class="fa-solid fa-door-open"></i> Вход</a>
                        </li>

                        <?php endif; ?> 
                      </ul>

                  </nav>
              
          </div>
      </div>  
     
    </header> 