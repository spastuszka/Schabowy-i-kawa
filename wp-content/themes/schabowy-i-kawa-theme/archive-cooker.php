<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">
      Nasi kucharze
    </h1>
  </div>
</div>

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
                  <img class="default_avatar_icon" src="<?php echo get_theme_file_uri('/images/default_avatar_black.svg'); ?>" alt="Defaulu">
                </a>
                <div class="user_info">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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