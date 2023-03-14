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

    <div class="cooker-callout">
      <!-- This is a place when wher user see cooker photo -->
      <div class="cooker-callout__photo" style="background-image: url(<?php the_post_thumbnail_url('cookerPortrait') ?>);"></div>
      <!-- This is a description about cooker -->
      <div class="cooker-callout__text">
        <h5><?php the_title(); ?></h5>
        <p><?php echo wp_trim_words(get_the_content(), 30) ?></p>
      </div>
    </div>

<?php
    wp_reset_postdata();
    return ob_get_clean();
  }
}
