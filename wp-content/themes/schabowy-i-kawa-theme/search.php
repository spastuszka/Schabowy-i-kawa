<?php get_header();
pageBanner(array(
  'title' => 'Wyniki wyszukiwania',
  'subtitle' => 'Włanie wyszukujesz &ldquo;'. esc_html(get_search_query()) .'&rdquo;',
  'photo' => '',
));
?>

<div class="container container--narrow page-section blog-flex-container">
  <?php if(have_posts()){
while (have_posts()) {
  the_post(); ?>
  <div class="post-item">
    <a href="#" class="img_wrapper">
      <picture>
        <source type="image/webp" srcset="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.webp" data-srcset="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.webp" class="" media="(min-width: 400px)">
        <img alt="Sałatka z zupek chińskich foto" class="lazy loaded" src="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.jpg" data-src="https://pliki.doradcasmaku.pl/salatka-z-zupek-chinskich91-3.jpg" data-was-processed="true">
      </picture>
    </a>
    <h2 class="headline headline--small headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="generic-content">
      <p class="t-center"><a class="btn btn--dark-red" href="<?php the_permalink(); ?>">Więcej</a></p>
    </div>
  </div>

<?php } echo paginate_links();
  } else {
    echo '<h2 class="headline headline--small-plus">Brak wyników wyszukiwania zgodnych z Twoją frazą.</h2>';
  }
  ?>
</div>
<div class="container container--narrow"><?php echo paginate_links(); ?> </div>

<?php get_footer(); ?>