<?php

/*
  Plugin name: Word Count Plugin
  Description: Plugin counting words, characters and reading time of a single post
  Version: 1.0
  Author: Sebstian Pastuszka
  Text Domain: wcp-plugin
  Domain Path: /languages
*/

class WordCountAndTimePlugin
{
  function __construct()
  {
    add_action('admin_menu', array($this, 'adminLinkPage'));
    add_action('admin_init', array($this, 'settings'));
    add_filter('the_content', array($this, 'ifWrap'));
    /* Translation */
    add_action('init', array($this, 'languages'));
  }

  function languages()
  {
    load_plugin_textdomain('wcp-plugin', false, dirname(plugin_basename(__FILE__)) . '/languages');
  }

  function ifWrap($content)
  {
    if (
      is_main_query() and is_single() and
      (get_option('wcp_wordcount', '1') or
        get_option('wcp_character_count', '1') or
        get_option('wcp_read_time', '1')
      )
    ) {
      return $this->createHTML($content);
    }
    return $content;
  }

  function createHTML($content)
  {
    $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';

    // obliczanie liczby słów pojedynczo, poniewaz będzie opotrzebna zarówno do czasu czytania

    if (get_option('wcp_wordcount', '1') == '1' or get_option('wcp_read_time', '1') == '1') {
      $wordCount = str_word_count(strip_tags($content));
    }

    if (get_option('wcp_wordcount', '1') == '1') {
      $html .= __('This post have:', 'wcp-plugin') . ' ' . $wordCount . ' ' . __('words', 'wcp-plugin') . '.<br />';
    }

    if (get_option('wcp_character_count', '1') == '1') {
      $html .= 'Ten post ma: ' . strlen(strip_tags($content)) . ' znaków.<br />';
    }

    if (get_option('wcp_read_time', '1') == '1') {
      $html .= 'Czas czytania tego postu to: ' . round($wordCount / 225) . ' minut(a).<br />';
    }

    $html .= '</p>';

    if (get_option('wcp_location', '0') == '0') {
      return $html . $content;
    }
    return $content . $html;
  }

  function settings()
  {
    /* Dodanie sekcji, która będzie wyświetlać dodane i zarejestrowane pole */
    add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');


    /* Pole - Display location - 2 ponizsze pola */
    /* Dodanie pola ustawień HTML*/
    add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
    /* Rejestracja pola w bazie danych */
    register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => 'sanitizeLocation', 'default' => '0'));

    /* Pole - Headline - 2 ponizsze pola */
    /* Dodanie pola ustawień HTML*/
    add_settings_field(
      'wcp_headline',
      'Headline Text',
      array($this, 'headlineHTML'),
      'word-count-settings-page',
      'wcp_first_section',
    );
    /* Rejestracja pola w bazie danych */
    register_setting(
      'wordcountplugin',
      'wcp_headline',
      array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'Post Statistics',
      )
    );

    /* Pole - WordCount - 2 ponizsze pola */
    /* Dodanie pola ustawień HTML*/
    add_settings_field(
      'wcp_wordcount',
      'Word Count',
      array($this, 'checkboxHTML'),
      'word-count-settings-page',
      'wcp_first_section',
      array('theName' => 'wcp_wordcount'),
    );
    /* Rejestracja pola w bazie danych */
    register_setting(
      'wordcountplugin',
      'wcp_wordcount',
      array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '1',
      )
    );

    /* Oczyszczanie pola - Location */
    function sanitizeLocation($input)
    {
      if ($input != '0' and $input != '1') {
        add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end.');
        return get_option('wcp_location');
      }
      return $input;
    }

    /* Pole - Character Count - 2 ponizsze pola */
    /* Dodanie pola ustawień HTML*/
    add_settings_field(
      'wcp_character_count',
      'Character Count',
      array($this, 'checkboxHTML'),
      'word-count-settings-page',
      'wcp_first_section',
      array('theName' => 'wcp_character_count'),
    );
    /* Rejestracja pola w bazie danych */
    register_setting(
      'wordcountplugin',
      'wcp_character_count',
      array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '1',
      )
    );

    /* Pole - Read Time - 2 ponizsze pola */
    /* Dodanie pola ustawień HTML*/
    add_settings_field(
      'wcp_read_time',
      'Read Time',
      array($this, 'checkboxHTML'),
      'word-count-settings-page',
      'wcp_first_section',
      array('theName' => 'wcp_read_time'),
    );
    /* Rejestracja pola w bazie danych */
    register_setting(
      'wordcountplugin',
      'wcp_read_time',
      array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '1',
      )
    );
  }

  function checkboxHTML($args)
  { ?>
    <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1'); ?>>
  <?php }

  /*
  function readTimeHTML()
  { ?>
    <input type="checkbox" name="wcp_read_time" value="1" <?php checked(get_option('wcp_read_time'), '1'); ?>>
  <?php }

  function characterCountHTML()
  { ?>
    <input type="checkbox" name="wcp_character_count" value="1" <?php checked(get_option('wcp_character_count'), '1'); ?>>
  <?php }

  function wordCountHTML()
  { ?>
    <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1'); ?>>
  <?php }
  */

  function headlineHTML()
  { ?>
    <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')); ?>">
  <?php }

  /* Funkcja dodająca HTML do pola ustawień - location */
  function locationHTML()
  {
  ?>
    <select name="wcp_location">
      <option value="0" <?php selected(get_option('wcp_location'), '0'); ?>>Beginning of post</option>
      <option value="1" <?php selected(get_option('wcp_location'), '1'); ?>>End of post</option>
    </select>
  <?php
  }

  function adminLinkPage()
  {
    add_options_page('Word Count Settings', __('Word Count', 'wcp-plugin'), 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
  }

  /* Ogólne opakowanie całej strony */
  function ourHTML()
  { ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
      <form action="options.php" method="POST">
        <?php
        /* Dodajemy to ustawienie by nie było błędu serjalizacji
        jest to wskazanie grupy pól rejestrowanych w DB
        */
        settings_fields('wordcountplugin');
        /* Wywietlenie wszystkich powiązanych sekcji z daną stroną */
        do_settings_sections('word-count-settings-page');
        submit_button();
        ?>
      </form>
    </div>
<?php
  }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();
