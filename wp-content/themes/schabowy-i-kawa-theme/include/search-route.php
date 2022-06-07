<?php

function cookerRegSearch(){
  register_rest_route('cookers/v1','search',array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'cookingSearchResults'
  ));
}

add_action('rest_api_init','cookerRegSearch');

function cookingSearchResults(){
  return 'Created Test Route';
}