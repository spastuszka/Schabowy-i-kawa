<?php

function cookerRegSearch(){
  register_rest_route('cookers/v1','search',array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'cookingSearchResults'
  ));
}

add_action('rest_api_init','cookerRegSearch');

function cookingSearchResults($data){
  $mainQuery = new WP_Query(array(
    'post_type' => array('post','pages','cooker','recipe'),
    's' => sanitize_text_field($data['term']),
  ));

  $searchQueryResults = array(
    'postInfo' => array(),
    'pageInfo' => array(),
    'cookerInfo' => array(),
    'recipeInfo' => array(),
  );

  while($mainQuery -> have_posts()){
    $mainQuery->the_post();
    array_push($searchQueryResults, array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink(),
    ));
  }

  return $searchQueryResults;
}