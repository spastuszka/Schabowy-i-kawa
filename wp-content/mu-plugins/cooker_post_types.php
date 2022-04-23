<?php

/* Custom Post Type */

function cooker_post_types()
{
  // Custom Post Type - Recipes
  register_post_type('recipe', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'rewrite' => array(
      'slug' => 'recipes',
    ),
    'has_archive' => true,
    'public' => true,
    'description' => 'Recipe custom post type',
    'labels' => array(
      'name' => 'Recipes',
      'add_new_item' => 'Add New Recipe',
      'edit_item' => 'Edit Recipe',
      'all_items' => 'All Recipes',
      'singular_name' => 'Recipe',
    ),
    'menu_icon' => 'dashicons-food',
  ));

  // Custom Post Type - Cookers
  register_post_type('cooker', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'rewrite' => array(
      'slug' => 'cookers',
    ),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Cookers',
      'add_new_item' => 'Add New Cooker',
      'edit_item' => 'Edit Cooker',
      'all_items' => 'All Cookers',
      'singular_name' => 'Cooker',
    ),
    'menu_icon' => 'dashicons-drumstick',
  ));
}

add_action('init', 'cooker_post_types');
