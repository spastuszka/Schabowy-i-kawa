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
    <div class="event-summary__content">
      <h5 class="event-summary__title headline headline--tiny t-left t-dark"><a href="#">Przepis 1</a></h5>
      <p class="t-left t-dark">Krótki opis do przepisu <a href="#" class="nu gray">Zobacz więcej</a></p>
    </div>
  </div>

  <p class="t-center  no-margin"><a href="#" class="btn btn--dark-outline">Wszystkie z tej kategorii</a></p>
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

  <div class="recipe-summary">
    <div class="event-summary__content">
      <h5 class="event-summary__title headline headline--tiny t-left t-dark"><a href="#">Porada 1</a></h5>
      <p class="t-left t-dark">Krótki opis do przepisu <a href="#" class="nu gray">Więcej</a></p>
    </div>
  </div>

  <p class="t-center  no-margin"><a href="#" class="btn btn--dark-outline">Wszystkie z tej kategorii</a></p>
</div>

<?php get_footer(); ?>