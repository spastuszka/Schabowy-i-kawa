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

      $this->args = $this->getArgs();

      /* Podstawowe zahardkodowanie początku zapytania oraz połączenie całego zapytania dynamicznego z trzech części*/
      $query = "SELECT * FROM $tablename ";
      /* Tu będzie metoa przeszukująca odpowiednie kolumny */
      $query .= $this->createWhereText();
      $query .= " LIMIT 100";

      $this->cooks = $wpdb->get_results($wpdb->prepare($query, $this->args));
    }

    /* Funkcja przekazaująca odpowiednie argumenty w zależności, czy dany warunek zgodzi się z przekazanymi kluczami w url */
    function getArgs()
    {
      $temp = [];

      if (isset($_GET['cookname'])) $temp['cookname'] = sanitize_text_field($_GET['cookname']);
      if (isset($_GET['favhobby'])) $temp['favhobby'] = sanitize_text_field($_GET['favhobby']);
      if (isset($_GET['favfood'])) $temp['favfood'] = sanitize_text_field($_GET['favfood']);
      if (isset($_GET['minyear'])) $temp['minyear'] = sanitize_text_field($_GET['minyear']);
      if (isset($_GET['maxyear'])) $temp['maxyear'] = sanitize_text_field($_GET['maxyear']);
      if (isset($_GET['minweight'])) $temp['minweight'] = sanitize_text_field($_GET['minweight']);
      if (isset($_GET['maxweight'])) $temp['maxweight'] = sanitize_text_field($_GET['maxweight']);

      return $temp;
    }

    /* Funkcja, które mówi gdzie szukać w zależności jaki klucz będzie przedstawiony */
    function createWhereText()
    {
      $whereQuery = "";

      if (count((is_countable($this->args) ? $this->args : []))) {
        $whereQuery = "WHERE ";
      }

      /* Wyciąganie nazw kluczy, które zostaną znaleziony np. birthyear etc. */

      $currentPosition = 0;

      if (is_array($this->args) || is_object($this->args)) {
        foreach ($this->args as $index => $item) {
          $whereQuery .= $this->specificQuery($index);
          if ($currentPosition != count($this->args) - 1) {
            $whereQuery .= " AND ";
          }
          $currentPosition++;
        }
        return $whereQuery;
      }
    }


    /* Funkcja, która będzie decydować, czy przekazywana będzie liczba, czy string zgodnie z $wpdb->prepare() */
    function specificQuery($index)
    {
      switch ($index) {
        case "minweight":
          return "cookweight >= %d";
        case "maxweight":
          return "cookweight <= %d";
        case "minyear":
          return "birthyear >= %d";
        case "maxyear":
          return "birthyear <= %d";
        default:
          return $index . " = %s";
      }
    }
  }
