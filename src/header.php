<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <?php get_template_part('templates/parts/meta-data'); ?>
    <?php wp_head(); ?>
    <script src="https://kit.fontawesome.com/2832142ed8.js" crossorigin="anonymous"></script>
</head>

<body <?php body_class(); ?> id="<?php echo esc_attr($post->post_name); ?>">

    <?php /* ---------- TOPページ以外にheaderを表示 ---------- */ ?>
    <?php // トップページ以外のページでヘッダーを表示します。 ?>
    <?php if (!is_front_page()) : ?>
        <header>
            <?php
            // カテゴリ・タグ検索のパラメータを取得
            $cat_slug = isset($_GET['blog_cat']) ? sanitize_text_field($_GET['blog_cat']) : '';
            $tag_slug = isset($_GET['blog_tag']) ? sanitize_text_field($_GET['blog_tag']) : '';

            // 表示しているページの種類を判別し、タイトル($title)とCSSクラス名用のスラッグ($slug)を動的に設定します。
            if ($cat_slug || $tag_slug) { // カテゴリ・タグ絞り込み検索の場合
                $slug = 'blog'; // ブログのデザインを適用
                $title = '検索結果';
            } elseif (is_archive()) { // アーカイブページ（投稿一覧など）の場合
                $slug = get_query_var('post_type'); // 投稿タイプのスラッグを取得します (例: 'blog')。
                $title = get_post_type_object($slug)->label; // 投稿タイプのラベル（管理画面で設定した名前）を取得します (例: 'ブログ')。
            } elseif (is_single()) { // 個別投稿ページの場合
                $slug = get_query_var('post_type'); // 投稿タイプのスラッグを取得します。
                $title = get_post_type_object($slug)->label; // 投稿タイプのラベルを取得します。
            } elseif (is_search()) { // 検索結果ページの場合
                $slug = 'blog'; // ブログのデザイン（背景画像など）を適用するためにスラッグを 'blog' に設定
                $title = '検索結果'; // タイトルを設定
            } elseif (is_404()) { // 404エラーページの場合
                $slug = "404"; // スラッグを '404' に固定します。
                $title = "ページが見つかりません"; // タイトルを固定の文言に設定します。
            } else { // 上記以外（固定ページなど）の場合
                $slug = basename(get_permalink()); // 現在のページのパーマリンクからスラッグを取得します (例: 'service')。
                $title = get_the_title(); // 現在のページのタイトルを取得します。
            }
            ?>
            <?php // 動的に設定したスラッグをCSSクラス名に使用し、ページごとに異なるスタイルを適用できるようにします。 ?>
            <div class="title__<?php echo esc_attr($slug); ?>">
                <div class="title__<?php echo esc_attr($slug); ?>__bg">
                    <?php // 動的に設定したタイトルをh1タグで表示します。 ?>
                    <h1 class="title-text"><?php echo esc_html($title); ?></h1>
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
                        <!--<li><a href="<?php //echo esc_url(home_url('/works/'));
                                            ?>">WORKS&ensp;&ensp;<span>制作実績</span></a></li>-->
                        <li><a href="<?php echo esc_url(home_url('/blog/'));?>">BLOG&ensp;&ensp;<span>ブログ・記事</span></a></li>
                        <li><a href="<?php echo esc_url(home_url('/order/')); ?>">ORDER&ensp;&ensp;<span>見積もり依頼</span></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">CONTACT&ensp;&ensp;<span>お問い合わせ</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <main class="main">
    <?php get_template_part('templates/parts/breadcrumbs'); ?>
