<?php

get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(
      <?php get_theme_file_uri('/images/ocean.jpg')
      ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">Cookers generator</h1>
    <div class="page-banner__intro c-white">
      <p>Tested SQL Plugin Cookers Generator</p>
    </div>
  </div>
</div>

<div class="container container--narrow page-section">

  <p>This page took <strong><?php echo timer_stop(); ?></strong> seconds to prepare. Found <strong>x</strong> results (showing the first x).</p>

  <table class="cook-adoption-table">
    <tr>
      <th>Name</th>
      <th>Weight</th>
      <th>Birth Year</th>
      <th>Hobby</th>
      <th>Favorite Food</th>
    </tr>
    <tr>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
    </tr>
  </table>

</div>

<?php get_footer(); ?>