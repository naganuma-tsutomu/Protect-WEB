<?php get_header('top'); ?>

<div class="wrapper">
    <div class="container">
        <ul class="column-box">
            <li class="listitem-left">
                <div class="listitem-right__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/about/about_01.webp')); ?>" alt="">
                </div>
            </li>
            <li class="listitem-right">
                <div class="listitem-right__box">
                    <div class="listitem-right__title">ABOUT US</div>
                    <div class="listitem-right__sub">WEB戦略とブランディング構築</div>
                </div>
                <div class="listitem-right__text">
                    いわき市でホームページ制作なら
                    PROTECT WEBにお任せください。
                </div>
                <div class="listitem-right__text">
                    新規WEBサイトの制作・既存WEBサイトのリニューアル・SEO対策等を丁寧なヒアリングをもとに、お客様の課題解決につながる最適なご提案をいたします。<br>
                    また、WEBだけでなくロゴやポスター、チラシ等のグラフィックデザインも幅広く手がけていますので、媒体を問わず一貫したブランディングの構築が可能です。お気軽にお問い合わせください。
                </div>
            </li>
        </ul>
    </div>

    <div class="container">
        <ul class="column-box">
            <li class="listitem-left pc">
                <div class="listitem-left__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/front/top_photocatalyst.webp')); ?>" alt="">
                </div>
            </li>
            <li class="listitem-right">
                <div class="listitem-right__box">
                    <div class="listitem-right__title"></div>
                    <div class="listitem-right__sub"></div>
                </div>
                <div class="listitem-left__img sp">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/front/top_photocatalyst.webp')); ?>" alt="">
                </div>
                <div class="listitem-right__text">
                </div>
                <div class="listitem-right__link">
                    <a href="<?php echo esc_url(home_url('/photocatalyst/')); ?>">
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/front/arrow_01.webp')); ?>" alt="→">詳細はこちら
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <div class="container">
        <ul class="column-box">
            <li class="listitem-left">
                <div class="listitem-left__box">
                    <div class="listitem-left__title"></div>
                    <div class="listitem-left__sub"></div>
                </div>
                <div class="listitem-right__img sp">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/front/top_interior.webp')); ?>" alt="内装全般">
                </div>
                <div class="listitem-left__text">
                </div>
                <div class="listitem-left__link">
                    <a href="<?php echo esc_url(home_url('/interior/')); ?>">
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/front/arrow_01.webp')); ?>" alt="→">詳細はこちら
                    </a>
                </div>
            </li>
            <li class="listitem-right pc">
                <div class="listitem-right__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/front/top_interior.webp')); ?>" alt="内装全般">
                </div>
            </li>
        </ul>
    </div>
</div>

<?php get_footer(); ?>