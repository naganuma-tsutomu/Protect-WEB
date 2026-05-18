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
                    <ul class="blog-list">
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

                            <?php get_template_part('templates/parts/content-blog-card'); //関数で記事カードを出力する?>

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
                        $big = 999999999; // ページ番号の置換用整数
                        $links = paginate_links(array(
                            'base'         => str_replace($big, '%#%', esc_url(add_query_arg('pg', $big))), // 独自のパラメータ 'pg' を使用
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
                                            $link_text = strip_tags($link);
                                    ?>
                                            <li class="page-number__block">
                                                <span class="page-number__box">
                                                    <span class="page-number__area">
                                                        <?php echo esc_html($link_text); ?>
                                                    </span>
                                                </span>
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
                                            $link_url  = isset($matches[1]) ? $matches[1] : '';
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