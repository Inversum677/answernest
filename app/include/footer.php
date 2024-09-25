<div class="footer container-fluid">
  <div class="footer-content container">
    <div class="row">
      <div class="footer-section about col-md-6 col-12">
        <h3 class="logo-text">AnswerNest</h3>
        <p>
          AnswerNest - это веб-сайт,на котором можно размещать и просматривать статьи,написаные пользователями.
        </p>
        <div class="contact">
          <span><i class="fa-solid fa-phone"></i> +7(951)-009-18-04</span>
          <br>
          <span><i class="fa-solid fa-envelope"></i> answernest@gmail.com</span>
        </div>
        <div class="socials">
          <a href="https://t.me/answernest" target="_blank"><i class="fa-brands fa-telegram"></i></a>
          <a href="https://vk.com/addiktion44" target="_blank"><i class="fa-brands fa-vk"></i></a>
        </div>
      </div>
      <div class="footer-section contact-form col-md-6 col-12">
        <h3 id="letter">Письмо разработчикам</h3>
        <br>
        <form action="index.php" method="post">
          <input value="<?php echo $_SESSION['email'];?>" type="email" name="email" class="text-input contact-input" placeholder="Введите свою электронную почту...">
          <textarea rows="4" name="message" class="text-input contact-input" placeholder="Введите своё сообщение..."></textarea>
          <button type="submit" class="btn-big contact-btn">
            <i class="fas fa-envelope"></i>
             Отправить
          </button>
        </form>
      </div>
    </div>
    
  </div>
</div>
<div class="footer-bottom">
  &copy; answernest.com | Designed by NikitaBelov
</div>