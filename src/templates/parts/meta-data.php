<?php
// link
$url = get_permalink();
// description
$description = get_bloginfo('description');
// title
$get_name = get_bloginfo('name');
$get_title = get_the_title();

if(is_front_page()){
    $title = $get_name;
} else {
    $title = $get_title . ' - ' . $get_name;
}
?>

<meta name="description" content="<?php echo esc_attr($description); ?>" />
<meta name="google-site-verification" content="" />
<link rel="canonical" href="<?php echo esc_url($url); ?>" />
<meta property="og:locale" content="ja_JP" />
<meta property="og:site_name" content="<?php echo esc_attr($get_name); ?>" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo esc_attr($title); ?>" />
<meta property="og:description" content="<?php echo esc_attr($description); ?>" />
<meta property="og:url" content="<?php echo esc_attr($url); ?>" />
<meta property="og:image" content="<?php echo esc_url(get_theme_file_uri('/assets/images/ogp/ogp_top.webp')); ?>" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo esc_attr($title); ?>" />
<meta name="twitter:description" content="<?php echo esc_attr($description); ?>" />