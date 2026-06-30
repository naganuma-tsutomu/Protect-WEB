<!-- サイドバー
------------------------------------------------->
<div class="sidebar">
    <?php
    $blog_cat = 'blog_cat';
    $blog_tag = 'blog_tag';
    // 現在選択されているカテゴリとタグのスラッグをURLパラメータから取得
    $current_cat_slug = isset($_GET[$blog_cat]) ? sanitize_text_field($_GET[$blog_cat]) : '';
    $current_tag_slug = isset($_GET[$blog_tag]) ? sanitize_text_field($_GET[$blog_tag]) : '';
    ?>

    <!-- 検索ボックス
    ------------------------------------------------->
    <?php //フォームを読み込む
    get_search_form()
    ?>

    <!-- カテゴリ
    ------------------------------------------------->
    <?php if ($cat_term_data = get_the_taxonomy_data($blog_cat)) : ?>
        <div class="category">
            <div class="category-block">
                <ul class="category-item">
                    <?php render_taxonomy_links($cat_term_data, $blog_cat, 'category-list__link', 'category-list'); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <!-- タグ
    ------------------------------------------------->
    <?php if ($tag_term_data = get_the_taxonomy_data($blog_tag)) : ?>
        <div class="tag">
            <div class="tag-block">
                <ul class="tag-item">
                    <?php render_taxonomy_links($tag_term_data, $blog_tag, 'tag-list__link', 'tag-list'); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    
        <!-- ピックアップ記事
        ------------------------------------------------->
        <div class="pickup">
            <ul class="blog-title">
                <li class="blog-title__button active">                    
                    <span class="blog-title__button_link active">新着</span>
                </li>                    
                <li class="blog-title__button">
                    <span class="blog-title__button_link">人気</span>                    
                </li>                                        
            </ul>                                                            

            <!-- 新着記事一覧
            ------------------------------------------------->   
            <div class="pickup-posts active">
                <ul class="pickup-posts-list">

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
                            // ピックアップ記事を出力
                            get_template_part('templates/parts/pickup-posts', null, array(
                                'key' => $key,
                                'type' => 'new', //新着記事
                            ));
                            ?>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); // 投稿データをリセット ?>
                    <?php else: ?>
                        <li class="pickup-posts-item empty">新着記事はありません。</li>
                    <?php endif; ?>
                </ul>
                <?php if (count($new_posts) > 5) : ?>
                    <!-- クリックで非表示要素を表示し、ボタン自身を隠す -->
                    <button class="view-more" onclick="document.querySelectorAll('.is-hidden-new').forEach(e => e.style.display = 'block'); this.style.display='none';">もっと見る...</button>
                <?php endif; ?>
            </div>

            <!-- 人気記事一覧
            ------------------------------------------------->
            <div class="pickup-posts">
                <ul class="pickup-posts-list">

                    <?php
                    // get_postsに渡すパラメータを設定
                        $popular_posts = get_posts(array(
                        'post_type'      => 'blog', // 取得する投稿タイプを 'blog' に指定
                        'post_status'    => 'publish', //公開状態の投稿のみを取得
                        'numberposts'    => 10, //表示数を増やす
                        'meta_key'       => '_post_like_count', // いいね数が格納されているキーを指定
                        'orderby'        => 'meta_value_num', // カスタムフィールドの値を数値として比較
                        'order'          => 'DESC', //多い順（降順）
                    ));
                    ?>

                    <?php if ($popular_posts): ?>
                        <?php foreach ($popular_posts as $key => $post): setup_postdata($post); ?>
                            <?php
                            // ピックアップ記事を出力
                            get_template_part('templates/parts/pickup-posts', null, array(
                                'key' => $key,
                                'type' => 'popular',//人気記事
                            ));
                            ?>

                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); //投稿データをリセット ?>
                        <?php else: ?>
                            <li class="pickup-posts-item empty">人気記事はありません。</li>
                        <?php endif; ?>
                </ul>
                <?php if (count($popular_posts) > 5) : ?>
                    <!-- クリックで非表示要素を表示し、ボタン自身を隠す -->
                    <button class="view-more" onclick="document.querySelectorAll('.is-hidden-popular').forEach(e => e.style.display = 'block'); this.style.display='none';">もっと見る...</button>
                <?php endif; ?>
            </div>
        </div> 

    <?php // blogアーカイブおよび検索結果ページでは目次を表示しない
    if ( ! is_post_type_archive( 'blog' ) && ! is_search() ) :
    ?>
    
        <!-- 目次
        ------------------------------------------------->
        <?php
        // single-blog.phpで保存したフィルタ済みコンテンツを再利用する
        global $protect_web_filtered_content;

        // クラス付きのタグでも、h2/h3のタグ名と中身のテキストを確実に別々でキャッチする正規表現
        if (!empty($protect_web_filtered_content) && preg_match_all('/<(h[23])(?:\s[^>]*?)?>(.*?)<\/h[23]>/i', $protect_web_filtered_content, $matches)) :
        ?>
            <div class="sub-index">
                <div class="sub-index__title">目次</div>
                <ol class="sub-index-item">
                <?php 
                // $matches[1] には "h2" または "h3" が入る
                // $matches[2] には見出しのテキストが入る（これでh2の文字消えを解決）
                foreach ($matches[1] as $key => $tag) : 
                    $title = $matches[2][$key];
                    $tag = strtolower($tag);

                    // h2とh3でクラス名を完全に分ける（これで確実に字下げとh2の直後判定ができます）
                    if ($tag === 'h3') {
                        $item_class = 'sub-index-list sub-index-list--h3';
                    } else {
                        $item_class = 'sub-index-list sub-index-list--h2';
                    }
                ?>
                    <li class="<?php echo $item_class; ?>">
                        <?php if ($tag === 'h3') : ?>
                            <i class="fa-regular fa-circle"></i> <?php else : ?>
                            <i class="fa-regular fa-square"></i> <?php endif; ?>
                        
                        <a class="sub-index-list__link" href="#index-<?php echo $key; ?>"><?php echo strip_tags($title); ?></a>
                    </li>
                <?php endforeach; ?>
                </ol>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>
