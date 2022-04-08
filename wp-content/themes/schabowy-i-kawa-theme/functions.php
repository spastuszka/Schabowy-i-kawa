<?php

function pork_coffee_files()
{
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
