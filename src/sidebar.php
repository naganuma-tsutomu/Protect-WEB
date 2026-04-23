<!-- サイドバー
------------------------------------------------->
<div class="sidebar">
    <?php
    // 現在選択されているカテゴリとタグのスラッグをURLパラメータから取得
    $current_cat_slug = isset($_GET['blog_cat']) ? sanitize_text_field($_GET['blog_cat']) : '';
    $current_tag_slug = isset($_GET['blog_tag']) ? sanitize_text_field($_GET['blog_tag']) : '';
    ?>

    <!-- 検索ボックス
    ------------------------------------------------->
    <?php //フォームを読み込む
    get_search_form()
    ?>

    <!-- カテゴリ
    ------------------------------------------------->
    <?php
    $cat_terms = \modules\Taxonomy_Helper::get_all_term_links('blog_cat', $current_cat_slug);
    if (!empty($cat_terms)):
    ?>
        <div class="category">
            <div class="category-block">
                <ul class="category-item">
                    <?php get_template_part('templates/parts/term-links', null, [
                        'terms'      => $cat_terms,
                        'link_class' => 'category-list__link',
                        'span_class' => 'category-list__item',
                        'tag'        => 'li',
                        'tag_class'  => 'category-list',
                    ]); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <!-- タグ
    ------------------------------------------------->
    <?php
    $tag_terms = \modules\Taxonomy_Helper::get_all_term_links('blog_tag', $current_tag_slug);
    if (!empty($tag_terms)):
    ?>
        <div class="tag">
            <div class="tag-block">
                <ul class="tag-item">
                    <?php get_template_part('templates/parts/term-links', null, [
                        'terms'      => $tag_terms,
                        'prefix'     => '#',
                        'link_class' => 'tag-list__link',
                        'span_class' => 'tag-list__item',
                        'tag'        => 'li',
                        'tag_class'  => 'tag-list',
                    ]); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <?php //archive-blog.php内ではピックアップ記事と目次は表示させない。
    if (!is_post_type_archive('blog')):
    ?>
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
            <div class="Pickup-Posts active">
                <ul class="Pickup-Posts-list">

                    <?php
                    // get_postsに渡すパラメータを設定
                    $new_posts = get_posts(array(
                        'post_type' => 'blog', // 取得する投稿タイプを 'blog' に指定
                        'post_status' => 'publish', //公開状態の投稿のみを取得
                        'numberposts' => 10, //表示数を増やす（例: 10件）
                        'orderby' => 'date', //日付で並べ替え
                        'order' => 'DESC', //新しい順（降順）
                    ));
                    ?>

                    <?php if ($new_posts): ?>
                        <?php foreach ($new_posts as $key => $post):
                            setup_postdata($post); ?>
                            <?php
                            // 6件目以降（インデックス5以上）は初期状態で非表示にするクラスとスタイルを付与
                            $hidden_class = ($key >= 5) ? ' is-hidden-new' : '';
                            $hidden_style = ($key >= 5) ? ' style="display:none;"' : '';
                            ?>
                            <li class="Pickup-Posts-item<?php echo $hidden_class; ?>" <?php echo $hidden_style; ?>>
                                <a class="Pickup-Posts-item-link" href="<?php echo esc_url(get_permalink()); ?>">
                                    <div class="Pickup-Posts-lead">
                                        <div class="Pickup-Posts-lead__title">
                                            <div class="Pickup-Posts-lead__title_text">
                                                <?php the_title();  //タイトルを出力 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="Pickup-Posts-lead-sub">
                                            <div class="Pickup-Posts-lead__date">
                                                <span class="Pickup-Posts-lead__date_text">
                                                    <?php echo get_the_date(); //投稿日を出力 
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="Pickup-Posts-lead__category">
                                                <?php
                                                // 'blog_cat' タクソノミーのタームを取得
                                                $first_cat = \modules\Taxonomy_Helper::get_first_term_link(get_the_ID(), 'blog_cat', $current_cat_slug);
                                                if ($first_cat):
                                                ?>
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <?php get_template_part('templates/parts/term-links', null, [
                                                            'terms' => [$first_cat],
                                                            'link_class' => 'Pickup-Posts-lead__category_link',
                                                            'span_class' => 'Pickup-Posts-lead__category_item',
                                                        ]); ?>
                                                    </object>
                                                <?php endif; ?>
                                            </div>
                                            <div class="Pickup-Posts-lead__button" data-post-id="<?php the_ID(); ?>"
                                                style="pointer-events: none;">
                                                <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                <span class="Pickup-Posts-lead__button_number">
                                                    <?php echo \modules\Blog_Helper::get_like_count(get_the_ID()); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); // 投稿データをリセット 
                        ?>
                    <?php else: ?>
                        <li class="Pickup-Posts-item empty">新着記事はありません。</li>
                    <?php endif; ?>
                </ul>
                <?php if (count($new_posts) > 5): ?>
                    <!-- クリックで非表示要素を表示し、ボタン自身を隠す -->
                    <button class="view-more"
                        onclick="document.querySelectorAll('.is-hidden-new').forEach(e => e.style.display = 'block'); this.style.display='none';">もっと見る...</button>
                <?php endif; ?>
            </div>

            <!-- 人気記事一覧
            ------------------------------------------------->
            <div class="Pickup-Posts">
                <ul class="Pickup-Posts-list">

                    <?php
                    // get_postsに渡すパラメータを設定
                    $popular_posts = get_posts(array(
                        'post_type' => 'blog', // 取得する投稿タイプを 'blog' に指定
                        'post_status' => 'publish', //公開状態の投稿のみを取得
                        'numberposts' => 10, //表示数を増やす
                        'meta_key' => '_post_like_count', // いいね数が格納されているキーを指定
                        'orderby' => 'meta_value_num', // カスタムフィールドの値を数値として比較
                        'order' => 'DESC', //多い順（降順）
                    ));
                    ?>

                    <?php if ($popular_posts): ?>
                        <?php foreach ($popular_posts as $key => $post):
                            setup_postdata($post); ?>
                            <?php
                            // 6件目以降は初期状態で非表示
                            $hidden_class = ($key >= 5) ? ' is-hidden-popular' : '';
                            $hidden_style = ($key >= 5) ? ' style="display:none;"' : '';
                            ?>
                            <li class="Pickup-Posts-item<?php echo $hidden_class; ?>" <?php echo $hidden_style; ?>>
                                <a class="Pickup-Posts-item-link" href="<?php echo esc_url(get_permalink()); ?>">
                                    <div class="Pickup-Posts-lead">
                                        <div class="Pickup-Posts-lead__title">
                                            <div class="Pickup-Posts-lead__title_text">
                                                <?php the_title();  //タイトルを出力 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="Pickup-Posts-lead-sub">
                                            <div class="Pickup-Posts-lead__date">
                                                <span class="Pickup-Posts-lead__date_text">
                                                    <?php echo get_the_date(); //投稿日を出力 
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="Pickup-Posts-lead__category">
                                                <?php
                                                // 'blog_cat' タクソノミーのタームを取得
                                                $first_cat = \modules\Taxonomy_Helper::get_first_term_link(get_the_ID(), 'blog_cat', $current_cat_slug);
                                                if ($first_cat):
                                                ?>
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <?php get_template_part('templates/parts/term-links', null, [
                                                            'terms' => [$first_cat],
                                                            'link_class' => 'Pickup-Posts-lead__category_link',
                                                            'span_class' => 'Pickup-Posts-lead__category_item',
                                                        ]); ?>
                                                    </object>
                                                <?php endif; ?>
                                            </div>
                                            <div class="Pickup-Posts-lead__button" data-post-id="<?php the_ID(); ?>"
                                                style="pointer-events: none;">
                                                <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                <span class="Pickup-Posts-lead__button_number">
                                                    <?php echo \modules\Blog_Helper::get_like_count(get_the_ID()); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); //投稿データをリセット 
                        ?>
                    <?php else: ?>
                        <li class="Pickup-Posts-item empty">人気記事はありません。</li>
                    <?php endif; ?>
                </ul>
                <?php if (count($popular_posts) > 5): ?>
                    <!-- クリックで非表示要素を表示し、ボタン自身を隠す -->
                    <button class="view-more"
                        onclick="document.querySelectorAll('.is-hidden-popular').forEach(e => e.style.display = 'block'); this.style.display='none';">もっと見る...</button>
                <?php endif; ?>
            </div>
        </div>

        <!-- 目次
        ------------------------------------------------->
        <?php
        // single-blog.phpで保存したフィルタ済みコンテンツを再利用する
        global $protect_web_filtered_content;
        if (!empty($protect_web_filtered_content) && preg_match_all('/<h2.*?>+(.*?)<\/h2>/i', $protect_web_filtered_content, $matches)):
        ?>
            <div class="sub-index">
                <div class="sub-index__title">目次</div>
                <ol class="sub-index-item">
                    <?php //抽出された見出しの配列を1つずつ取り出す
                    //$key=連番（インデックス）,$title=h2のテキスト
                    foreach ($matches[1] as $key => $title): ?>
                        <li class="sub-index-list">
                            <i class="fa-regular fa-square"></i>
                            <a class="sub-index-list__link" href="#index-<?php echo $key; ?>">
                                <?php echo strip_tags($title); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>