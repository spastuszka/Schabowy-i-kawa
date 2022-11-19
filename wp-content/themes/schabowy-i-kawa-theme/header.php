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
      <h1 class="site-logo--text float-left">
      <?php
      the_custom_logo()
      ?>
      </h1>
      <a href="<?php echo esc_url(site_url('/wyszukaj')) ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">

          <ul>
            <li <?php if (is_page('o-nas') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"'; ?>><a href="<?php echo site_url('/o-nas'); ?> ">O nas</a></li>
            <li <?php if (get_post_type() == 'recipe') echo 'class="current-menu-item"'; ?>><a href="<?php echo get_post_type_archive_link('recipe'); ?>">Przepisy</a></li>
            <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"'; ?>><a href="<?php echo site_url('/porady'); ?>">Porady</a></li>
            <li><a href="#">Kontakt</a></li>
          </ul>
        </nav>
        <a href="<?php echo esc_url(site_url('/wyszukaj')) ?>" class="search-trigger js-search-trigger push-right"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></a>
        <div class="site-header__util">
          <a href="#" class="btn btn--medium btn--dark-red float-left">Zaloguj</a>
          <a href="#" class="btn btn--medium btn--dark btn--register float-left">Rejestracja</a>
        </div>
      </div>
    </div>
  </header>