<?php
/*
    Plugin Name: Gutenberg Plugin
    Description: My first plugin about gutenberg custom element
    Version: 1.0
    Author: Sebstian Pastuszka
  */

if (!defined('ABSPATH')) exit; // Zabezpieczenie przed bezpośrednim dostępem do pliku poprzez URL bezpośredni do pliku

class GutenbergCustom
{
  function __construct()
  {
    // załadowanie testowego pliku JS po stronie admina
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets()
  {
    wp_register_script('ourtestblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
    register_block_type('gutenberg-custom-plugin/test-gutenberg-block', array(
      'editor_script' => 'ourtestblocktype',
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes)
  {
    return '<p>Today the sky is ' . $attributes['skyColor'] . ' and the grass is ' . $attributes['grassColor'] . '.!!!</p>';
  }
}

$gutenbergCustom = new GutenbergCustom();
