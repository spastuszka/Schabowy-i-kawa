<?php

/*
  Plugin Name: Cookers Random Generator (New DB Table)
  Version: 1.0
  Author: Sebastian Pastuszka
  Author URI: https://www.linkedin.com/in/sebastian-pastuszka/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly
require_once plugin_dir_path(__FILE__) . 'inc/generateCookers.php';

class CookersRandomTablePlugin
{
  function __construct()
  {
    add_action('activate_random-cookers/random-cookers.php', array($this, 'onActivate'));
    add_action('admin_head', array($this, 'onAdminRefresh'));
    add_action('wp_enqueue_scripts', array($this, 'loadAssets'));
    add_filter('template_include', array($this, 'loadTemplate'), 99);
  }

  function onActivate()
  {
    /* Access do utworzenie zmian w DB, który musi mieć funkcja dbDelta */
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    /* Funkcja modyfikująca bazę danych na podstawie określonych instrukcji SQL */
    dbDelta("CREATE TABLE cooks (
      /* Teraz tworzymy kolumny tabeli */
      id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      birthyear smallint(5) NOT NULL DEFAULT 0,
      cookweight smallint(5) NOT NULL DEFAULT 0,
      favfood varchar(60) NOT NULL DEFAULT '',
      favhobby varchar(60) NOT NULL DEFAULT '',
      cookname varchar(60) NOT NULL DEFAULT '',
      PRIMARY KEY  (id)
    )");
  }

  function onAdminRefresh()
  {
  }

  function loadAssets()
  {
    if (is_page('random-cookers')) {
      wp_enqueue_style('randomcookerscss', plugin_dir_url(__FILE__) . 'random-cookers.css');
    }
  }

  function loadTemplate($template)
  {
    if (is_page('random-cookers')) {
      return plugin_dir_path(__FILE__) . 'inc/template-cooks.php';
    }
    return $template;
  }

  function populateFast()
  {
    $query = "INSERT INTO $this->tablename (`birthyear`, `cookweight`, `favfood`, `favhobby`, `cookname`) VALUES ";
    $numberofcookers = 100000;
    for ($i = 0; $i < $numberofcookers; $i++) {
      $cook = generatePet();
      $query .= "('{$cook['birthyear']}, {$cook['cookweight']}, '{$cook['favfood']}', '{$cook['favhobby']}', '{$cook['cookname']}')";
      if ($i != $numberofcookers - 1) {
        $query .= ", ";
      }
    }
    /*
    Never use query directly like this without using $wpdb->prepare in the
    real world. I'm only using it this way here because the values I'm 
    inserting are coming fromy my innocent pet generator function so I
    know they are not malicious, and I simply want this example script
    to execute as quickly as possible and not use too much memory.
    */
    global $wpdb;
    $wpdb->query($query);
  }
}

$cookersRandomTablePlugin = new CookersRandomTablePlugin();
