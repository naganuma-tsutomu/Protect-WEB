<?php /* single-blog */ ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container">
       <div id="weblog-single" class="weblog-single">
            <div class="wrap">
                <div class="flex-box">
                    <!-- 記事
                    ------------------------------------------------->
                    <div class="main-block">
                        <!-- box shadow --->
                        <div class="box-shadow">
                            <!-- 見出し --->
                            <div class="article">
                                <div class="main-lead">
                                    <div class="main-lead-top">
                                        <div class="main-lead__date">
                                            <span class="main-lead__date_text">
                                                <?php echo get_the_date(); //投稿日を出力 ?>
                                            </span>
                                        </div>
                                        <!-- いいね数 -->
                                        <div class="main-lead__button" data-post-id="<?php the_ID(); ?>">
                                            <span class="main-lead__button_heart">♡</span>
                                            <span class="main-lead__button_number"><?php echo get_post_like_count(get_the_ID()); ?></span>
                                        </div>
                                    </div>
                                    <div class="main-lead__title">
                                        <h1>
                                            <?php
                                                // 現在の投稿のタイトルを取得
                                                $title  = get_the_title();
                                                // タイトルからHTMLタグとショートコードを取り除く
                                                $text = strip_tags(strip_shortcodes($title));
                                                // 整形したテキストを出力
                                                echo $text;
                                            ?>
                                        </h1>
                                    </div>

                                    <div class="main-lead-sub">
                                    <!-- カテゴリを出力 -->
                                    <?php 
                                        $blog_cat = 'blog_cat';
                                        $blog_tag = 'blog_tag';
                                    ?>
                                    <?php if ($cat_term_data = get_the_taxonomy_data($blog_cat, get_the_ID())) : ?>
                                        <ul class="main-lead__category">
                                            <?php render_taxonomy_links($cat_term_data ,$blog_cat,'main-lead__category-text_link','main-lead__category_text'); //カテゴリを出力?>
                                        </ul>
                                    <?php endif; ?>
                                    <!-- タグを出力 -->
                                    <?php if ($tag_term_data = get_the_taxonomy_data($blog_tag, get_the_ID())) : ?>
                                        <ul class="main-lead__tag">
                                            <?php render_taxonomy_links($tag_term_data ,$blog_tag,'main-lead__tag-text_link','main-lead__tag_text'); //タグを出力?>
                                        </ul>
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <div class="main-thumbnail">
                                    <?php echo get_the_post_image(get_the_ID(), 'main-thumbnail__img', false); ?>
                                </div>
                            </div>
                            <!-- 記事 --->
                            <div class="main-box">
                                <!-- 目次 --->
                                <?php
                                // 本文データの取得と整形
                                // データベースから生の本文を取得し、WordPress公式の加工処理を一斉に適用。
                                // 読者が実際に画面で見ている状態と100%同じ「完成されたHTML本文」を作る。
                                $filtered_content = apply_filters('the_content', get_the_content());
                                // sidebar.phpの目次生成でも使えるよう、グローバル変数に格納
                                global $protect_web_filtered_content;
                                $protect_web_filtered_content = $filtered_content;

                                // 目次生成のための見出し（h2・h3）チェックとデータ抽出
                                // !emptyで中身があるか確認、preg_match_allで本文の中にh2またはh3が一つでもある場合は$matchesに保存。
                                // ※見出しが1つもない記事の場合は、このif文がスキップされるため、空っぽの目次が表示されてしまうのを防ぐ。
                                if (!empty($filtered_content) && preg_match_all('/<(h[23]).*?>(.*?)<\/h[23]>/i', $filtered_content, $matches)) :
                                ?>
                                <div class="index">
                                    <span class="index__border"></span>
                                    <div class="index__title">
                                        <span class="index__box"></span>
                                        <div class="index__title_text">目次</div>
                                    </div>
                                    <div class="index__text">
                                        <ol class="index-list">
                                            <?php 
                                            // $matches[1] に「h2」または「h3」が入る
                                            // $keyは何番目か、$tagはh2かh3か
                                            foreach ($matches[1] as $key => $tag) : 
                                                // h2かh3の中身のテキスト
                                                $title = $matches[2][$key];

                                                // タグ名を小文字に統一して判定（念のため）
                                                $tag = strtolower($tag);

                                                // h3の時は確実に「index-item--h3」というクラス名を追加する
                                                $item_class = 'index-item';
                                                if ($tag === 'h3') {
                                                    // index-itemの後ろに新しいクラスを追加
                                                    $item_class .= ' index-item--h3';
                                                }
                                            ?>
                                                <li class="<?php echo $item_class; ?>">
                                                    <?php if ($tag === 'h3') : ?>
                                                        <i class="fa-regular fa-circle"></i>
                                                    <?php else : ?>
                                                        <i class="fa-regular fa-square"></i>
                                                    <?php endif; ?>
                                                    
                                                    <a class="index-item__link" href="#index-<?php echo $key; ?>"><?php echo strip_tags($title); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </div>
                                    <span class="index__border"></span>
                                </div>
                                <?php endif; ?>
                                <!-- 本文 --->
                                <div class="main-content">
                                    <?php
                                    // h2またはh3タグを区切り文字として、コンテンツをセクションに分割
                                    $sections = preg_split('/(?=<h[23])/', $filtered_content, -1, PREG_SPLIT_NO_EMPTY);

                                    // 最初のセクション（最初の見出しの前のコンテンツ）が含まれていないかチェック
                                    if (isset($sections[0]) && !preg_match('/<h[23]/', $sections[0])) :
                                    ?>
                                        <div class="main-content__index">
                                            <?php 
                                            // 先頭を抜き出して、残りを前に詰める
                                            echo array_shift($sections); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    // 見出しブロックを上から1つずつループ処理
                                    foreach ($sections as $key => $section) :
                                        // 見出しタグの始まり（<h2 や <h3）を正確に置換してIDを付与
                                        $section = preg_replace('/<(h[23])(\s|>)/i', '<$1 id="index-' . $key . '"$2', $section, 1);

                                        // セクションの最初の中身が h3 かどうかでクラス名を完全に分ける
                                        $section_class = 'main-content__index';
                                        if (preg_match('/^<h3/i', trim($section))) {
                                            $section_class .= ' main-content__index--h3'; // h3から始まるブロック
                                        } else {
                                            $section_class .= ' main-content__index--h2'; // h2から始まるブロック（またはその他）
                                        }
                                    ?>
                                        <div class="<?php echo $section_class; ?>">
                                            <?php echo $section; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="category-sub">
                                    <p class="category-sub__title">この記事のカテゴリ・タグ一覧</p>
                                    <div class="bottom">
                                        <!-- カテゴリを出力 -->
                                        <?php if ($cat_term_data = get_the_taxonomy_data($blog_cat, get_the_ID())) : ?> 
                                            <ul class="category-list">
                                                <?php render_taxonomy_links($cat_term_data ,$blog_cat,'category-item__link','category-item'); ?>
                                            </ul>
                                        <?php endif; ?>

                                        <!-- タグを出力 -->
                                        <?php if ($tag_term_data = get_the_taxonomy_data($blog_tag, get_the_ID())) : ?> 
                                            <ul class="tag-list">
                                                <?php render_taxonomy_links($tag_term_data ,$blog_tag,'tag-item__link','tag-item'); ?>
                                            </ul>
                                        <?php endif; ?>

                                        <!-- いいねボタンを出力 -->
                                        <button class="good js-like-button" data-post-id="<?php the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('like_nonce'); ?>">
                                            <span class="good__item">♡</span>
                                            <span class="good__number"><?php echo get_post_like_count(get_the_ID()); ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="author">
                            <!-- <span class="author__label">この記事の執筆者</span> -->
                            <?php
                            $author_id = get_the_author_meta('ID');
                            $author_img = get_field('user_profile_img', 'user_' . $author_id); // ACFフィールドを取得
                            if ($author_img) : ?>
                                <img src="<?php echo esc_url($author_img); ?>" alt="<?php echo esc_attr(get_the_author()); ?>" class="author__img">
                            <?php else : ?>
                                <?php echo get_avatar($author_id, 100, '', get_the_author(), array('class' => 'author__img')); ?>
                            <?php endif; ?>
                            <div class="author__info">
                            <p class="author__name"><?php the_author(); ?></p>
                            <p class="author__profile">
                                <?php the_author_meta('user_profile_comment'); ?>
                            </p>
                            </div>
                        </div>

                        <!-- 前・次・記事一覧のボタン
                        ------------------------------------------------->
                        <div class="blog-pagination">
                            <?php
                            $prev_post = get_previous_post();
                            if (!empty($prev_post)) : ?>
                                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="blog-pagination__before">
                                 <?php echo esc_html($prev_post->post_title); ?>
                                    <div class="blog-pagination__before_item">← 前の記事</div>
                                </a>
                            <?php endif; ?>
                            <?php
                            $next_post = get_next_post();
                            if (!empty($next_post)) : ?>
                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="blog-pagination__after">
                                    <?php echo esc_html($next_post->post_title); ?>
                                    <div class="blog-pagination__after_item">次の記事 →</div>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php
                        $post_type_archive_link = get_post_type_archive_link('blog');
                        if ($post_type_archive_link) :
                        ?>
                            <a href="<?php echo esc_url($post_type_archive_link); ?>" class="blog-pagination__index">記事一覧</a>
                        <?php endif; ?>

                        <!-- 関連記事
                        ------------------------------------------------->
                        <?php
                                $related_title = '関連記事';
                                // 現在の投稿のカテゴリー（ターム）IDを取得
                                $terms = get_the_terms(get_the_ID(), $blog_cat);
                                $term_ids = array();
                                if ($terms && !is_wp_error($terms)) {
                                    // タームIDの配列を効率的に取得
                                    $term_ids = wp_list_pluck($terms, 'term_id');
                                }

                                $args = array(
                                    'post_type'      => 'blog',
                                    'post_status'    => 'publish',
                                    'posts_per_page' => 5,
                                    'post__not_in'   => array(get_the_ID()),
                                    'orderby'        => 'rand',
                                );

                                if (!empty($term_ids)) {
                                    // カテゴリがある場合はそのカテゴリで検索
                                    $args['tax_query'] = array(
                                        array(
                                            'taxonomy' => $blog_cat,
                                            'field'    => 'term_id',
                                            'terms'    => $term_ids,
                                        ),
                                    );
                                    $related_query = new WP_Query($args);

                                    // 関連記事が見つからなかった場合は絞り込みを解除して再取得
                                    if (!$related_query->have_posts()) {
                                        $related_title = 'おすすめ記事';
                                        unset($args['tax_query']);
                                        $related_query = new WP_Query($args);
                                    }
                                } else {
                                    // そもそも現在の記事にカテゴリがない場合は最初から「おすすめ記事」を表示
                                    $related_title = 'おすすめ記事';
                                    $related_query = new WP_Query($args);
                                }
                        ?>

                        <div class="blog-posts">
                            <div class="blog-posts__title"><?php echo esc_html($related_title); ?></div>
                            <ul class="blog-list">
                                <?php
                                if ($related_query->have_posts()) :
                                    while ($related_query->have_posts()) : $related_query->the_post();
                                ?>
                                <?php get_template_part('templates/parts/content-blog-card'); //関数で記事カードを出力する?>
                                <?php
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                ?>
                                    <li class="blog-list__item">
                                        <span class="blog-list__item_text">現在表示できる記事はありません。</span>
                                    </li>
                                <?php
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php get_template_part('sidebar'); //サイドバー(sidebar.php)を呼び出す ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; endif; ?>