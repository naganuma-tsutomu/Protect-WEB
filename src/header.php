<!DOCTYPE html>
<html lang="ja" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <?php get_template_part('templates/parts/meta-data'); ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="<?php echo esc_attr($post->post_name); ?>">

    <?php /* ---------- TOPページ以外にheaderを表示 ---------- */ ?>
    <?php if (!is_front_page()) : ?>
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
    <?php endif; ?>

    <div class="outer-menu">
        <input id="checkbox-toggle" class="checkbox-toggle" type="checkbox" />
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

    <main class="main">