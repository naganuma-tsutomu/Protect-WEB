<!-- サイドバー
------------------------------------------------->
<div class="sidebar">
    <!-- 検索ボックス
    ------------------------------------------------->
    <?php //フォームを読み込む
    get_search_form()
    ?>

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
                        // カテゴリ名をキーワードとした検索URLを生成
                        $category_link = home_url('/') . '?s=' . urlencode($category->name) . '&blog_cat=' . $category->slug;
                ?>
                        <li class="category-list active">
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
                        // タグ名をキーワードとした検索URLを生成
                        $tag_link = home_url('/') . '?s=' . urlencode($tag->name) . '&blog_tag=' . $tag->slug;
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

    <?php //archive-blog.php内ではピックアップ記事と目次は表示させない。
    if ( ! is_post_type_archive( 'blog' ) ) :
    ?>
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
                        'numberposts'    => 10, //表示数を増やす（例: 10件）
                        'orderby'        => 'date', //日付で並べ替え
                        'order'          => 'DESC', //新しい順（降順）
                    ));
                    ?>

                    <?php if ($new_posts): ?>
                        <?php foreach ($new_posts as $key => $post): setup_postdata($post); ?>
                            <?php
                            // 6件目以降（インデックス5以上）は初期状態で非表示にするクラスとスタイルを付与
                            $hidden_class = ($key >= 5) ? ' is-hidden-new' : '';
                            $hidden_style = ($key >= 5) ? ' style="display:none;"' : '';
                            ?>
                            <li class="Pickup-Posts-item<?php echo $hidden_class; ?>"<?php echo $hidden_style; ?>>
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
                                                    // カテゴリ名をキーワードとした検索URLを生成
                                                    $category_link = home_url('/') . '?s=' . urlencode($category->name) . '&blog_cat=' . $category->slug;
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
                <?php if (count($new_posts) > 5) : ?>
                    <!-- クリックで非表示要素を表示し、ボタン自身を隠す -->
                    <button class="view-more" onclick="document.querySelectorAll('.is-hidden-new').forEach(e => e.style.display = 'block'); this.style.display='none';">もっと見る...</button>
                <?php endif; ?>
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
                        'numberposts'    => 10, //表示数を増やす
                        'orderby'        => 'count', //投稿数
                        'order'          => 'DESC', //多い順（降順）
                    ));
                    ?>

                    <?php if ($popular_posts): ?>
                        <?php foreach ($popular_posts as $key => $post): setup_postdata($post); ?>
                            <?php
                            // 6件目以降は初期状態で非表示
                            $hidden_class = ($key >= 5) ? ' is-hidden-popular' : '';
                            $hidden_style = ($key >= 5) ? ' style="display:none;"' : '';
                            ?>
                            <li class="Pickup-Posts-item<?php echo $hidden_class; ?>"<?php echo $hidden_style; ?>>
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
                                                    // カテゴリ名をキーワードとした検索URLを生成
                                                    $category_link = home_url('/') . '?s=' . urlencode($category->name) . '&blog_cat=' . $category->slug;
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
                        <?php wp_reset_postdata(); //投稿データをリセット ?>
                        <?php else: ?>
                            <li class="Pickup-Posts-item">人気記事はありません。</li>
                        <?php endif; ?>
                </ul>
                <?php if (count($popular_posts) > 5) : ?>
                    <!-- クリックで非表示要素を表示し、ボタン自身を隠す -->
                    <button class="view-more" onclick="document.querySelectorAll('.is-hidden-popular').forEach(e => e.style.display = 'block'); this.style.display='none';">もっと見る...</button>
                <?php endif; ?>
            </div>
        </div> 

        <!-- 目次
        ------------------------------------------------->
        <?php
        // 本文からh2タグを抽出して目次を生成
        $index_content = apply_filters('the_content', get_the_content());
        if (preg_match_all('/<h2.*?>+(.*?)<\/h2>/i', $index_content, $matches)) :
        ?>
            <div class="sub-index">
                <div class="sub-index__title">目次</div>
                <ol class="sub-index-item">
                <?php //抽出された見出しの配列を1つずつ取り出す
                //$key=連番（インデックス）,$title=h2のテキスト
                foreach ($matches[1] as $key => $title) : ?>
                    <li class="sub-index-list">
                        <i class="fa-regular fa-square"></i>
                        <a class="sub-index-list__link" href="#index-<?php echo $key; ?>"><?php echo strip_tags($title); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>
