<?php get_header(); ?>

<?php

// アーカイブするカスタム投稿のスラッグ名を取得する
$post_name = get_query_var('post_type');
// カスタム投稿(個別ページ)に応じたテンプレートを出力する
get_template_part('templates/single/single', $post_name);
?>

<?php get_footer(); ?>