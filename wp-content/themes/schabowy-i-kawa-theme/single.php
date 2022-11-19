<?php get_header();


while (have_posts()) {
  the_post();
?>

  <div class="container container--narrow">
    <div class="article--header">
      <div class="article--info">
        <p class="article--info__category">
          <?php
          $categories = get_the_category();
          if (!empty($categories)) {
            foreach ($categories as $term) {
              echo esc_html($term->name) . ' ';
            }
          }
          ?>
        </p>
        <p class="article--info__date"><?php the_time('j.m.Y'); ?></p>
      </div>
      <h2 class="article--header__title">
        <?php $postTitle = sanitize_title(the_title());
        echo $postTitle ?>
      </h2>
      <p class="article--header__excerpt">
        <?php
        $value = get_field("post_inner_excerpt");
        if ($value) {
          echo $value;
        } else {
          echo '';
        }
        ?>
      </p>
    </div>
    <div class="article--gallery">
      <?php echo get_the_post_thumbnail($post->ID, 'full');
      ?>
    </div>
    <div class="generic-content article--content">
      <?php the_content(); ?>
    </div>
  </div>
<?php }
get_footer(); ?>