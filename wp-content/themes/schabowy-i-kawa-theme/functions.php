<?php

/* Funkcja - Page Banner */
function pageBanner($args = NULL)
{

  if (!$args['title']) {
    $args['title'] = get_the_title();
  }

  if (!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  if (!$args['photo']) {
    if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(
      <?php echo $args['photo'];
      ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
      <div class="page-banner__intro c-white">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>

<?php
}

function pork_coffee_files()
{
  wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('font-lato', '//fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');
  wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
  wp_enqueue_style('pork_coffee_main_styles', get_theme_file_uri('./build/style-index.css'));
  wp_enqueue_style('pork_coffee_normalize_styles', get_theme_file_uri('./build/index.css'));
}

add_action('wp_enqueue_scripts', 'pork_coffee_files');


/* Created dynamic page title */

function cooking_features()
{
  register_nav_menu('defaultHeader', 'Menu Główne');
  register_nav_menu('footerLocation', 'Stopka - Centrum');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('cookerPortrait', 200, 200, true);
  add_image_size('recipeLandscape', 400, 200, true);
  add_image_size('pageBanner', 1500, 350, true);
  add_image_size('postImg', 500, 350, true);
}

add_action('after_setup_theme', 'cooking_features');


/* Change default excerpt length */
function blog_custom_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'blog_custom_excerpt_length', 999);


/* Breadcrumbs function */
function get_breadcrumb()
{
  echo '<a href="' . home_url() . '" rel="nofollow">Strona Główna</a>';
  if (is_category() || is_single()) {
    echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
    the_category(' &bull; ');
    if (is_single()) {
      echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
      the_title();
    }
  } elseif (is_page()) {
    echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
    echo the_title();
  } elseif (is_search()) {
    echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
    echo '"<em>';
    echo the_search_query();
    echo '</em>"';
  }
}
