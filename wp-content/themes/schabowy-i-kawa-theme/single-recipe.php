<?php get_header();


while (have_posts()) {
  the_post();
  pageBanner(array(
    'title' => ' ',
    'subtitle' => '',
    'photo' => '',
  ));
?>

  <div class="container container--narrow page-section">
    <div class="recipe-content">
      <div class="recipe-gallery">
        <?php the_post_thumbnail('single-post-thumbnail');
        ?>
      </div>
      <div class="recipe_intro">
        <div class="intro_wrapper">
          <div class="recipe_author">
            <div class="name_wrapper">
              <?php
              $relatedCooker = get_field('related_cookers');
              if ($relatedCooker) :
                foreach ($relatedCooker as $cook) { ?>
                  <a href="<?php echo get_the_permalink($cook); ?>"><?php echo get_the_title($cook); ?></a>
              <?php }
                wp_reset_postdata();
              endif; ?>
            </div>
          </div>
          <div class="recipe_name">
            <h2><?php the_title(); ?></h2>
          </div>
          <div class="recipe_options">
            <div class="like_recipe">
              <p>Polub przepis:</p>
              <img class="icon black_heart_icon_svg" src="<?php echo get_theme_file_uri('/images/serce_black.svg'); ?>" alt="Ilość lajków od zarejestrowanych i niezarejestrowanych w serwisie użytkowników" />
              <p>0</p>
            </div>
          </div>
          <div class="recipe_info">
            <div class="preparation_time">
              <span class="timer_black_icon_svg fluid"></span>
              <p>
                <span>Czas przygotowania:<br /></span>
                <strong><?php echo get_field('cooking_time') . ' min'; ?></strong>
              </p>
            </div>
            <div class="preparation_time">
              <span class="portions_amount_black_icon_svg fluid"></span>
              <p>
                <span>Ilość porcji:<br /></span>
                <strong><?php echo get_field('portions_amount'); ?></strong>
              </p>
            </div>
          </div>
          <div class="recipe_text">
            <?php the_field('body_content'); ?>
          </div>
        </div>
      </div>

    </div>
    <article class="recipe_main_description">
      <div class="recipe_main_description--inner">
        <div class="recipe_ingredients">
          <div class="recipe_ingredients--inner">
            <div class="ingredients_title">
              <h2>SKŁADNIKI</h2>
            </div>
            <div class="ingredients_group">
              <?php
              //check if flexible content exists
              if (have_rows('recipe_section_ingredients')) :
                // loop flexible content
                while (have_rows('recipe_section_ingredients')) : the_row();
                  // check current layout exists
                  if (get_row_layout() == 'recipe_ingredients_all') :
              ?>
                    <!-- Check if first sub field exists about title -->
                    <h2><?php the_sub_field('recipe_ingredients_title'); ?></h2>
                    <?php
                    // check if the nested repeater field has rows of data
                    if (have_rows('recipe_ingredients')) :
                      echo '<ul class="ingredients_list">';
                      // loop through the rows of data
                      while (have_rows('recipe_ingredients')) : the_row();
                    ?>
                        <li>
                          <p><?php the_sub_field('ingredient_name'); ?></p>
                          <span class="bold"><?php the_sub_field('ingredient_value'); ?>
                            <?php the_sub_field('ingredient_unit'); ?></span>
                  <?php
                      endwhile;
                      echo '</ul>';
                    endif;
                  endif;
                endwhile;
              else :
                  ?>
                  <p>Żadne składniki nie zostały wskazane</p>
                <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="recipe-description">
          <h2 class="recipe-decription__title">Przepis i sposób przygotowania</h2>
          <div class="recipe-decription__content">
            <?php if (have_rows('recipe_description_content')) : ?>
              <?php while (have_rows('recipe_description_content')) : the_row(); ?>
                <h3><?php the_sub_field('recipe_description_part_title'); ?></h3>
                <p><?php the_sub_field('recipe_description_content'); ?></p>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </article>
  </div>
<?php }
get_footer(); ?>