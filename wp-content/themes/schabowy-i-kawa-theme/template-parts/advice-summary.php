<div class="advice-summary__item">
  <div class="advice-summary__item--inner">
    <div class="advice-summary__item--wrapper">
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
    <div class="advice-summary__item--description">
      <div class="rec">
        <h4 class="item__title t-dark no-margin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      </div>
    </div>
  </div>
</div>