<div class="recipe-summary__item--inner">
  <div class="recipe-summary__item--wrapper">
    <a href="<?php the_permalink(); ?>" class="img_wrapper">
    <?php if (has_post_thumbnail()) {
          the_post_thumbnail('postImg');
        } else {
        ?>
          <?php echo wp_get_attachment_image(134, 'postImg'); ?>
        <?php
        }
        ?>
    </a>
  </div>
  <div class="recipe-summary__item--description">
    <div class="rec">
      <h4 class="item__title t-dark no-margin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    </div>
    <div class="item__stats">
      <span class="stats__duration">
        <span class="stats__duration--clock"></span>
        <span class="stats__duration--text t-dark"><?php echo get_field('cooking_time') . ' min'; ?></span>
      </span>
      <span class="stats__difficulty">
        <span class="stats__difficulty--icon"></span>
        <span class="stats__difficulty--text t-dark"><?php the_field('recipe_difficulty_level'); ?></span>
      </span>
    </div>
  </div>
</div>