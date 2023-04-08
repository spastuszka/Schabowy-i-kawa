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

      /* W razie braków danych, tutaj będzie metoda, która pozwoli na przedtsaiwenie stosownych informacji */
      $this->placeholders = $this->createPlaceholders();

      $this->cooks = $wpdb->get_results($wpdb->prepare($query, $this->placeholders));
    }
  }
