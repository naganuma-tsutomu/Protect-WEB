<?php 
    // 配列から値を取得する(キーが指定されているか確認)
    $post_index = isset($args['key']) ? $args['key'] : 0;
    $type = isset($args['type']) ? $args['type'] : 'news';
    // 値が5以上ならclassとstyleを追加する
    // $hidden_class = $post_index >= 5 ? ' is-hidden-' . $type : '';
    // $hidden_style = $post_index >= 5 ? ' style="display:none;"' : '';
    if($post_index >= 5) {
        $hidden_class = ' is-hidden-' . $type;
        $hidden_style = ' style="display:none;"';
    }else{
        $hidden_class = $hidden_style = '';
    }
?>

<li class="pickup-posts-item<?php echo $hidden_class; ?>"<?php echo $hidden_style; ?>>
    <a class="pickup-posts-item-link" href="<?php echo esc_url(get_permalink()); ?>" >
        <div class="pickup-posts-lead">                        
            <div class="pickup-posts-lead__title">
                <div class="pickup-posts-lead__title_text">
                    <?php the_title();  //タイトルを出力 ?>
                </div>
            </div>
            <div class="pickup-posts-lead-sub">                        
                <div class="pickup-posts-lead-sub__date">
                    <span class="pickup-posts-lead-sub__date_text">
                        <?php echo get_the_date(); //投稿日を出力 ?>
                    </span>
                </div>
                <div class="pickup-posts-lead-sub__category">
                    <?php
                    $blog_cat = 'blog_cat';
                    // $blog_cat タクソノミーのタームを取得
                    $categories = get_the_terms(get_the_ID(), $blog_cat);
                    if (!empty($categories) && !is_wp_error($categories)) {
                        // 最初のカテゴリを表示
                        $category = $categories[0];
                    ?>
                        <object class="pickup-posts-lead-sub__category-item">
                            <span class="pickup-posts-lead-sub__category-item_text">
                                <?php echo esc_html($category->name); ?>
                            </span>
                        </object>
                    <?php } ?>
                </div>
                <div class="pickup-posts-lead-sub__button" data-post-id="<?php the_ID(); ?>" style="pointer-events: none;">
                    <span class="pickup-posts-lead-sub__button-heart">♡</span>
                    <span class="pickup-posts-lead-sub__button-heart_number"><?php echo get_post_like_count(get_the_ID()); ?></span>
                </div>
            </div>
        </div>
    </a>
</li>