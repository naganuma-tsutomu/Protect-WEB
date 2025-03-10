<?php

namespace hooks\setting;

class Setup_Theme
{
    public function init()
    {
        add_action('wp_enqueue_scripts', array($this, 'styles_and_scripts'));
        add_theme_support( 'title-tag' );
    }

    public function styles_and_scripts()
    {
        // CSS
        wp_enqueue_style('main-style', get_theme_file_uri() . '/assets/css/style.css');
        // JS
        wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/main.js'), array('jquery'), null, true);
    }
}