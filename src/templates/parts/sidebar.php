<?php /* sidebar */ ?>
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
                    $categories = get_terms( array(
                    'taxonomy'   => $cat_taxonomy, // 取得するタクソノミーを指定
                    'hide_empty' => true,         // 投稿が1つもないカテゴリを非表示
                    ) );

                    // カテゴリが1つ以上存在し、エラーが発生していないかを確認
                    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                    // 取得したカテゴリの数だけループ処理を実行
                    foreach ( $categories as $category ) {
                     // 各カテゴリのアーカイブページへのリンクURLを取得
                    $category_link = get_term_link( $category );
                ?>
                <li class="category-list">
                    <a class="category-list__link" href="<?php echo esc_url( $category_link ); ?>"><span class="category-list__box"><?php echo esc_html( $category->name ); ?></span></a>
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
                    $tags = get_terms( array(
                        'taxonomy' => $tag_taxonomy, // 取得するタクソノミーを指定
                        'hide_empty' => true, // 投稿がないタグは非表示
                    ) );

                    // タグが1つ以上存在し、エラーが発生していないかを確認
                    if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
                    // 取得したタグの数だけループ処理を実行
                    foreach ( $tags as $tag ) {
                    // 各タグのアーカイブページへのリンクURLを取得
                    $tag_link = get_term_link( $tag );
                ?>
                <li class="tag-list">
                    <a class="tag-list__link" href="<?php echo esc_url( $tag_link ); ?>">
                        <span class="tag-list__title">
                            <?php echo '#' . esc_html( $tag->name ); ?>
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
</div>