<?php

/* Custom Post Type */

function cooker_post_types()
{
  register_post_type('recipe', array(
    'public' => true,
    'show_in_rest' => true,
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
}

add_action('init', 'cooker_post_types');
