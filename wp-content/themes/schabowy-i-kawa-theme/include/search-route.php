<?php

function cookerRegSearch(){
  register_rest_route('cookers/v1','search',array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'cookingSearchResults'
  ));
}

add_action('rest_api_init','cookerRegSearch');

function cookingSearchResults($data){
  $cookers = new WP_Query(array(
    'post_type' => 'cooker',
    's' => sanitize_text_field($data['term']),
  ));

  $cookersResults = array();

  while($cookers -> have_posts()){
    $cookers->the_post();
    array_push($cookersResults, array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink(),
    ));
  }

  return $cookersResults;
}