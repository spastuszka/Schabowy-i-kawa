<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/cooking.jpg') ?>)"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">Witam!</h1>
    <h2 class="headline headline--medium">Dziękuję za obejrzenie mojej strony.</h2>
    <h3 class="headline headline--small">Może znajdziesz tutaj przepis idealny dla <strong>siebie</strong>?</h3>
    <a href="#" class="btn btn--large btn--pink push-right">Pomysły na śniadania</a>
    <a href="https://www.linkedin.com/in/sebastian-pastuszka/" class="btn btn--large btn--dark-red" target="_blank">LinkedIn</a>
  </div>
</div>

<div class="full-width-split group">
  <h2 class="headline headline--large-medium t-left t-dark">Polecane przepisy</h2>

  <div class="recipe-summary">

    <?php

    $homepageRecipes = new WP_Query(array(
      'posts_per_page' => 3,
      'post_type' => 'recipe',
      'meta_key' => 'recipe_difficulty_level',
      'orderby' => 'meta_value',
      'order' => 'ASC',
    ));

    while ($homepageRecipes->have_posts()) {
      $homepageRecipes->the_post(); ?>
      <div class="recipe-summary__item">
        <?php get_template_part('template-parts/recipe', 'summary'); ?>
      </div>
    <?php }
    wp_reset_postdata();
    ?>
  </div>

  <p class="t-center  no-margin"><a href="<?php echo get_post_type_archive_link('recipe'); ?>" class="btn btn--dark-outline">Wszystkie z tej kategorii</a></p>
</div>
<div class="promo-section">
  <a href="#">
    <div class="promo-section__bg">
      <div class="promo-section__content promo-section--overlay">
        <h2>Pasta z pomysłem na...</h2>
        <p>Kliknij i sprawdź go!</p>
      </div>
    </div>
  </a>
</div>

<div class="full-width-split group">
  <h2 class="headline headline--large-medium t-left t-dark">Porady i inspiracje</h2>
  <div class="advice-summary">
    <?php

    $homepageTipsAndInspirations = new WP_Query(array(
      'posts_per_page' => 3,
    ));

    while ($homepageTipsAndInspirations->have_posts()) {
      $homepageTipsAndInspirations->the_post();
      get_template_part('template-parts/advice', 'summary');
    }
    wp_reset_postdata();
    ?>

  </div>

  <p class="t-center  no-margin"><a href="<?php echo site_url('/porady'); ?>" class="btn btn--dark-outline">Wszystkie z tej kategorii</a></p>
</div>

<?php get_footer(); ?>