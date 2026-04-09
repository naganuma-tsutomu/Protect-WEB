</main>
<footer id="page-top">
    <div class="footer">
        <div class="footer__contents">
            <ul class="footer__contents_info sp">
                <li>
                    <div class="footer__contents_info_title"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/footer/logo.webp')); ?>" alt="PROTECT WEB CREATION">PROTECT WEB CREATION</div>
                    <div class="footer__contents_menu_contact">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                            <div class="footer__contents_menu_contact_button">お問い合わせ</div>
                        </a>
                    </div>
                    <div class="footer__contents_menu_tel"><span>TEL</span> <a href=”tel:0246-85-5811″>0246-85-5811</a></div>
                </li>
                <li>
                    <div class="footer__contents_menu_sns">
                        <a href="https://www.instagram.com/pwc_web/"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/footer/footer_icon_insta.webp')); ?>" alt="PROTECT WEB CREATION_insta"></a>
                        <a href="https://x.com/pwc_web"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/footer/footer_icon_x.webp')); ?>" alt="PROTECT WEB CREATION_X"></a>
                    </div>
                </li>
                <li class="footer__contents_menu_copyright">Copyright© <?php echo date('Y'); ?> 株式会社プロテクト All Rights Reserved.</li>
            </ul>

            <ul class="footer__contents_info pc">
                <li>
                    <div class="footer__contents_info_title"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/footer/logo.webp')); ?>" alt="PROTECT WEB CREATION">PROTECT WEB CREATION</div>
                    <div class="footer__contents_menu_contact">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                            <div class="footer__contents_menu_contact_button">お問い合わせ</div>
                        </a>
                    </div>
                    <div class="footer__contents_menu_tel">TEL：<a href=”tel:0246-85-5811″>0246-85-5811</a></div>
                </li>
                <li>
                    <div class="footer__contents_menu_sns">
                        <a href="https://www.instagram.com/pwc_web/"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/footer/footer_icon_insta.webp')); ?>" alt="PROTECT WEB CREATION_insta"></a>
                        <a href="https://x.com/pwc_web"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/footer/footer_icon_x.webp')); ?>" alt="PROTECT WEB CREATION_X"></a>
                    </div>
                </li>
                <li class="pc">
                    <?php
                    // 現在のページに応じたスラッグを判定（メニューのアクティブ表示用）
                    $current_slug = '';
                    if (is_front_page()) {
                        $current_slug = 'home';
                    } elseif (is_post_type_archive('blog') || is_singular('blog') || is_tax('blog_cat') || is_tax('blog_tag') || is_search()) {
                        // ブログ・検索関連ページは一括で 'blog' とする
                        $current_slug = 'blog';
                    } elseif (is_page()) {
                        // 固定ページの場合は投稿スラッグを取得
                        $current_slug = get_post_field('post_name');
                    }
                    ?>
                    <div class="footer__contents_menu_list">
                        <div class="menu_home"><a href="<?php echo esc_url(home_url()); ?>">HOME</a></div>
                        <div class="menu_service"><a href="<?php echo esc_url(home_url()); ?>#service">SERVICE</a></div>
                        <?php // 各項目のスラッグが現在のページと一致する場合に 'is-active' クラスを付与 ?>
                        <div class="menu_plan <?php echo ($current_slug === 'plan') ? 'is-active' : ''; ?>"><a href="<?php echo esc_url(home_url('/plan/')); ?>">PLAN</a></div>
                        <div class="menu_blog <?php echo ($current_slug === 'blog') ? 'is-active' : ''; ?>"><a href="<?php echo esc_url(home_url('/archives/blog/')); ?>">BLOG</a></div>
                        <div class="menu_order <?php echo ($current_slug === 'order') ? 'is-active' : ''; ?>"><a href="<?php echo esc_url(home_url('/order/')); ?>">ORDER</a></div>
                        <div class="menu_contact <?php echo ($current_slug === 'contact') ? 'is-active' : ''; ?>"><a href="<?php echo esc_url(home_url('/contact/')); ?>">CONTACT</a></div>
                    </div>
                </li>
                <li class="footer__contents_menu_copyright">Copyright© <?php echo date('Y'); ?> <a href="https://kk-protect.co.jp/">株式会社プロテクト</a> All Rights Reserved.</li>
            </ul>
        </div>
    </div>
    <?php // ページトップボタン ?>
    <div id="js-pagetop" class="js-pagetop pagetop">
        <div class="pagetop__contents">
        <a class="pagetop__contents_button" href="#">TOP</a>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>