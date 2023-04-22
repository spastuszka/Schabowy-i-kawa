<?php

/* Przeniesienie tworzenia zapytań SQL do osobnego pliku */
require_once plugin_dir_path(__FILE__) . '/GetCooksSQL.php';
$getCooksSQL = new GetCooksSQL();

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

  <p>This page took <strong><?php echo timer_stop(); ?></strong> seconds to prepare. Found <strong><?php echo number_format($getCooksSQL->count); ?></strong> results (showing the first <?php echo count($getCooksSQL->cooks); ?>).</p>


  <table class="cook-adoption-table">
    <tr>
      <th>Name</th>
      <th>Weight</th>
      <th>Birth Year</th>
      <th>Hobby</th>
      <th>Favorite Food</th>
      <?php
      if (current_user_can('administrator')) { ?>
        <th>Delete</th>
      <?php
      }
      ?>
    </tr>
    <?php
    /* Wydrukowanie wszystkich wyników z DB */
    foreach ($getCooksSQL->cooks as $cook) { ?>
      <tr>
        <td><?php echo $cook->cookname; ?></td>
        <td><?php echo $cook->cookweight; ?></td>
        <td><?php echo $cook->birthyear; ?></td>
        <td><?php echo $cook->favhobby; ?></td>
        <td><?php echo $cook->favfood; ?></td>
        <?php
        if (current_user_can('administrator')) { ?>
          <td style="text-align: center;">
            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
              <input type="hidden" name="action" value="deletecook">
              <input type="hidden" name="idtodelete" value="<?php echo $cook->id; ?>">
              <button class="delete-cook-button">X</button>
            </form>
          </td>
        <?php
        }
        ?>
      </tr>
    <?php }
    ?>

  </table>

  <!-- Formularz dodawania kucharzy do listy -->
  <?php
  if (current_user_can('administrator')) { ?>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="create-cook-form" method="POST">
      <p>Enter the name for the new cooker.</p>
      <!-- Do tego ukrytego pola podłączoamy się aby po stronie admina publikować rzeczy -->
      <input type="hidden" name="action" value="createcook">
      <input type="text" name="incomingcookname" placeholder="name...">
      <button type="submit">Add cooker</button>
    </form>
  <?php
  }
  ?>
</div>

<?php get_footer(); ?>