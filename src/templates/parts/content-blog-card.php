<li class="blog-card">
    <a class="blog-card__link" href="<?php the_permalink(); ?>">
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
                            <?php render_taxonomy_links($cat_term_data, $blog_cat, 'lead-sub__cat-area_link'); ?>
                        </object>
                    </div>
                <?php endif; ?>

                <!-- タグ取得 -->
                <?php if ($tag_term_data = get_the_taxonomy_data($blog_tag, get_the_ID())) : ?>
                    <div class="lead-sub__tag">
                        <object class="lead-sub__tag-area">
                            <?php render_taxonomy_links($tag_term_data, $blog_tag, 'lead-sub__tag-area_link'); ?>
                        </object>
                    </div>
                <?php endif; ?>

                <!-- いいね取得 -->
                <div class="lead-sub__button" data-post-id="<?php the_ID(); ?>" style="pointer-events: none;">
                    <span class="lead-sub__button-heart lead-sub__button-heart--icon">♡</span>
                    <span class="lead-sub__button-heart_number"><?php echo get_post_like_count(get_the_ID()); ?></span>
                </div>
            </div>
        </div>
    </a>
</li>