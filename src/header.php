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

    <?php /*スクロールヒント*/ ?>
    <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
    <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            new ScrollHint('.js-scrollable', {
                scrollHintIconAppendClass: 'scroll-hint-icon-white',
                suggestiveShadow: true,
                i18n: {
                    scrollable: "スクロールできます"
                }
            });
        });
    </script>


    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

    <?php wp_head(); ?>
    <meta name="google-site-verification" content="rDkRniiSrOzF_k5ccyGpkrfLe4dCJIARBhFrvuNsvlY" />
</head>
<div class="outer-menu">
    <input class="checkbox-toggle" type="checkbox" />
    <div class="hamburger">
        <div></div>
    </div>
    <div class="menu">
        <div>
            <div>
                <ul>
                    <li><a href="<?php echo esc_url(home_url()); ?>">HOME&ensp;&ensp;<span>トップページ</span></a></li>
                    <li><a href="<?php echo esc_url(home_url()); ?>#service">SERVICE&ensp;&ensp;<span>サービス・メニュー</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/plan/')); ?>">PLAN&ensp;&ensp;<span>制作料金・プラン比較表</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/order/')); ?>">ORDER&ensp;&ensp;<span>見積もり依頼</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">CONTACT&ensp;&ensp;<span>お問い合わせ</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<body <?php body_class(); ?> id="<?php echo esc_attr($post->post_name); ?>">
    <header>
        <?php
        $slug = basename(get_permalink());
        ?>
        <div class="title__<?php echo $slug ?>">
            <div class="title__<?php echo $slug ?>__bg">
                <h1 class="title-text"><?php the_title(); ?></h1>
            </div>
        </div>
    </header>
    <main class="main">