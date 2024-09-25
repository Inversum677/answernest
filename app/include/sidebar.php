<?php
include("../controllers/search.php");
?>
<div class="sidebar col-md-3 col-12">
      <div class="section search">
        <h3><i class="fa-solid fa-magnifying-glass"></i>  Поиск</h3>
        <form action="app/controllers/search.php" method="post">
          <input value="<?php echo $_GET['search'];?>" type="text" name="search-term" class="text-input" placeholder="Введите название статьи..." >
        </form>
      </div>
        <div class="section topics">
          <h3>Категории</h3>
          <ul>
            <?php
            showTopicsSidebar();
            ?>
          </ul>

        </div>
      
    
    </div>