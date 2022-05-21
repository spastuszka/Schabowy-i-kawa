<?php get_header();
pageBanner(array(
  'title' => 'Nasze przepisy',
  'subtitle' => '',
  'photo' => '',
))
?>

<div class="container container--narrow page-section blog-flex-container">
  <?php while (have_posts()) {
    the_post(); ?>
    <div class="recipe-summary__item">
      <?php get_template_part('template-parts/recipe', 'summary'); ?>
      <div class="generic-content generic-content--recipe_excerpt">
        <?php if (has_excerpt()) {
          echo get_the_excerpt();
        } else {
          echo wp_trim_words(get_the_content(), 18);
        }
        ?>
        <p class="recipe-summary__item--button"> <a class="btn btn--dark-red" href="<?php the_permalink(); ?>">Więcej</a></p>
      </div>
    </div>

  <?php }  ?>
</div>
<div class="container container--narrow"><?php echo paginate_links(); ?> </div>

<?php get_footer(); ?>