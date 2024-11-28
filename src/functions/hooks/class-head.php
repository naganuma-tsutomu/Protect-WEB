<?php

namespace hooks;

class Head
{
    public function init()
    {
        add_action('wp_enqueue_scripts', array($this, 'styles_and_scripts'));
    }

    public function styles_and_scripts()
    {
        wp_enqueue_style('main-style', get_theme_file_uri() . '/assets/css/style.css');
        // サイト全体でのJS
        wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/main.js'), array(), null, true);

        //------------------------------------------  WordPress 本体の jQuery を登録解除
        // wp_deregister_script('jquery');

        // ------------------------------------------ jQueryを読み込む
        // wp_enqueue_script('jquery', get_theme_file_uri('/assets/js/lib/jquery-3.6.0.min.js'), array(), '3.6.0', true);

    }
}
