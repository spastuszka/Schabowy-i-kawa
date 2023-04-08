 <?php

  /* Utworzenie dynamicznego zapytania przeszukującego tabelę związaną z daną kolumną względem danej wartości */
  class GetCooksSQL
  {
    function __construct()
    {
      /* Przykładowe wyciąganie danych z bazy danych z customowej tabeli */
      global $wpdb;
      /* Utworzenie prefiksu dynamicznego dla customowej tabeli */
      $tablename = $wpdb->prefix . 'cooks';

      /* Podstawowe zahardkodowanie początku zapytania oraz połączenie całego zapytania dynamicznego z trzech części*/
      $query = "SELECT * FROM $tablename ";
      /* Tu będzie metoa przeszukująca odpowiednie kolumny */
      $query .= $this->createWhereText();
      $query .= " LIMIT 100";

      $this->args = $this->getArgs();

      $this->cooks = $wpdb->get_results($wpdb->prepare($query, $this->args));
    }
  }

  /* Funkcja przekazaująca odpowiednie argumenty w zależności, czy dany warunek zgodzi się z przekazanymi kluczami w url */
  function getArgs()
  {
    $temp = [];

    if (isset($_GET['cookname'])) $temp['cookname'] = sanitize_text_field($_GET['cookname']);
    if (isset($_GET['cookweight'])) $temp['cookweight'] = sanitize_text_field($_GET['cookweight']);
    if (isset($_GET['favhobby'])) $temp['favhobby'] = sanitize_text_field($_GET['favhobby']);
    if (isset($_GET['favfood'])) $temp['favfood'] = sanitize_text_field($_GET['favfood']);
    if (isset($_GET['birthyear'])) $temp['birthyear'] = sanitize_text_field($_GET['favfood']);

    return $temp;
  }
