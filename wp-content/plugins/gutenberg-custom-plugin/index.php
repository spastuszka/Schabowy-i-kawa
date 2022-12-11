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
    add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));
  }

  function adminAssets()
  {
    wp_enqueue_script('ourtestblocktype', plugin_dir_url(__FILE__) . 'test.js', array('wp-blocks'));
  }
}

$gutenbergCustom = new GutenbergCustom();
