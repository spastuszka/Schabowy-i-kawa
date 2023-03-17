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
    /* Start buffer */
    ob_start(); ?>

    <div class="cooker-callout">
      <!-- This is a place when wher user see cooker photo -->
      <div class="cooker-callout__photo" style="background-image: url(<?php the_post_thumbnail_url('cookerPortrait') ?>);"></div>
      <!-- This is a description about cooker -->
      <div class="cooker-callout__text">
        <h5><?php echo esc_html(get_the_title()); ?></h5>
        <p><?php esc_html_e(wp_trim_words(get_the_content(), 30)); ?></p>
        <p><strong><a href="<?php the_permalink(); ?>">Learn more about <?php the_title(); ?> &raquo;</a></strong></p>
      </div>
    </div>

<?php
    wp_reset_postdata();
    /* End buffer */
    return ob_get_clean();
  }
}
