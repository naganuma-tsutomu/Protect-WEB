<?php
global $post;
if (!is_front_page()) : ?>
    <ul class="breadcrumbs">
        <?php $home = esc_url(home_url('/'));
        if (!is_front_page()) : ?><?php /* TOPページ */ ?>
        <li class="breadcrumbs__list"><a class="breadcrumbs__list_home" href="<?php echo $home; ?>">HOME</a></li>
    <?php endif; ?>

    <?php if (is_search()) : ?><?php /* 検索結果ページ */ ?>
        <li class="breadcrumbs__list"><a href="<?php echo esc_url(home_url('/blog/')); ?>">ブログ・記事</a></li>
        <?php
        $cat_slug = isset($_GET['blog_cat']) ? sanitize_text_field($_GET['blog_cat']) : '';
        $tag_slug = isset($_GET['blog_tag']) ? sanitize_text_field($_GET['blog_tag']) : '';
        $search_text = '';

        if ($cat_slug) {
            $term = get_term_by('slug', $cat_slug, 'blog_cat');
            $search_text = ($term && !is_wp_error($term)) ? 'カテゴリ：' . $term->name : '';
        } elseif ($tag_slug) {
            $term = get_term_by('slug', $tag_slug, 'blog_tag');
            $search_text = ($term && !is_wp_error($term)) ? 'タグ：' . $term->name : '';
        }

        if (empty($search_text)) {
            $search_text = '「' . get_search_query() . '」の検索結果';
        }
        ?>
        <li class="breadcrumbs__list"><?php echo esc_html($search_text); ?></li>

    <?php elseif (is_archive()) : ?><?php /* アーカイブページ */ ?>
    <li class="breadcrumbs__list"><?php post_type_archive_title(); ?></li>
    <?php elseif (is_page()) : ?><?php /* 固定ページ */ ?>
    <?php if ($post->post_parent != 0) : // 投稿の親ページがあるかどうかを判別
            $ancestors = array_reverse(get_post_ancestors($post->ID)); // 投稿の祖先ページの ID を配列として取得
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
    <?php
    $queried_obj = get_queried_object();
    $post_type = get_post_type_object($queried_obj->post_type);
    ?>
    <li class="breadcrumbs__list">
        <a href="<?php echo esc_url(get_post_type_archive_link($post_type->name)); ?>">
            <?php echo esc_html($post_type->label); ?>
        </a>
    </li>
    <li class="breadcrumbs__list"><?php echo esc_html(get_the_title($queried_obj->ID)); ?></li>
<?php //elseif (is_404()) : ?>
    <!--<li>ページが見つかりません</li>-->
<?php endif; ?>
</ul>
<?php endif; ?>
