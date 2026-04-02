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
    // セキュリティチェック: 送信されたノンスを検証し、不正なリクエスト（CSRF等）をブロック
    check_ajax_referer('like_nonce', 'security');

    // POSTリクエストから投稿IDを取得し、整数型(int)に変換して安全に受け取る
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    // POSTリクエストから操作の種類（'like' または 'unlike'）を取得
    $type    = isset($_POST['type']) ? $_POST['type'] : ''; // 'like' または 'unlike'

    // 有効な投稿IDであり、かつ操作の種類が許可されたものであるかを確認
    if ($post_id > 0 && in_array($type, ['like', 'unlike'])) {
        // 現在のいいね数を投稿メタデータから取得（値がない場合は0として扱う）
        $count = (int) get_post_meta($post_id, '_post_like_count', true);
        
        if ($type === 'like') {
            // 「いいね」の場合はカウントを1増やす
            $count++;
        } else {
            // 「いいね解除」の場合はカウントを1減らす（ただし、負の数にならないよう0で下限を設定）
            $count = max(0, $count - 1);
        }

        // 更新したいいね数を投稿メタデータに保存する
        // update_post_meta関数でデータベースに、$post_idと_post_like_countの組み合わせがあるか確認する
        // 存在しなければ_post_like_countという投稿メタデータを作成し、あれば$countの値で更新する。
        update_post_meta($post_id, '_post_like_count', $count);
        // 成功レスポンスとして、最新のカウント数をJSON形式で返却
        wp_send_json_success(['count' => $count]);
    }
    // バリデーションに失敗した場合はエラーレスポンスを返却
    wp_send_json_error();
}
// ログイン済みユーザーからのAJAXリクエストを処理するアクションを追加
add_action('wp_ajax_toggle_like', 'handle_toggle_like');
// 未ログインユーザーからのAJAXリクエストを処理するアクションを追加
add_action('wp_ajax_nopriv_toggle_like', 'handle_toggle_like');
