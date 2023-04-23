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
    /* Globalna zmienna do uzyskania m.in prefiksu tabeli w DB danej instalacji WordPress */
    global $wpdb;
    /* Pobieranie sortowania znaków w bazie danych */
    $this->charset = $wpdb->get_charset_collate();
    /* Uzyskanie aktualnego prefixu tabel */
    $this->tablename = $wpdb->prefix . "cooks";

    add_action('activate_random-cookers/random-cookers.php', array($this, 'onActivate'));
    /* Aktywować, gdy chcemy kolejnych randomowych kucharzy do listy */
    // add_action('admin_head', array($this, 'populateFast'));
    add_action('admin_post_createcook', array($this, 'createCook'));
    /* To zabezpieczych danych hook by był obsłużony tylko dla administrator */
    add_action('admin_post_nopriv_createcook', array($this, 'createCook'));

    /* Deleted cooker */

    add_action('admin_post_deletecook', array($this, 'deleteCook'));
    /* To zabezpieczych danych hook by był obsłużony tylko dla administrator */
    add_action('admin_post_nopriv_deletecook', array($this, 'deleteCook'));

    add_action('wp_enqueue_scripts', array($this, 'loadAssets'));
    add_filter('template_include', array($this, 'loadTemplate'), 99);
  }

  /* Funkcja odpowiadająca za usunięcie kucharza z listy */
  function deleteCook()
  {
    if (current_user_can('administrator')) {
      $id = sanitize_text_field($_POST['idtodelete']);
      global $wpdb;
      $wpdb->delete($this->tablename, array('id' => $id));
      wp_safe_redirect(site_url('/random-cookers'));
    } else {
      /* Jeśli to nie admin robimy redirect do strony głównej */
      wp_safe_redirect(site_url());
    }
    exit;
  }

  /* Funkcja odpowiadająca za stworzenie kucharz po stroni admina */
  function createCook()
  {
    if (current_user_can('administrator')) {
      $cook = generateCooks();
      $cook['cookname'] = sanitize_text_field($_POST['incomingcookname']);
      global $wpdb;
      $wpdb->insert($this->tablename, $cook);
      wp_safe_redirect(site_url('/random-cookers'));
    } else {
      /* Jeśli to nie admin robimy redirect do stronyg głównej */
      wp_safe_redirect(site_url());
    }
    /* Gdy używamy bezpiecznej metody  przekierowania - wp_safe_redirect, dobrą praktyką jest użycie - exit; */
    exit;
  }

  function onActivate()
  {
    /* Access do utworzenie zmian w DB, który musi mieć funkcja dbDelta */
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    /* Funkcja modyfikująca bazę danych na podstawie określonych instrukcji SQL */
    dbDelta("CREATE TABLE $this->tablename (
      /* Teraz tworzymy kolumny tabeli */
      id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      birthyear smallint(5) NOT NULL DEFAULT 0,
      cookweight smallint(5) NOT NULL DEFAULT 0,
      favfood varchar(60) NOT NULL DEFAULT '',
      favhobby varchar(60) NOT NULL DEFAULT '',
      cookname varchar(60) NOT NULL DEFAULT '',
      PRIMARY KEY  (id)
    ) $this->charset;");
  }

  function onAdminRefresh()
  {
    /* Testowa struktura, która będzie dodawać nowe dane do tabeli po refreshu strony admina */
    // global $wpdb;
    // $wpdb->insert($this->tablename, generateCooks());
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

    $numberofcookers = 10000;
    $cook = generateCooks();
    for ($i = 0; $i < $numberofcookers; $i++) {
      $cook = generateCooks();
      $query .= "({$cook['birthyear']}, {$cook['cookweight']}, '{$cook['favfood']}', '{$cook['favhobby']}', '{$cook['cookname']}' )";
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
