<?php /* single-works */ ?>
<div id="works-single" class="works-single">
    <div class="container">
        <div class="contents_title">WORKS</div>
        <div class="contents_subtitle">制作実績</div>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            /* SCF各フィールド配列取り出し */
            $product_all = get_field('works_product');
            $cate_all = get_field('works_category');
            $plan_all = get_field('works_plan');
            $works_text = nl2br(get_field('works_text'));

            if ($product_all && $cate_all && $plan_all) {
                $product_label = $product_all['label'];
                $product_value = $product_all['value'];
                $cate_label = $cate_all['label'];
                $cate_value = $cate_all['value'];
                $plan_label = $plan_all['label'];
                $plan_value = $plan_all['value'];
            }
            ?>

            <h2 class="works-single__client"><?php the_title(); ?> 様</h2>
            <div class="works-single__product"><?php echo $product_label; ?></div>
            <div class="works-single__topimg">
                <div class="works-single__topimg_box">
                    <div class="works-single__topimg_box_pc">
                        <img src="<?php the_field('works_topimg_pc'); ?>" alt="<?php the_field('works_client'); ?>">
                    </div>
                    <div class="works-single__topimg_box_sp">
                        <img src="<?php the_field('works_topimg_sp'); ?>" alt="<?php the_field('works_client'); ?>">
                    </div>
                </div>
            </div>

            <div class="works-single__list">
                <ul>
                    <li><span class="works-single__list_item">クライアント：</span><span><?php the_field('works_client'); ?> 様</span></li>
                    <li><span class="works-single__list_item">URL：</span><span><a href="<?php the_field('works_url'); ?>"><?php the_field('works_url'); ?></a></span></li>
                    <li><span class="works-single__list_item">制作内容：</span><span><?php echo $product_label; ?></span></li>
                    <li><span class="works-single__list_item">CATEGORY：</span><span><?php echo $cate_label; ?></span></li>
                    <li><span class="works-single__list_item">PLAN：</span><span><?php echo $plan_label; ?></span></li>
                    <li class="works-single__list_text"><span class="works-single__list_item"></span><span><?php echo $works_text; ?></span></li>
                </ul>
            </div>
            <div class="works-single__design">
                <div class="text-line-right">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/works/works_icon_pc.webp')); ?>" alt="PCサイトデザイン"><span>PCサイトデザイン</span>
                </div>
                <div class="works-single__design_pc">
                    <img src="<?php echo the_field('works_pc_img01'); ?>" alt="<?php the_field('works_client'); ?>_01">
                    <img src="<?php echo the_field('works_pc_img02'); ?>" alt="<?php the_field('works_client'); ?>_02">
                    <img src="<?php echo the_field('works_pc_img03'); ?>" alt="<?php the_field('works_client'); ?>_03">
                </div>
                <div class="text-line-right">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/works/works_icon_sp.webp')); ?>" alt="スマートフォンサイトデザイン"><span>スマートフォンサイトデザイン</span>
                </div>
                <div class="works-single__design_sp pc">
                    <img src="<?php echo the_field('works_sp_img01'); ?>" alt="<?php the_field('works_client'); ?>_01">
                    <img src="<?php echo the_field('works_sp_img02'); ?>" alt="<?php the_field('works_client'); ?>_02">
                    <img src="<?php echo the_field('works_sp_img03'); ?>" alt="<?php the_field('works_client'); ?>_03">
                </div>
                <div class="works-single__design_sp swiper sp">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="<?php echo the_field('works_sp_img01'); ?>" alt="<?php the_field('works_client'); ?>_01"></div>
                        <div class="swiper-slide"><img src="<?php echo the_field('works_sp_img02'); ?>" alt="<?php the_field('works_client'); ?>_02"></div>
                        <div class="swiper-slide"><img src="<?php echo the_field('works_sp_img03'); ?>" alt="<?php the_field('works_client'); ?>_03"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <!--<div class="swiper-scrollbar"></div>-->
                </div>
            </div>
    <?php endwhile;
    endif; ?>

    <div class="works__linkbox">
        <div class="works__linkbox_info">
            <div class="works__linkbox_info_caption">ホームページ制作のご相談はお気軽に</div>
            <div class="works__linkbox_info_text">
                見積りは無料で承っておりますので、まずはお気軽にお問い合わせください。<br>
                お客様のイメージやご予算に応じた最適なご提案をさせていただきます。
            </div>
        </div>
        <div class="works__linkbox_link">
            <div class="works__linkbox_link_estimate">
                <a href="<?php echo esc_url(home_url('/order/')); ?>">
                    <div class="works__linkbox_link_estimate_button">
                        <div><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/order/order_01.webp')); ?>" alt="お見積りフォーム">お見積りフォーム</div>
                    </div>
                </a>
            </div>
            <div class="works__linkbox_link_contact">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                    <div class="works__linkbox_link_contact_button">
                        <div><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/contact/contact_mail.webp')); ?>" alt="お問い合わせ">お問い合わせ</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>