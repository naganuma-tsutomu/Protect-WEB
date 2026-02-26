<?php if (!is_front_page()) : ?>
    <ul class="breadcrumbs">
        <?php $home = esc_url(home_url('/'));
        if (!is_front_page()) : ?><?php /* TOPページ */ ?>
        <li class="breadcrumbs__list"><a class="breadcrumbs__list_home" href="<?php echo $home; ?>">HOME</a></li>
    <?php endif; ?>

    <?php if (is_archive()) : ?><?php /* アーカイブページ */ ?>
    <li class="breadcrumbs__list"><?php post_type_archive_title(); ?></li>
    <?php elseif (is_page()) : ?><?php /* 固定ページ */ ?>
    <?php if ($post->post_parent != 0) : // 投稿の親ページがあるかどうかを判別
            $ancestors = array_reverse($post->ancestors); // 投稿の祖先ページの ID を配列として取得
            foreach ($ancestors as $ancestor) : // 配列を一覧として表示
    ?>
            <li class="breadcrumbs__list"><a href="<?php echo esc_url(get_permalink($ancestor)); ?>"><?php echo get_the_title($ancestor); ?></a></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php $usces = filter_input(INPUT_GET, 'usces_page');
        if (null !== $usces) : ?>
        <?php if ('login' === $usces) {
                $text = 'ログイン';
            } elseif ('newmember' === $usces) {
                $text = '新規会員登録';
            } elseif ('lostmemberpassword' === $usces) {
                $text = 'パスワードを忘れた場合';
            } ?>
        <li class="breadcrumbs__list"><?php echo $text; ?></li>
    <?php else : ?>
        <li class="breadcrumbs__list"><?php the_title(); ?></li>
    <?php endif; ?>
<?php elseif (is_singular()) : ?>
    <?php $post_type = get_post_type_object(get_post_type($post));
    ?>
    <li class="breadcrumbs__list">
        <a href="<?php echo esc_url(home_url('/' . $post_type->name . '/')); ?>">
            <?php echo esc_html($post_type->label); ?>
        </a>
    </li>
    <li class="breadcrumbs__list"><?php the_title(); ?></li>
<?php //elseif (is_404()) : ?>
    <!--<li>ページが見つかりません</li>-->
<?php endif; ?>
    </ul>
<?php endif; ?>
