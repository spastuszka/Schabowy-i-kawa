<?php
/* It is the function that generates the HTML to the user */
function generateCookerHTML($id)
{
  $cookPost = new WP_Query(array(
    'post_type' => 'cooker',
    'p' => $id
  ));

  while ($cookPost->have_posts()) {
    $cookPost->the_post();
    ob_start(); ?>

    <div class="cooker-callout">Test</div>

<?php
    wp_reset_postdata();
    return ob_get_clean();
  }
}
