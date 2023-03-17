<?php

/*
  Plugin Name: Featured Cooker Block Type
  Version: 1.0
  Author: Sebastian Pastuszka
  Author URI: https://www.linkedin.com/in/sebastian-pastuszka/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require_once(plugin_dir_path(__FILE__) . 'inc/generateCookerHTML.php');
class FeaturedCooker
{
  function __construct()
  {
    add_action('init', [$this, 'onInit']);
    add_action('rest_api_init', [$this, 'cookHTML']);
  }

  /* Created link structur about new REST API endpoint */
  function cookHTML()
  {
    register_rest_route('featuredCooker/v1', 'getHTML', array(
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => [$this, 'getCookHTML']
    ));
  }

  /* Function thtat return the content of the endpoint */
  function getCookHTML($data)
  {
    /* We only return data, not modifit and order the json data - 
    generate via generateCookerHTML function*/
    return generateCookerHTML($data['cookID']);
  }


  function onInit()
  {
    wp_register_script('featuredCookerScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-i18n', 'wp-editor'));
    wp_register_style('featuredCookerStyle', plugin_dir_url(__FILE__) . 'build/index.css');

    register_block_type('ourplugin/featured-cooker', array(
      'render_callback' => [$this, 'renderCallback'],
      'editor_script' => 'featuredCookerScript',
      'editor_style' => 'featuredCookerStyle'
    ));
  }

  function renderCallback($attributes)
  {
    if ($attributes['cookID']) {
      wp_enqueue_style('featuredCookerStyle');
      return generateCookerHTML($attributes['cookID']);
    } else {
      return NULL;
    }
  }
}

$featuredProfessor = new FeaturedCooker();
