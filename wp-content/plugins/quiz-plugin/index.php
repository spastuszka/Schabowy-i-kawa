<?php
/*
    Plugin Name: Quiz Plugin
    Description: My second about custom quiz
    Version: 1.0
    Author: Sebastian Pastuszka
  */

if (!defined('ABSPATH')) exit; // Zabezpieczenie przed bezpośrednim dostępem do pliku poprzez URL bezpośredni do pliku

class QuizCustom
{
  function __construct()
  {
    // załadowanie testowego pliku JS po stronie admina
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets()
  {
    wp_register_style('quizeditcss', plugin_dir_url(__FILE__) . 'build/index.css');
    wp_register_script('quizblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
    register_block_type('quiz-plugin/gutenberg-block-quiz', array(
      'editor_script' => 'quizblocktype',
      'editor_style' => 'quizeditcss',
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

$quizCustom = new QuizCustom();
