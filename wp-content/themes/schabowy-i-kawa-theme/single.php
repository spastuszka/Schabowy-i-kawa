<?php get_header();


while (have_posts()) {
  the_post();
  pageBanner(array(
    'title' => get_the_title(),
    'subtitle' => '',
    'photo' => '',
  ));
?>

  <div class="container container--narrow page-section">
    <div class="generic-content">
      <?php the_content(); ?>
    </div>
  </div>
<?php }
get_footer(); ?>