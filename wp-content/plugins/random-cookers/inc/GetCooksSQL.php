 
 <?php

  class GetCooksSQL
  {
    function __construct()
    {
      /* Przykładowe wyciąganie danych z bazy danych z customowej tabeli */
      global $wpdb;
      /* Utworzenie prefiksu dynamicznego dla customowej tabeli */
      $tablename = $wpdb->prefix . 'cooks';
      /* Utworzenie domyślnego zapytania przeszukującego całą tabelę */
      $ourQuery = $wpdb->prepare("SELECT * from $tablename LIMIT 100");
      $this->cooks = $wpdb->get_results($ourQuery);
    }
  }
