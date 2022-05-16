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
      <div class="recipe-summary__item--inner">
        <div class="recipe-summary__item--wrapper">
          <a href="<?php the_permalink(); ?>" class="img_wrapper">
            <picture>
              <source type="image/webp" srcset="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.webp" data-srcset="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.webp" class="" media="(min-width: 400px)">
              <img alt="Sałatka z zupek chińskich foto" class="lazy loaded" src="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.jpg" data-src="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.jpg" data-was-processed="true">
            </picture>
          </a>
        </div>
        <div class="recipe-summary__item--description">
          <div class="rec">
            <h4 class="item__title t-dark no-margin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          </div>
          <div class="item__stats">
            <span class="stats__duration">
              <span class="stats__duration--clock"></span>
              <span class="stats__duration--text t-dark"><?php echo get_field('cooking_time') . ' min'; ?></span>
            </span>
            <span class="stats__difficulty">
              <span class="stats__difficulty--icon"></span>
              <span class="stats__difficulty--text t-dark"><?php the_field('recipe_difficulty_level'); ?></span>
            </span>
          </div>
        </div>
      </div>
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