<?php

/*
  Plugin name: Word Count Plugin
  Description: Plugin counting words, characters and reading time of a single post
  Version: 1.0
  Author: Sebstian Pastuszka
*/

class WordCountAndTimePlugin
{
  function __construct()
  {
    add_action('admin_menu', array($this, 'adminLinkPage'));
    add_action('admin_init', array($this, 'settings'));
  }
  function settings()
  {
    /* Dodanie sekcji, która będzie wyświetlać dodane i zarejestrowane pole */
    add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');


    /* Pole - Display location - 2 ponisze pola */
    /* Dodanie pola ustawień HTML*/
    add_settings_field(
      'wcp_location',
      'Display location',
      array($this, 'locationHTML'),
      'word-count-settings-page',
      'wcp_first_section',
    );
    /* Rejestracja pola w bazie danych */
    register_setting(
      'wordcountplugin',
      'wcp_location',
      array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '0',
      )
    );

    /* Pole - Headline - 2 ponisze pola */
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
  }

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
    add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
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
