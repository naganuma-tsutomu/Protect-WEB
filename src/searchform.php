<form class="search-box" action="<?php echo esc_url(home_url('/')); ?>" method="get">
    <div class="search-box__block">
            <input class="search-box__block_search" name="s" type="text" placeholder="キーワード検索" />
        </div>
        <div class="search-box__icon">
            <button type="submit" name="submit" class="search-box__icon_submit">
                <i class="fa-solid fa-magnifying-glass"></i>
        </div>
</form>