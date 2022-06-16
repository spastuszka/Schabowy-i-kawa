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
    'post_type' => array('post','page','cooker','recipe'),
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

    //pushowanie do odpowiedniej tablicy w glownej tablicy rezultatow
    if(get_post_type() == 'post'){
      array_push($searchQueryResults['postInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));
    }

    if(get_post_type() == 'page'){
      array_push($searchQueryResults['pageInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));
    }

    if(get_post_type() == 'cooker'){
      array_push($searchQueryResults['cookerInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'id' => get_the_ID(),
      ));
    }

    if(get_post_type() == 'recipe'){
      array_push($searchQueryResults['recipeInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));
    }
    
  }

  $cookerMetaQuery = array('relation' => 'OR');

  foreach($searchQueryResults['cookerInfo'] as $item){
    array_push($cookerMetaQuery,array(
      'key' => 'related_cookers',
      'compare' => 'LIKE',
      'value' => '"'. $item['id'] .'"',
      ));
  }

  $cookerRelationships = new WP_Query(array(
    'post_type' => 'recipe',
    'meta_query' => $cookerMetaQuery,
    ));

    while($cookerRelationships -> have_posts()){
      $cookerRelationships->the_post();
      if(get_post_type() == 'recipe'){
        array_push($searchQueryResults['recipeInfo'],array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
        ));
      }
    }

    $searchQueryResults['recipeInfo'] = array_unique($searchQueryResults['recipeInfo'],SORT_REGULAR);

  return $searchQueryResults;
}