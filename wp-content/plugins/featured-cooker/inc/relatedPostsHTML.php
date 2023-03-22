<?php

/* To jest funkcja generująca html zwrotną powiązanych skróconych info w postach z wizytówką kucharza */
function relatedPostsHTML($id)
{
  $relationAboutThisCook = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'post',
    'meta_query' => array(
      /* Ile zapytań, tyle tablicy osobnych w tej tablicy głównej meta query*/
      /* Pytamy tutaj o postmeta dane, które generowaliśmy,a teraz je pobieramy per kazdy kucharz */
      array(
        'key' => 'featurecooker',
        'compare' => '=',
        'value' => $id
      )
    )
  ));

  ob_start();

  if ($relationAboutThisCook->found_posts) { ?>
    <p>Z <?php the_title(); ?> powiązane są:</p>
    <ul>
      <?php
      while ($relationAboutThisCook->have_posts()) {
        $relationAboutThisCook->the_post(); ?>
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      <?php
      }
      ?>
    </ul>
<?php
  }

  wp_reset_postdata();
  return ob_get_clean();
}
