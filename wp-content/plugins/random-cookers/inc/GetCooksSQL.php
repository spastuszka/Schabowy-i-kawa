 
 <?php

  class GetCooksSQL
  {
    function __construct()
    {
      /* Przykładowe wyciąganie danych z bazy danych z customowej tabeli */
      global $wpdb;
      /* Utworzenie prefiksu dynamicznego dla customowej tabeli */
      $tablename = $wpdb->prefix . 'cooks';
      /* Utworzenie dynamicznego zapytania przeszukującego tabelę związaną z daną kolumną względem danej wartości */
      $ourQuery = $wpdb->prepare("SELECT * from $tablename WHERE cookname = %s LIMIT 100", array($_GET['cookname']));
      $this->cooks = $wpdb->get_results($ourQuery);
    }
  }
