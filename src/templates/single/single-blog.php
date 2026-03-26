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
                                <div class="lead">
                                    <div class="lead-top">
                                        <div class="lead__date">
                                            <span class="lead__date_text">
                                                <?php echo get_the_date(); //投稿日を出力 ?>
                                            </span>
                                        </div>
                                        <div class="lead__button" data-post-id="<?php the_ID(); ?>">
                                            <?php 
                                            $like_count = (int) get_post_meta(get_the_ID(), '_post_like_count', true);
                                            ?>
                                            <span class="lead__button_heart">♡</span>
                                            <span class="lead__button_number"><?php echo $like_count; ?></span>
                                        </div>
                                    </div>
                                    <div class="lead__title">
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
                                    <div class="lead-sub">
                                        <div class="lead__category">
                                            <?php 
                                                //カテゴリを取得 
                                                $cat_taxonomy = 'blog_cat';
                                                // 現在の投稿に紐づく 'blog_cat' カテゴリを取得
                                                $categories = get_the_terms(get_the_ID(), $cat_taxonomy);
                                                // カテゴリが存在し、エラーがない場合のみ処理を実行
                                                if (! empty($categories) && ! is_wp_error($categories)) {
                                                    // 取得したカテゴリを一つずつループ処理
                                                    foreach ($categories as $category) {
                                                         // カテゴリ名をキーワードとした検索URLを生成
                                                        $category_link = home_url('/') . '?s=' . urlencode($category->name) . '&blog_cat=' . $category->slug;
                                            ?>
                                            <object class="lead__category_text">
                                                <a class="lead__category_link" href="<?php echo esc_url($category_link); ?>">
                                                    <?php echo esc_html($category->name); ?>
                                                </a>
                                            </object>
                                            <?php
                                                }
                                                }
                                            ?>
                                        </div>
                                        <div class="lead__tag">
                                            <object class="lead__tag_text">
                                                <?php 
                                                    //タグを取得する
                                                    $tag_taxonomy = 'blog_tag';
                                                    // 現在の投稿に紐づく 'blog_tag' タグを取得
                                                    $tags = get_the_terms(get_the_ID(), $tag_taxonomy);
                                                    // タグが存在し、エラーがない場合のみ処理を実行
                                                    if (! empty($tags) && ! is_wp_error($tags)) {
                                                        // 取得したタグを一つずつループ処理
                                                        foreach ($tags as $tag) {
                                                            // タグ名をキーワードとした検索URLを生成
                                                            $tag_link = home_url('/') . '?s=' . urlencode($tag->name) . '&blog_tag=' . $tag->slug;
                                                ?>
                                                <a class="lead__tag_link" href="<?php echo esc_url($tag_link); ?>">
                                                    <?php echo '#' . esc_html($tag->name); ?>
                                                </a>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                            </object>
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail">
                                    <?php
                                        // ACFの 'image' フィールドから画像URLを取得
                                        $image_url = get_field('image');
                                        // 画像URLが空でなく、エラーもないことを確認
                                        if (!empty($image_url) && !is_wp_error($image_url));
                                    ?>
                                    <img class="thumbnail__img" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_html($image_url); ?>">
                                </div>
                            </div>
                            <!-- 記事 --->
                            <div class="main-box">
                                <!-- 目次 --->
                                <?php
                                // 本文からh2タグを抽出して目次を生成
                                $index_content = apply_filters('the_content', get_the_content());
                                if (preg_match_all('/<h2.*?>+(.*?)<\/h2>/i', $index_content, $matches)) :
                                ?>
                                <div class="index">
                                    <span class="index__border"></span>
                                    <div class="index__title">
                                        <span class="index__box"></span>
                                        <div class="index__title_text">目次</div>
                                    </div>
                                    <div class="index__text">
                                        <ol class="index-list">
                                            <?php //抽出された見出しの配列を1つずつ取り出す
                                            //$key=連番（インデックス）,$title=h2のテキスト
                                            foreach ($matches[1] as $key => $title) : ?>
                                                <li class="index-item">
                                                    <i class="fa-regular fa-square"></i>
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
                                    // 投稿の本文をフィルターを適用した形で取得
                                    $content = apply_filters('the_content', get_the_content());

                                    // h2タグを区切り文字として、コンテンツをセクションに分割
                                    $sections = preg_split('/(?=<h2)/', $content, -1, PREG_SPLIT_NO_EMPTY);

                                    // 最初のセクション（最初のh2の前のコンテンツ）があるかチェック
                                    if (isset($sections[0]) && strpos($sections[0], '<h2') === false) :
                                    ?>
                                        <div class="main-content__index">
                                            <?php echo array_shift($sections); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    // 各h2セクションをループで出力します。
                                    foreach ($sections as $key => $section) :
                                        // h2タグにIDを付与（目次からのリンク用）
                                        $section = preg_replace('/<h2/', '<h2 id="index-' . $key . '"', $section, 1);
                                    ?>
                                        <div class="main-content__index">
                                            <?php echo $section; ?>
                                        </div>
                                    <?php endforeach;
                                    ?>
                                    <div class="category-sub">
                                        <p class="category-sub__title">この記事のカテゴリ・タグ一覧</p>
                                        <div class="bottom">
                                            <div class="bottom__category">
                                                <?php
                                                $categories = get_the_terms(get_the_ID(), 'blog_cat');
                                                if (!empty($categories) && !is_wp_error($categories)) :
                                                    foreach ($categories as $category) :
                                                        $category_link = home_url('/') . '?s=' . urlencode($category->name) . '&blog_cat=' . $category->slug;
                                                ?>
                                                        <a class="bottom__category_link" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category->name); ?></a>
                                                <?php endforeach;
                                                endif;
                                                ?>
                                            </div>
                                            <div class="bottom__tag">
                                                <ul class="tag-list">
                                                    <?php
                                                    $tags = get_the_terms(get_the_ID(), 'blog_tag');
                                                    if (!empty($tags) && !is_wp_error($tags)) :
                                                        foreach ($tags as $tag) :
                                                            $tag_link = home_url('/') . '?s=' . urlencode($tag->name) . '&blog_tag=' . $tag->slug;
                                                    ?>
                                                            <li class="tag-item"><a class="tag-item__link" href="<?php echo esc_url($tag_link); ?>">#<?php echo esc_html($tag->name); ?></a></li>
                                                    <?php endforeach;
                                                    endif;
                                                    ?>
                                                </ul>
                                            </div>
                                            <?php 
                                            $current_like_count = (int) get_post_meta(get_the_ID(), '_post_like_count', true);
                                            ?>
                                            <button class="good js-like-button" data-post-id="<?php the_ID(); ?>">
                                                <span class="good__item">♡</span>
                                                <span class="good__number"><?php echo $current_like_count; ?></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="Related-Posts">
                            <div class="Related-Posts__title">関連記事</div>
                            <ul class="Related-Posts-list">
                                <?php
                                // 現在の投稿のカテゴリー（ターム）IDを取得
                                $terms = get_the_terms(get_the_ID(), 'blog_cat');
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

                                // 同じカテゴリ（ターム）がある場合のみtax_queryを追加
                                if (!empty($term_ids)) {
                                    $args['tax_query'] = array(
                                        array(
                                            'taxonomy' => 'blog_cat',
                                            'field'    => 'term_id',
                                            'terms'    => $term_ids,
                                        ),
                                    );
                                }

                                $related_query = new WP_Query($args);

                                if ($related_query->have_posts()) :
                                    while ($related_query->have_posts()) : $related_query->the_post();
                                ?>
                                        <li class="Related-Posts-item">
                                            <a class="Related-Posts-item-link" href="<?php the_permalink(); ?>">
                                                <div class="Related-Posts-thumbnail">
                                                    <?php
                                                    $image_url = get_field('image');
                                                    if (!empty($image_url)) :
                                                    ?>
                                                        <img class="Related-Posts-thumbnail__img" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="Related-Posts-lead">
                                                    <div class="Related-Posts-lead__title">
                                                        <div class="Related-Posts-lead__title_text"><?php the_title(); ?></div>
                                                    </div>
                                                    <div class="Related-Posts-lead__main">
                                                        <div class="Related-Posts-lead__main_text">
                                                            <?php echo get_the_excerpt(); ?>
                                                        </div>
                                                    </div>
                                                    <div class="Related-Posts-lead-sub">
                                                        <div class="Related-Posts-lead__date">
                                                            <span class="Related-Posts-lead__date_text"><?php echo get_the_date(); ?></span>
                                                        </div>

                                                        <div class="Related-Posts-lead__category">
                                                            <?php //カテゴリを取得 
                                                            $cat_taxonomy = 'blog_cat';
                                                            // 現在の投稿に紐づく 'blog_cat' タクソノミーのターム（カテゴリ）を取得
                                                            $categories = get_the_terms(get_the_ID(), $cat_taxonomy);
                                                            // カテゴリが存在し、エラーがない場合のみ処理を実行
                                                            if (! empty($categories) && ! is_wp_error($categories)) {
                                                                // 取得したカテゴリを一つずつループ処理
                                                                foreach ($categories as $category) {
                                                                    // カテゴリ名をキーワードとした検索URLを生成
                                                                    $category_link = home_url('/') . '?s=' . urlencode($category->name) . '&blog_cat=' . $category->slug;
                                                            ?>
                                                                    <object class="Related-Posts-lead__category_text">
                                                                        <a class="Related-Posts-lead__category_link" href="<?php echo esc_url($category_link); ?>">
                                                                            <?php echo esc_html($category->name); ?>
                                                                        </a>
                                                                    </object>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>

                                                        <div class="Related-Posts-lead__tag">
                                                            <object class="Related-Posts-lead__tag_text">
                                                                <?php //タグを取得する
                                                                $tag_taxonomy = 'blog_tag';
                                                                // 現在の投稿に紐づく 'blog_tag' タクソノミーのターム（タグ）を取得
                                                                $tags = get_the_terms(get_the_ID(), $tag_taxonomy);
                                                                // タグが存在し、エラーがない場合のみ処理を実行
                                                                if (! empty($tags) && ! is_wp_error($tags)) {
                                                                    // 取得したタグを一つずつループ処理
                                                                    foreach ($tags as $tag) {
                                                                        // タグ名をキーワードとした検索URLを生成
                                                                        $tag_link = home_url('/') . '?s=' . urlencode($tag->name) . '&blog_tag=' . $tag->slug;
                                                                ?>
                                                                        <a class="Related-Posts-lead__tag_link" href="<?php echo esc_url($tag_link); ?>">
                                                                            <?php echo '#' . esc_html($tag->name); ?>
                                                                        </a>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </object>
                                                        </div>
                                                        
                                                        <div class="Related-Posts-lead__button" data-post-id="<?php the_ID(); ?>">
                                                            <?php 
                                                            $rel_like_count = (int) get_post_meta(get_the_ID(), '_post_like_count', true);
                                                            ?>
                                                            <span class="Related-Posts-lead__button_heart Related-Posts-lead__button_heart--icon">♡</span>
                                                            <span class="Related-Posts-lead__button_number"><?php echo $rel_like_count; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                <?php
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                ?>
                                    <li class="Related-Posts-item">
                                        <span class="Related-Posts-item__text">関連記事はありません。</span>
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