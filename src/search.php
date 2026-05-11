<?php get_header(); ?>
<div class="wrapper">
    <?php /* Template Name: archive blog Page */ ?>
<div class="container">
    <div id="weblog" class="weblog">
        <div class="wrap">
            <div class="contents_title">SEARCH</div>
            <div class="contents_subtitle">検索結果</div>

            <div class="flex-box">
                <!-- 記事一覧
                ------------------------------------------------->
                <div class="article">
                    <?php
                    // パラメータの取得をここで行う（タイトル表示とクエリ作成の両方で使用するため）
                    $cat_slug = isset($_GET['blog_cat']) ? sanitize_text_field($_GET['blog_cat']) : ''; // カテゴリパラメータ取得
                    $tag_slug = isset($_GET['blog_tag']) ? sanitize_text_field($_GET['blog_tag']) : ''; // タグパラメータ取得
                    $search_query = get_search_query(); // 検索キーワードを取得
                    ?>
                    <div class="search-result">
                        <?php
                        // 表示条件の分岐
                        if ($cat_slug && ($term = get_term_by('slug', $cat_slug, 'blog_cat')) && !is_wp_error($term)) {
                            echo 'カテゴリ：「' . esc_html($term->name) . '」';
                        } elseif ($tag_slug && ($term = get_term_by('slug', $tag_slug, 'blog_tag')) && !is_wp_error($term)) {
                            echo 'タグ：「' . esc_html($term->name) . '」';
                        } elseif ($search_query) {
                            echo '「' . esc_html($search_query) . '」の検索結果';
                        } else {
                            echo '検索キーワードが未入力です';
                        }
                        ?>
                    </div>
                    <ul class="list">
                        <?php
                        // 独自のパラメータ 'search_page' からページ番号を取得します。
                        $paged = isset($_GET['search_page']) ? absint(sanitize_text_field($_GET['search_page'])) : 1;

                        // WP_Queryに渡すパラメータを設定
                        $args = array(
                            'post_type'      => 'blog',           // 取得する投稿タイプを 'blog' に指定
                            'posts_per_page' => 2,                // 1ページに表示する記事の数
                            'paged'          => $paged,           // 取得するページ番号
                        );

                        // カテゴリ・タグ指定がある場合は絞り込み検索（キーワード検索は行わない）
                        if ($cat_slug) {
                            // ここで 's' パラメータをセットしないことで、キーワード検索を無効化しています
                            $args['tax_query'] = array(
                                array('taxonomy' => 'blog_cat', 'field' => 'slug', 'terms' => $cat_slug),
                            );
                        } elseif ($tag_slug) {
                            // 同様にタグの場合も 's' をセットせず、tax_query のみを実行します
                            $args['tax_query'] = array(
                                array('taxonomy' => 'blog_tag', 'field' => 'slug', 'terms' => $tag_slug),
                            );
                        } else {
                            // 指定がない場合は通常のキーワード検索
                            $args['s'] = $search_query;
                        }

                        // 設定したパラメータを使って、新しいクエリを作成し、記事データを取得
                        $my_query = new WP_Query($args);
                        ?>
                        <?php if ($my_query->have_posts()): ?>
                            <?php // 取得した記事データが存在する間、ループ処理を開始 
                            while ($my_query->have_posts()) : $my_query->the_post(); ?>

                                <li class="item">
                                    <a class="item-link" href="<?php the_permalink(); ?>">
                                        <div class="thumbnail">
                                            <?php echo get_the_post_image(get_the_ID(), 'thumbnail__img'); ?>
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
                                                <div class="lead-sub__date">
                                                    <span class="lead-sub__date_text">
                                                        <?php echo get_the_date(); // 投稿日を出力
                                                        ?>
                                                    </span>
                                                </div>

                                                <!-- カテゴリ取得 -->
                                                <?php
                                                $blog_cat = 'blog_cat';
                                                $blog_tag = 'blog_tag';
                                                ?>
                                                <?php if ($cat_term_data = get_the_taxonomy_data($blog_cat, get_the_ID())) : ?>
                                                    <div class="lead-sub__category">
                                                        <object class="lead-sub__cat-area">
                                                            <?php render_taxonomy_links($cat_term_data, $blog_cat, 'lead-sub__cat-area_link', '', get_the_ID()); ?>
                                                        </object>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- タグ取得 -->
                                                <?php if ($tag_term_data = get_the_taxonomy_data($blog_tag, get_the_ID())) : ?>
                                                    <div class="lead-sub__tag">
                                                        <object class="lead-sub__tag-area">
                                                            <?php render_taxonomy_links($tag_term_data, $blog_tag, 'lead-sub__tag-area_link', '', get_the_ID()); ?>
                                                        </object>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <!-- いいね数 -->
                                                <div class="lead-sub__button" data-post-id="<?php the_ID(); ?>" style="pointer-events: none;">
                                                    <span class="lead-sub__button-heart">♡</span>
                                                    <span class="lead-sub__button-heart_number"><?php echo get_post_like_count(get_the_ID()); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; // ループの終了 
                            ?>
                        <?php else: ?>
                            <li class="search-no-result">
                                <span class="search-no-result__text">該当する記事は見つかりませんでした。<br>別のキーワードをお試しください。</span>
                            </li>
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
                        // 検索キーワードを維持したまま、独自のページネーションパラメータを付与する
                        $base_url = add_query_arg('s', $search_query, home_url('/'));
                        // カテゴリ・タグパラメータがあれば維持する
                        if ($cat_slug) $base_url = add_query_arg('blog_cat', $cat_slug, $base_url);
                        if ($tag_slug) $base_url = add_query_arg('blog_tag', $tag_slug, $base_url);

                        $links = paginate_links(array(
                            'base'         => str_replace($big, '%#%', add_query_arg('search_page', $big, $base_url)),
                            'format'       => '', // 'base'でURLの構造を指定しているため、ここは空にします
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
</div>

<?php get_footer(); ?>
