<?php

namespace hooks;

class Head
{
    public function init()
    {
        add_action('wp_enqueue_scripts', array($this, 'styles_and_scripts'));
        add_theme_support('title-tag');
        add_filter('wpcf7_load_js', '__return_false');
        add_filter('wpcf7_load_css', '__return_false');
    }

    public function styles_and_scripts()
    {
        // CSS
        wp_enqueue_style('main-style', get_theme_file_uri() . '/assets/css/style.css');
        // JS
        wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/main.js'), array('jquery'), null, true);
    }
}
