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
    register_setting(
      'wordcountplugin',
      'wcp_location',
      array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '0',
      )
    );
  }

  function adminLinkPage()
  {
    add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
  }

  function ourHTML()
  { ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
    </div>
<?php
  }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();
