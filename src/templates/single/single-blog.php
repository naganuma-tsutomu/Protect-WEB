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
                                        <div class="lead__button">
                                            <span class="lead__button_heart">♡</span>
                                            <span class="lead__button_number">11</span>
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
                                                         // カテゴリのアーカイブページへのリンクURLを取得
                                                        $category_link = get_term_link($category->slug, $cat_taxonomy);
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
                                                            // タグのアーカイブページへのリンクURLを取得
                                                            $tag_link = get_term_link($tag->slug, $tag_taxonomy);
                                                ?>
                                                <a class="lead__tag_link01" href="<?php echo esc_url($tag_link); ?>">
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
                                <div class="index">
                                    <span class="index__border"></span>
                                    <div class="index__title">
                                        <span class="index__box"></span>
                                        <div class="index__title_text">目次</div>
                                    </div>
                                    <div class="index__text">
                                        <ol class="index-list">
                                            <li class="index-item">
                                                <i class="fa-regular fa-square"></i>
                                                <a class="index-item__link" href="#index-1">はじめに</a>
                                            </li>
                                            <li class="index-item">
                                                <i class="fa-regular fa-square"></i>
                                                <a class="index-item__link" href="#index-2">最初は「AIをどんどん使わせていた」</a>
                                            </li>
                                            <li class="index-item">
                                                <i class="fa-regular fa-square"></i>
                                                <a class="index-item__link" href="#index-3">レビュー830件の衝撃</a>
                                            </li>
                                            <li class="index-item">
                                                <i class="fa-regular fa-square"></i>
                                                <a class="index-item__link" href="#index-4">「AIを神だと思っていました」</a>
                                            </li>
                                            <li class="index-item">
                                                <i class="fa-regular fa-square"></i>
                                                <a class="index-item__link" href="#index-5">AI禁止令</a>
                                            </li>
                                        </ol>
                                    </div>
                                    <span class="index__border"></span>
                                </div>
                                <!-- 本文 --->
                                <div class="main-content">
                                    <?php
                                    // 投稿の本文をフィルターを適用した形で取得します。
                                    $content = apply_filters('the_content', get_the_content());

                                    // h2タグを区切り文字として、コンテンツをセクションに分割します。
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
                                    foreach ($sections as $section) :
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
                                                        $category_link = get_term_link($category);
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
                                                            $tag_link = get_term_link($tag);
                                                    ?>
                                                            <li class="tag-item"><a class="tag-item__link" href="<?php echo esc_url($tag_link); ?>">#<?php echo esc_html($tag->name); ?></a></li>
                                                    <?php endforeach;
                                                    endif;
                                                    ?>
                                                </ul>
                                            </div>
                                            <button class="good">
                                                <span class="good__item">♡</span>
                                                <span class="good__number">11</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 前・次・記事一覧のボタン
                        ------------------------------------------------->
                        <!-- <div class="blog-pagination">
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
                        <?php endif; ?> -->









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
                                                            <?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="Related-Posts-lead-sub">
                                                        <div class="Related-Posts-lead__date">
                                                            <span class="Related-Posts-lead__date_text"><?php echo get_the_date(); ?></span>
                                                        </div>
                                                        <div class="Related-Posts-lead__category">
                                                            <?php
                                                            $related_terms = get_the_terms(get_the_ID(), 'blog_cat');
                                                            if ($related_terms && !is_wp_error($related_terms)) :
                                                                $term = array_shift($related_terms);
                                                                $term_link = get_term_link($term);
                                                            ?>
                                                                <object class="Related-Posts-lead__category_text">
                                                                    <a class="Related-Posts-lead__category_link" href="<?php echo esc_url($term_link); ?>"><?php echo esc_html($term->name); ?></a>
                                                                </object>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="Related-Posts-lead__button">
                                                            <span class="Related-Posts-lead__button_heart">♡</span>
                                                            <span class="Related-Posts-lead__button_number">11</span>
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
                                        <p>関連記事はありません。</p>
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