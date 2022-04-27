<?php get_header();


while (have_posts()) {
  the_post(); ?>



  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro c-white">
        <p>DO ZROBIENIA PÓŹNIEJ</p>
      </div>
    </div>
  </div>



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
      </div>
    </div>
  </div>
<?php }
get_footer(); ?>