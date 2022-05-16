<?php get_header();
pageBanner(array(
  'title' => 'Nasi kucharze',
  'subtitle' => '',
  'photo' => '',
));
?>


<div class="container container--narrow page-section">
  <section class="cookers">
    <div class="cookers_inner">
      <div class="users_list">
        <div class="users_list_inner">
          <?php while (have_posts()) {
            the_post(); ?>
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
                  <div>
                    <button onclick="location.href='<?php the_permalink(); ?>'" type=" button" class="generic_red_button small">
                      <span>Więcej</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          <?php }  ?>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="container container--narrow"><?php echo paginate_links(); ?> </div>

<?php get_footer(); ?>