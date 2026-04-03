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

    // JSにデータを渡す (ajax_url と nonce)
    wp_localize_script('custom_script', 'like_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('like_nonce')
    ));
}

add_action('wp_enqueue_scripts', 'my_scripts_method');

/**
 * AJAXによるいいね機能の処理
 */
function handle_toggle_like() {
    // 1. セキュリティトークンの検証
    // JS側で 'nonce' というキー名で送信しているため、第2引数を 'nonce' に合わせます。
    check_ajax_referer('like_nonce', 'nonce');

    // 2. データの取得とバリデーション    
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $type    = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';

     // 有効な投稿 ID であるか、操作の種類が許可されたものであるかを確認
    if ($post_id > 0 && in_array($type, ['like', 'unlike']) && get_post($post_id)) {
        
        // 3. 現在のいいね数を取得
        $count = (int) get_post_meta($post_id, '_post_like_count', true);
        
        if ($type === 'like') {
            $count++;
        } else {
            $count = max(0, $count - 1);
        }

        // 4. データベースを更新
        if (update_post_meta($post_id, '_post_like_count', $count) !== false || get_post_meta($post_id, '_post_like_count', true) == $count) {
            // 5. 成功レスポンスを返却
            wp_send_json_success(['count' => $count]);
        } else {
            wp_send_json_error(['message' => 'Failed to update database.']);
        }
    } else {
        wp_send_json_error(['message' => 'Invalid parameters or post not found.']);
    }
   
}
// ログイン済みユーザーからのAJAXリクエストを処理するアクションを追加
add_action('wp_ajax_toggle_like', 'handle_toggle_like');
// 未ログインユーザーからのAJAXリクエストを処理するアクションを追加
add_action('wp_ajax_nopriv_toggle_like', 'handle_toggle_like');
