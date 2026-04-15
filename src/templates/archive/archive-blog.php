<?php /* Template Name: archive blog Page */ ?>
<div class="container">
    <div id="weblog" class="weblog">
        <div class="wrap">
            <div class="contents_title">BLOG</div>
            <div class="contents_subtitle">ブログ・記事</div>

            <div class="flex-box">
                <!-- 記事一覧
                ------------------------------------------------->
                <div class="article">
                    <?php
                    // 現在選択されているカテゴリとタグのスラッグをURLパラメータから取得
                    $cat_slug = isset($_GET['blog_cat']) ? sanitize_text_field($_GET['blog_cat']) : '';
                    $tag_slug = isset($_GET['blog_tag']) ? sanitize_text_field($_GET['blog_tag']) : '';
                    ?>
                    <ul class="list">
                        <?php
                        // 独自のパラメータ 'pg' からページ番号を取得します。
                        $paged = isset($_GET['pg']) ? absint(sanitize_text_field($_GET['pg'])) : 1;

                        // WP_Queryに渡すパラメータを設定
                        $args = array(
                            'post_type'      => 'blog', // 取得する投稿タイプを 'blog' に指定
                            'posts_per_page' => 5,     // 1ページに表示する記事の数
                            'paged'          => $paged, // 取得するページ番号
                        );
                        // 設定したパラメータを使って、新しいクエリを作成し、記事データを取得
                        $my_query = new WP_Query($args);
                        ?>
                        <?php if ($my_query->have_posts()): ?>
                            <?php // 取得した記事データが存在する間、ループ処理を開始 
                            while ($my_query->have_posts()) : $my_query->the_post(); ?>

                                <li class="item">
                                    <a class="item-link" href="<?php the_permalink(); ?>">
                                        <div class="thumbnail">
                                            <?php
                                            $image_url = get_field('image');
                                            // 画像が未設定の場合の共通画像パスを設定
                                            if (empty($image_url) || is_wp_error($image_url)) {
                                                $image_url = get_theme_file_uri('/assets/images/common/no-image.webp');
                                            }
                                            ?>
                                            <img class="thumbnail__img" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
                                        </div>
                                        <div class="lead">
                                            <div class="lead__title">
                                                <p class="lead__title_text">
                                                    <?php
                                                    // 現在の投稿のタイトルを取得
                                                    $title  = get_the_title();
                                                    // タイトルからHTMLタグとショートコードを取り除く
                                                    $text = strip_tags(strip_shortcodes($title));
                                                    // 整形したテキストを出力
                                                    echo $text;
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="lead__main">
                                                <p class="lead__main_text">
                                                    <?php
                                                    // 現在の投稿の本文を取得
                                                    $content  = get_the_content();
                                                    // 本文からHTMLタグとショートコードを取り除く
                                                    $text = strip_tags(strip_shortcodes($content));
                                                    // 整形したテキストを出力
                                                    echo $text;
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="lead-sub">
                                                <div class="lead__date">
                                                    <span class="lead__date_text">
                                                        <?php echo get_the_date(); // 投稿日を出力
                                                        ?>
                                                    </span>
                                                </div>
                                                <?php
                                                $cat_taxonomy = 'blog_cat';
                                                $categories = get_the_terms(get_the_ID(), $cat_taxonomy);
                                                // カテゴリが存在する場合のみ div を出力
                                                if (! empty($categories) && ! is_wp_error($categories)) :
                                                ?>
                                                    <div class="lead__category">
                                                        <?php
                                                        foreach ($categories as $category) :
                                                            // add_query_argを使用してURLを安全に生成
                                                            $category_link = add_query_arg(array(
                                                                's'        => $category->name,
                                                                'blog_cat' => $category->slug
                                                            ), home_url('/'));
                                                            // 現在選択されているカテゴリと一致するか判定（日本語スラッグ対応のためデコード）
                                                            $is_cat_active = ($cat_slug && urldecode($cat_slug) === urldecode($category->slug));
                                                    ?>
                                                            <object class="lead__category_text">
                                                                <?php if ($is_cat_active) : ?>
                                                                    <span class="lead__category_link active">
                                                                        <?php echo esc_html($category->name); ?>
                                                                    </span>
                                                                <?php else : ?>
                                                                    <a class="lead__category_link" href="<?php echo esc_url($category_link); ?>">
                                                                        <?php echo esc_html($category->name); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </object>
                                                    <?php
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php
                                                $tag_taxonomy = 'blog_tag';
                                                $tags = get_the_terms(get_the_ID(), $tag_taxonomy);
                                                // タグが存在する場合のみ div > object を出力
                                                if (! empty($tags) && ! is_wp_error($tags)) :
                                                ?>
                                                    <div class="lead__tag">
                                                        <object class="lead__tag_text">
                                                            <?php
                                                            foreach ($tags as $tag) :
                                                                // add_query_argを使用してURLを安全に生成
                                                                $tag_link = add_query_arg(array(
                                                                    's'        => $tag->name,
                                                                    'blog_tag' => $tag->slug
                                                                ), home_url('/'));
                                                                // 現在選択されているタグと一致するか判定
                                                                $is_tag_active = (urldecode($tag_slug) === urldecode($tag->slug));
                                                        ?>
                                                                <?php if ($is_tag_active) : ?>
                                                                    <span class="lead__tag_link01 active">
                                                                        <?php echo '#' . esc_html($tag->name); ?>
                                                                    </span>
                                                                <?php else : ?>
                                                                    <a class="lead__tag_link01" href="<?php echo esc_url($tag_link); ?>">
                                                                        <?php echo '#' . esc_html($tag->name); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                        <?php
                                                            endforeach;
                                                            ?>
                                                        </object>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="lead__button" data-post-id="<?php the_ID(); ?>" style="pointer-events: none;">
                                                    <?php 
                                                    $rel_like_count = (int) get_post_meta(get_the_ID(), '_post_like_count', true);
                                                    ?>
                                                    <span class="lead__button_heart lead__button_heart--icon">♡</span>
                                                    <span class="lead__button_number"><?php echo $rel_like_count; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; // ループの終了 
                            else : 
                            ?>
                            <li class="blog-empty">このブログにはまだ記事がありません。<br>
                                更新までしばらくお待ちください。</li>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); // WP_Query で変更された投稿データを元に戻す 
                        ?>
                    </ul>

                    <!-- ページネーション
                    ------------------------------------------------->

                    <?php // ページネーションの表示
                    if ($my_query->max_num_pages > 1): // ページが2ページ以上ある場合にのみページネーションを表示
                        // ページネーションのリンクを配列として取得
                        $links = paginate_links(array(
                            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))), // ページ番号の置換ルール
                            'format'       => '?paged=%#%', // ページ番号のフォーマット
                            'base'         => str_replace(999999999, '%#%', esc_url(add_query_arg('pg', 999999999))), // 独自のパラメータ 'pg' を使用
                            'format'       => '', // formatは空にする（base側でパラメータを指定しているため）
                            'current'      => max(1, $paged), // 現在のページ番号
                            'total'        => $my_query->max_num_pages, // 全ページ数
                            'type'         => 'array', // リンクを配列として取得（HTML文字列ではなく）
                            'prev_next'    => false,  // 「前へ」「次へ」のリンクを表示しない
                            'end_size'     => 1,      // 最初と最後に表示するページ数
                            'mid_size'     => 2,      // 現在のページの左右に表示するページ数
                        ));

                        // リンクが存在する場合のみ出力処理を行う
                        if ($links) :
                    ?>
                            <div class="pagination">
                                <ul class="page-number">
                                    <?php
                                    // 配列として取得したリンクをループ処理
                                    foreach ($links as $link) {
                                        // 現在のページの場合
                                        if (strpos($link, 'current')) {
                                            // ページ番号のみ取得
                                            $page_number = strip_tags($link);
                                    ?>
                                            <li class="page-number__block">
                                                <a class="page-number__link active" href="#">
                                                    <span class="page-number__area">
                                                        <?php echo esc_html($page_number); ?>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        // 省略記号「...」の場合
                                        elseif (strpos($link, 'dots')) {
                                        ?>
                                            <li class="page-number__item">
                                                <span class="page-number__dotted">...</span>
                                            </li>
                                        <?php
                                        }
                                        // その他の通常のページリンクの場合
                                        else {
                                            // リンクからURLとテキストを抽出
                                            preg_match('/href=["\']?([^"\'>]+)["\']?/', $link, $matches);
                                            $link_url = isset($matches[1]) ? $matches[1] : '';
                                            $link_text = strip_tags($link);
                                        ?>
                                            <li class="page-number__block">
                                                <a class="page-number__link" href="<?php echo esc_url($link_url); ?>">
                                                    <span class="page-number__area"><?php echo esc_html($link_text); ?></span>
                                                </a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                    <?php
                        endif;
                    endif; ?>
                </div>
                <?php get_template_part('sidebar'); //サイドバー(sidebar.phpを呼び出す) ?>
            </div>
        </div>
    </div>
</div>