<!-- サイドバー
------------------------------------------------->
<div class="sidebar">
    <!-- 検索ボックス
    ------------------------------------------------->
    <form class="search-box">
        <div class="search-box__block">
            <input type="search" name="search" class="search-box__block_search" placeholder="キーワード検索" />
        </div>
        <div class="search-box__icon">
            <button type="submit" name="submit" class="search-box__icon_submit">
                <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </form>

    <!-- カテゴリ
    ------------------------------------------------->
    <div class="category">
        <div class="category-block">
            <ul class="category-item">
                <?php
                // タクソノミー名（'blog_cat'）を指定
                $cat_taxonomy = 'blog_cat';
                // get_terms() を使って、カテゴリをすべて取得
                $categories = get_terms(array(
                    'taxonomy'   => $cat_taxonomy, // 取得するタクソノミーを指定
                    'hide_empty' => true,         // 投稿が1つもないカテゴリを非表示
                ));

                // カテゴリが1つ以上存在し、エラーが発生していないかを確認
                if (! empty($categories) && ! is_wp_error($categories)) {
                    // 取得したカテゴリの数だけループ処理を実行
                    foreach ($categories as $category) {
                        // 各カテゴリのアーカイブページへのリンクURLを取得
                        $category_link = get_term_link($category);
                ?>
                        <li class="category-list">
                            <a class="category-list__link" href="<?php echo esc_url($category_link); ?>"><span class="category-list__box"><?php echo esc_html($category->name); ?></span></a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- タグ
    ------------------------------------------------->
    <div class="tag">
        <div class="tag-block">
            <ul class="tag-item">
                <?php
                // タクソノミー名（'blog_tag'）を指定
                $tag_taxonomy = 'blog_tag';
                // get_terms() を使って、タグをすべて取得
                $tags = get_terms(array(
                    'taxonomy' => $tag_taxonomy, // 取得するタクソノミーを指定
                    'hide_empty' => true, // 投稿がないタグは非表示
                ));

                // タグが1つ以上存在し、エラーが発生していないかを確認
                if (! empty($tags) && ! is_wp_error($tags)) {
                    // 取得したタグの数だけループ処理を実行
                    foreach ($tags as $tag) {
                        // 各タグのアーカイブページへのリンクURLを取得
                        $tag_link = get_term_link($tag);
                ?>
                        <li class="tag-list">
                            <a class="tag-list__link" href="<?php echo esc_url($tag_link); ?>">
                                <span class="tag-list__title">
                                    <?php echo '#' . esc_html($tag->name); ?>
                                </span>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- ピックアップ記事
    ------------------------------------------------->
    <div class="pickup">
        <ul class="blog-title">
            <li class="blog-title__button active">                    
                <a class="blog-title__button_link" href="">新着</a>
            </li>                    
            <li class="blog-title__button">
                <a class="blog-title__button_link" href="">人気</a>                    
            </li>                                        
        </ul>                                                            

        <!-- 新着記事一覧
        ------------------------------------------------->   
        <div class="Pickup-Posts active">
            <ul class="Pickup-Posts-list">

                <?php
                // get_postsに渡すパラメータを設定
                $new_posts = get_posts(array(
                    'post_type'      => 'blog', // 取得する投稿タイプを 'blog' に指定
                    'post_status'    => 'publish', //公開状態の投稿のみを取得
                    'numberposts'    => 5, //最大5つの投稿を取得
                    'orderby'        => 'date', //日付で並べ替え
                    'order'          => 'DESC', //新しい順（降順）
                ));
                ?>

                <?php if ($new_posts): ?>
                    <?php foreach ($new_posts as $post): setup_postdata($post); ?>
                        <li class="Pickup-Posts-item">
                            <a class="Pickup-Posts-item-link" href="<?php echo esc_url(get_permalink()); ?>" >
                                <div class="Pickup-Posts-lead">                        
                                    <div class="Pickup-Posts-lead__title">
                                        <div class="Pickup-Posts-lead__title_text">
                                        <?php the_title();  //タイトルを出力 ?>
                                        </div>
                                    </div>
                                    <div class="Pickup-Posts-lead-sub">                        
                                        <div class="Pickup-Posts-lead__date">
                                            <span class="Pickup-Posts-lead__date_text">
                                                <?php echo get_the_date(); //投稿日を出力 ?>
                                            </span>
                                        </div>
                                        <div class="Pickup-Posts-lead__category">
                                            <?php
                                            // 'blog_cat' タクソノミーのタームを取得
                                            $categories = get_the_terms(get_the_ID(), 'blog_cat');
                                            if (!empty($categories) && !is_wp_error($categories)) {
                                                // 最初のカテゴリを表示
                                                $category = $categories[0];
                                                $category_link = get_term_link($category);
                                            ?>
                                            <object class="Pickup-Posts-lead__category_text">
                                                <a class="Pickup-Posts-lead__category_link" href="<?php echo esc_url($category_link); ?>">
                                                    <?php echo esc_html($category->name); ?>
                                                </a>
                                            </object>
                                            <?php } ?>
                                        </div>
                                        <div class="Pickup-Posts-lead__button">
                                            <span class="Pickup-Posts-lead__button_heart">♡</span>
                                            <span class="Pickup-Posts-lead__button_number">11</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); // 投稿データをリセット ?>
                <?php else: ?>
                    <li class="Pickup-Posts-item">新着記事はありません。</li>
                <?php endif; ?>
            </ul>
                <button class="view-more">もっと見る...</button>
        </div>

        <!-- 人気記事一覧
        ------------------------------------------------->
        <div class="Pickup-Posts">
            <ul class="Pickup-Posts-list">

                <?php
                // get_postsに渡すパラメータを設定
                    $popular_posts = get_posts(array(
                    'post_type'      => 'blog', // 取得する投稿タイプを 'blog' に指定
                    'post_status'    => 'publish', //公開状態の投稿のみを取得
                    'numberposts'    => 5, //最大5つの投稿を取得
                    'orderby'        => 'count', //投稿数
                    'order'          => 'DESC', //多い順（降順）
                ));
                ?>

                <?php if ($popular_posts): ?>
                    <?php foreach ($popular_posts as $post): setup_postdata($post); ?>

                        <li class="Pickup-Posts-item">
                            <a class="Pickup-Posts-item-link" href="<?php echo esc_url(get_permalink()); ?>">
                                <div class="Pickup-Posts-lead">                        
                                    <div class="Pickup-Posts-lead__title">                        
                                        <div class="Pickup-Posts-lead__title_text">
                                            <?php the_title(); //タイトルを出力 ?>
                                        </div>                        
                                    </div>
                                </div>
                                <div class="Pickup-Posts-lead-sub">
                                    <div class="Pickup-Posts-lead__date">
                                        <span class="Pickup-Posts-lead__date_text">
                                            <?php echo get_the_date(); //投稿日を出力 ?>
                                        </span>
                                    </div>
                                    <div class="Pickup-Posts-lead__category">
                                        <?php 
                                        // 'blog_cat'タクソノミーのタームを取得
                                        $categories = get_the_terms(get_the_ID(), 'blog_cat');
                                        if(!empty($categories) && !is_wp_error($categories)) {
                                            //最初のカテゴリを表示
                                            $category = $categories[0];
                                            $category_link = get_term_link($category);
                                        ?>
                                        <object class="Pickup-Posts-lead__category_text">
                                            <a class="Pickup-Posts-lead__category_link" href="<?php echo esc_url($category_link); ?>">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        </object>
                                        <?php } ?>                                    
                                    </div>
                                    <div class="Pickup-Posts-lead__button">
                                        <span class="Pickup-Posts-lead__button_heart">♡</span>
                                        <span class="Pickup-Posts-lead__button_number">11</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); //投稿データをリセット ?>
                    <?php else: ?>
                        <li class="Pickup-Posts-item">人気記事はありません。</li>
                    <?php endif; ?>
            </ul>
            <button class="view-more">もっと見る...</button>
        </div>
    </div>              

    <!-- 目次
    ------------------------------------------------->
    <div class="sub-index">
        <div class="sub-index__title">目次</div>
            <ul class="sub-index-item">
                <li class="sub-index-list">
                    <a class="sub-index-list__link" href="#index-1">
                        <i class="fa-regular fa-square"></i>
                        はじめに</a>
                </li>
                <li class="sub-index-list">
                    <a class="sub-index-list__link" href="#index-2">
                        <i class="fa-regular fa-square"></i>
                            最初は「AIをどんどん使わせていた」</a>
                </li>
                <li class="sub-index-list">
                    <a class="sub-index-list__link" href="#index-3">
                        <i class="fa-regular fa-square"></i>
                            レビュー830件の衝撃</a>
                </li>
                <li class="sub-index-list">
                    <a class="sub-index-list__link" href="#index-4">
                        <i class="fa-regular fa-square"></i>
                            「AIを神だと思っていました」</a>
                </li>
                <li class="sub-index-list">
                    <a class="sub-index-list__link" href="#index-5">
                        <i class="fa-regular fa-square"></i>
                            AI禁止令</a>
                </li>
            </ul>
        </div>
    </div>
</div>