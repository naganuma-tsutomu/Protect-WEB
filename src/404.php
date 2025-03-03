<?php get_header(); ?>

<div class="container">
  <div id="notfound" class="notfound">
    <div class="notfound__text">
      ご指定のページは見つかりませんでした。<br>
      一時的にアクセスできない状況にあるか、移動、もしくは削除された可能性があります。<br>
    </div>
    <div class="notfound__top">
      <a href="<?php echo esc_url(home_url()); ?>">
        <div class="notfound__top_text">トップページに戻る</div>
      </a>
    </div>
  </div>
</div>

<?php get_footer(); ?>