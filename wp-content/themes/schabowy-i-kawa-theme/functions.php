<?php

function pork_coffee_files()
{
  wp_enqueue_style('pork_coffee_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'pork_coffee_files');
