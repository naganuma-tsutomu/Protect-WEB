<?php

namespace hooks;

class Head
{
    public function init()
    {
        add_action('init', array($this, 'initialize'));
        add_action('wp_enqueue_scripts', array($this, 'styles_and_scripts'));
        add_theme_support('title-tag');
        add_filter('wpcf7_load_js', '__return_false');
        add_filter('wpcf7_load_css', '__return_false');
    }

    /**
     * head内 不要箇所削除
     */
    public function initialize()
    {
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    }

    public function styles_and_scripts()
    {
        // CSS
        wp_enqueue_style('main-style', get_theme_file_uri() . '/assets/css/style.css');
        // JS
        wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/main.js'), array(), null, true);
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('classic-theme-styles');
        wp_dequeue_style('global-styles');
        wp_deregister_script('jquery'); /* 同梱のJQueryを読み込ませない */
    }
}
