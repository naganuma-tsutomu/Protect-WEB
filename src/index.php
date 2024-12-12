<!DOCTYPE html>
<html lang="ja">
  <?php wp_head() ?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo get_bloginfo( 'name' ); ?></title>
  </head>
  <body>
      <div id="app">
        <p>

        </p>
      </div>
  </body>

  <?php wp_footer() ?>
</html>
<?php get_header(); ?>
<div class="top">
  <h1 class="top__title">Wordpress-BaseTheme</h1>
  <a class="top__admin" href="/wp-admin">管理画面</a>
  <img class="top__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/WordPress.png" alt="">
</div>
<?php get_footer(); ?>