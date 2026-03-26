<?php

/**
 * 変数をコンソールに出力
 *
 * @param void $args
 * @return void
 */
function console($args)
{
    ob_start();
    $var = ob_get_contents();
    ob_end_clean();
    $var = addslashes($var);
    $var = str_replace(array("\r\n", "\r", "\n"), '\n', $var);
    echo '<script>
    if (typeof(window.console) === "undefined") {
        window.console = {
            log: function(){},
        }
    }
    console.log("' . $var . '");
    </script>';
}

/**
 * ダミー画像のURLを出力する
 */
function the_dummy_image_url() {
    echo esc_url( get_theme_file_uri( '/assets/images/etc/dammy_960x640.webp' ) );
}


function my_scripts_method() {
    wp_enqueue_script(
        'custom_script',
        get_template_directory_uri().'/assets/js/single.js'
    );
}

add_action('wp_enqueue_scripts', 'my_scripts_method');

/**
 * AJAXによるいいね機能の処理
 */
function handle_toggle_like() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $type    = isset($_POST['type']) ? $_POST['type'] : ''; // 'like' または 'unlike'

    if ($post_id > 0 && in_array($type, ['like', 'unlike'])) {
        $count = (int) get_post_meta($post_id, '_post_like_count', true);
        
        if ($type === 'like') {
            $count++;
        } else {
            $count = max(0, $count - 1);
        }

        update_post_meta($post_id, '_post_like_count', $count);
        wp_send_json_success(['count' => $count]);
    }
    wp_send_json_error();
}
add_action('wp_ajax_toggle_like', 'handle_toggle_like');
add_action('wp_ajax_nopriv_toggle_like', 'handle_toggle_like');
