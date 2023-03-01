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
    register_block_type(__DIR__, array(
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes)
  {
    ob_start(); ?>
    <h3>Today the sky is <?php echo esc_html($attributes['skyColor']) ?> and the grass is <?php echo esc_html($attributes['grassColor']) ?>!</h3>

<?php
    return ob_get_clean();
  }
}

$gutenbergCustom = new GutenbergCustom();
