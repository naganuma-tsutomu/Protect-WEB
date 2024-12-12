<?php
// ----------------------------------------------------------------------------- css、jquery読み込み
add_action('wp_enqueue_scripts', function () {

  // WordPress 本体の jQuery を登録解除
  wp_deregister_script('jquery');

  // jQueryを読み込む
  wp_enqueue_script('jquery', get_theme_file_uri('/assets/js/lib/jquery-3.6.0.min.js'), array(), '3.6.0', true);

  wp_enqueue_script('global', get_theme_file_uri('/assets/js/common.js'), array(), null, true);
  wp_enqueue_style('main-style', get_theme_file_uri('/assets/css/style.css'), array(), null, 'all');
});