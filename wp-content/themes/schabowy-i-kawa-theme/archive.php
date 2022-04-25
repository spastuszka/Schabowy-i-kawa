<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">
      <?php the_archive_title(); ?>
    </h1>
    <div class="page-banner__intro c-white">
      <p><?php the_archive_description(); ?></p>
    </div>
  </div>
</div>

<div class="container container--narrow page-section blog-flex-container">

  <?php while (have_posts()) {
    the_post(); ?>
    <div class="post-item">
      <a href="#" class="img_wrapper">
        <picture>
          <source type="image/webp" srcset="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.webp" data-srcset="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.webp" class="" media="(min-width: 400px)">
          <img alt="Sałatka z zupek chińskich foto" class="lazy loaded" src="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.jpg" data-src="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.jpg" data-was-processed="true">
        </picture>
      </a>
      <h2 class="headline headline--small headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="metabox">
        <p>Utworzone przez <?php the_author_posts_link(); ?> w dniu <?php the_time('j.m.Y'); ?> w kategorii: <?php echo get_the_category_list(', '); ?></p>
      </div>
      <div class="generic-content">
        <?php the_excerpt(); ?>
        <p><a class="btn btn--dark-red" href="<?php the_permalink(); ?>">Więcej</a></p>
      </div>
    </div>

  <?php }  ?>
</div>
<div class="container container--narrow"><?php echo paginate_links(); ?> </div>

<?php get_footer(); ?>