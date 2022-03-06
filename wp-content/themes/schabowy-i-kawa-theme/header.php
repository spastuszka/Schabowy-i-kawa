<!DOCTYPE html>
<html>

<head>
  <?php wp_head(); ?>
</head>

<body>
  <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left">
        <a href="#"><strong>Schabowy</strong> i kawa</a>
      </h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <li><a href="#">O nas</a></li>
            <li><a href="#">Przepisy</a></li>
            <li><a href="#">Porady</a></li>
            <li><a href="#">Kontakt</a></li>
          </ul>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn btn--small btn--orange float-left push-right">Zaloguj</a>
          <a href="#" class="btn btn--small btn--dark-orange float-left">Rejestracja</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>