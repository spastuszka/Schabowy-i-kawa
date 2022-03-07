<?php

function pork_coffee_files()
{
  wp_enqueue_style('pork_coffee_main_styles', get_theme_file_uri('./build/style-index.css'));
  wp_enqueue_style('pork_coffee_normalize_styles', get_theme_file_uri('./build/index.css'));
}

add_action('wp_enqueue_scripts', 'pork_coffee_files');
