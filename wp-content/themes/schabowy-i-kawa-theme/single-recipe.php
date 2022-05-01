<?php get_header();


while (have_posts()) {
  the_post(); ?>



  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
    </div>
  </div>

  <div class="container container--narrow page-section">
    <div class="recipe-content">
      <div class="recipe-gallery">
        <?php the_post_thumbnail('single-post-thumbnail'); ?>
      </div>
      <div class="generic-content">
        <?php the_content(); ?>
      </div>
      <?php
      $relatedCooker = get_field('related_cookers');
      if ($relatedCooker) :
        foreach ($relatedCooker as $cook) { ?>
          <li><a href="<?php echo get_the_permalink($cook); ?>"><?php echo get_the_title($cook); ?></a></li>
      <?php }
        wp_reset_postdata();
      endif; ?>
    </div>
  </div>
<?php }
get_footer(); ?>