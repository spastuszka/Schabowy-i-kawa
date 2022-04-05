<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="site-header">
    <div class="container">
      <h1 class="site-logo-text float-left">
        <a href="<?php echo site_url(); ?>"><img class="site-logo--img" src="<?php echo get_theme_file_uri('/images/logo_doradca_smaku.svg'); ?>" alt="Logo Schabowy i Kawa"></a>
      </h1>
      <span class="site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <!-- Menu dynamiczne używane przez zwykłego użytkownika -->
          <?php /*
          wp_nav_menu(array(
            'theme_location' => 'defaultHeader',
          )); */
          ?>
          <!-- Menu zmieniane manualnie w kodzie -->
          <ul>
            <li <?php if (is_page('o-nas') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"'; ?>><a href="<?php echo site_url('/o-nas'); ?> ">O nas</a></li>
            <li><a href="<?php echo site_url('/przepisy'); ?>">Przepisy</a></li>
            <li><a href="<?php echo site_url('/porady'); ?>">Porady</a></li>
            <li><a href="#">Kontakt</a></li>
          </ul>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn btn--medium btn--dark-red float-left push-right">Zaloguj</a>
          <a href="#" class="btn btn--medium btn--pink float-left">Rejestracja</a>
          <span class="search-trigger js-search-trigger push-right"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>