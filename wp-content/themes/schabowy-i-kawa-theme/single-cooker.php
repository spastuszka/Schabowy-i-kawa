<?php get_header();


while (have_posts()) {
  the_post();
  pageBanner();
?>



  <div class="container container--narrow page-section">
    <div class="user_cooker_info">
      <div class="user_promo_card">
        <div class="user_promo_card--inner">
          <a href="<?php the_permalink(); ?>">
            <img class="default_avatar_icon" src="<?php echo get_theme_file_uri('/images/default_avatar_black.svg'); ?>" alt="Default">
          </a>
          <div class="user_info">
            <a class="user_name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <div class="user_profile_statistics">
              <div class="statistics">
                <img class="icon add_recipe_icon_svg" src="<?php echo get_theme_file_uri('/images/ksiazka.svg'); ?>" alt="Liczba przepisów dodanych przez użytkownika" />
                <p>0</p>
              </div>
              <div class="statistics">
                <img class="icon black_heart_icon_svg" src="<?php echo get_theme_file_uri('/images/serce_black.svg'); ?>" alt="Ilość lajków od zarejestrowanych i niezarejestrowanych w serwisie użytkowników" />
                <p>0</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="user_promo_desc">
        <div class="user_promo_desc--inner">
          <?php the_content(); ?>
        </div>
        <div>
          <h3>Przepisy:</h3>
          <?php

          $homepageRecipes = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'recipe',
            'meta_key' => 'recipe_difficulty_level',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'related_cookers',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"',
              )
            )
          ));


          while ($homepageRecipes->have_posts()) {
            $homepageRecipes->the_post(); ?>
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
                    <h4 class="item__title--cooker t-dark no-margin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  </div>
                </div>
              </div>
            </div>
          <?php }
          wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>
  </div>
<?php }
get_footer(); ?>