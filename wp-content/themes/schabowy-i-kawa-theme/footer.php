<footer class="site-footer">
  <div class="site-footer__navigation_box container">
    <div class="site-footer__footer_logo">
      <a href="<?php echo site_url(); ?>"><img class="site-footer__footer_logo--img" src="<?php echo get_theme_file_uri('/images/logo_doradca_smaku.svg'); ?>" alt="Logo Schabowy i Kawa"></a>
    </div>
    <div class="site-footer__site_map">
      <?php /*
      wp_nav_menu(array(
        'theme_location' => 'footerLocation',
      )); */
      ?>
      <div class="site-footer__link_wrapper">
        <a class="site-footer__link" href="<?php echo site_url('/o-nas') ?>">O nas</a>
      </div>
      <div class="site-footer__link_wrapper">
        <a class="site-footer__link" href="/przepisy">Przepisy</a>
      </div>
      <div class="site-footer__link_wrapper">
        <a class="site-footer__link" href="/porady">Porady</a>
      </div>
      <div class="site-footer__link_wrapper">
        <a class="site-footer__link" href="/kontakt">Kontakt</a>
      </div>
      <div class="site-footer__link_wrapper">
        <a class="site-footer__link" href="/regulamin">Regulamin</a>
      </div>
      <div class="site-footer__link_wrapper">
        <a class="site-footer__link" href="/polityka-prywatnosci">Polityka prywatności</a>
      </div>
    </div>
    <div class="site-footer__footer_socials">
      <nav>
        <ul class="min-list social-icons-list group">
          <li>
            <a href="#" class="social-color--facebook"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>
          </li>
          <li>
            <a href="#" class="social-color--youtube"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
          </li>
          <li>
            <a href="#" class="social-color--linkedin"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
          </li>
          <li>
            <a href="#" class="social-color--instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="site-footer__copyright">
      <p class="site-footer__copyright--text">
        &copy; 2022 <a href="#" class="site-footer__link">Schabowy i kawa</a> | Wszelkie prawa zastrzeżone.
      </p>
    </div>
  </div>
</footer>

<div class="search-overlay search-overlay--active">
  <div class="search-overlay__top">
    <div class="container">
       <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
       <input type="text" class="search-term" placeholder="Wyszukaj..." id="search-term ">
       <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i> 
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>

</html>