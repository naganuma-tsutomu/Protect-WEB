<form class="search-box" action="<?php echo esc_url(home_url('/')); //WordPressのトップページのURLを取得?>" method="get">
    <div class="search-box__block">    
        <?php
        $search_keyword = '';
        // is_search() は検索結果ページかどうかを判定します。
        // カテゴリやタグの絞り込みではない、純粋なキーワード検索の場合にのみ検索ボックスにキーワードを表示します。
        if ( is_search() && !isset($_GET['blog_cat']) && !isset($_GET['blog_tag']) ) {
            $search_keyword = get_search_query();
        }
        ?>
        <input class="search-box__block_search" name="s" type="text" placeholder="キーワード検索" value="<?php echo esc_attr($search_keyword); ?>" />
    </div>
    <div class="search-box__icon">
        <button type="submit" class="search-box__icon_submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
</form>