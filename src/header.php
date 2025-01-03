<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <!-- <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache"> -->

    <?php /* ios 入力欄タップ時に画面がズームされないようにする記述  始め */ ?>
    <script>
        var ua = navigator.userAgent.toLowerCase();
        var isiOS = (ua.indexOf('iphone') > -1) || (ua.indexOf('ipad') > -1);
        if (isiOS) {
            var viewport = document.querySelector('meta[name="viewport"]');
            if (viewport) {
                var viewportContent = viewport.getAttribute('content');
                viewport.setAttribute('content', viewportContent + ', user-scalable=no');
            }
        }
    </script>
    <?php /* ios 入力欄タップ時に画面がズームされないようにする記述  終わり */ ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>">
    <header>
        <div class="title">
            <div class="title__bg">
                <h1 class="title-text"><?php the_title(); ?></h1>
            </div>
        </div>
    </header>
    <main class="main">