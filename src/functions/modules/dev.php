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
        $count = get_post_like_count($post_id);
        
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

//記事のいいね数を取得する関数
function get_post_like_count($post_id) {
    return (int) get_post_meta($post_id, '_post_like_count', true);
}



// the_func関数
function the_func($term_data, $taxonomy, $class = '', $liclass = '',  $id = null ){
    
    // get_the_taxonomy_data関数を呼び出す
    // $term_data = get_the_taxonomy_data($id, $taxonomy);
    //現在のタクソノミーを取得
    $current_slug = get_query_var($taxonomy);
    if(!empty($term_data)){
        foreach($term_data as $data){

            //表示内容の準備
            $prefix = ($taxonomy == 'blog_tag') ? '#' : ''; //タグの場合、#を表示する
            // タクソノミー名によってクラス名を切り替える（三項演算子）
            $active_class = ($taxonomy == 'blog_tag') ? 'tag-list__item' : 'category-list__item';
            $content = '<a class="' . $class . '" href="' . esc_url($data['link']) . '">' . $prefix . esc_html($data['name']) . '</a>';
            $active_content = '<span class="' . $active_class . '">' . $prefix . esc_html($data['name']) . '</span>';
            
            //タクソノミーがactiveかどうかを判定
            $is_active = (urldecode($current_slug) === urldecode($data['slug']));
            //タクソノミーがactiveの場合、'active'クラスを付与する
            $final_content = $is_active ? $active_content : $content;

            //liclassが指定されている場合、<li>を出力する
            if(!empty($liclass)){
                echo '<li class="'. esc_attr($liclass) .'">'. $final_content .'</li>';
            } else {
                echo $final_content;
            }
        }
    }
}

// the_func関数で使うget_the_taxonomy_data関数
function get_the_taxonomy_data($taxonomy, $id = null){
    $data = array();
    
    if (empty($id) ) {
        // IDがない場合は get_terms で全取得
        $terms = get_terms( array('taxonomy' => $taxonomy, 'hide_empty' => true) );
    } else {
        // IDがある場合は今まで通り get_the_terms
        $terms = get_the_terms($id, $taxonomy);
    }

    if(!empty($terms) && !is_wp_error($terms)){
        foreach ($terms as $term) {
            $data[] = array(
                'name' => $term->name,
                'slug' => $term->slug,
                'link' => add_query_arg(array(
                    's'        => $term->name,
                    $taxonomy  => $term->slug
                ), home_url('/'))
            );
        }
    }
    return $data;
}

/**
 *アイキャッチ画像の表示
 */
function get_the_post_image($post_id, $class_name = '', $no_image = true){
    $image_url = get_field('image');
    // アイキャッチ画像を取得し、クラス名を付与して画像を表示する
    if (!empty($image_url) && !is_wp_error($image_url)) {
        // アイキャッチ画像がある場合
        return '<img class="' . $class_name . '" src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title($post_id)) . '">';
    }elseif($no_image === true){
        //画像が無い場合、no-image画像を表示する($no_image = true)
        return '<img class="' . $class_name . '" src="' . get_theme_file_uri('/assets/images/common/no-image.webp') . '" alt="' . esc_attr(get_the_title($post_id)) . '">';
    }else{
        //画像が無い場合、何も表示しない($no_image = false)
        return '';
    }
}

    
    