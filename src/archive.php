<?php get_header(); ?>
<div class="wrapper">
    <?php
    // アーカイブするカスタム投稿のスラッグ名を取得する
    $post_name = get_query_var('post_type');
    // カスタム投稿に応じたテンプレートを出力する
    get_template_part('templates/archive/archive', $post_name);
    ?>
</div>

<?php get_footer(); ?>