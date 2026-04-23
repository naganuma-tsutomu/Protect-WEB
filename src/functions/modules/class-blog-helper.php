<?php

namespace modules;

/**
 * ブログ投稿の共通処理を一元管理するクラス。
 * HTML の出力は一切行わない。
 */
class Blog_Helper
{
    /** no-image 画像のテーマ内パス */
    const NO_IMAGE_PATH = '/assets/images/common/no-image.webp';

    /**
     * ACF の 'image' フィールドからサムネイル URL を取得する。
     * $fallback が true の場合、画像未設定時は no-image を返す。
     * $fallback が false の場合、画像未設定時は空文字を返す。
     *
     * @param  int  $post_id  投稿ID
     * @param  bool $fallback no-image フォールバックを使うか否か（デフォルト: true）
     * @return string  エスケープ済み URL（画像なし＆fallback=false の場合は空文字）
     */
    public static function get_thumbnail_url($post_id, $fallback = true)
    {
        $url = get_field('image', $post_id);
        if (empty($url) || is_wp_error($url)) {
            if (!$fallback) {
                return '';
            }
            $url = get_theme_file_uri(self::NO_IMAGE_PATH);
        }
        return esc_url($url);
    }

    /**
     * 投稿のいいねカウントを取得する。
     * カウントが未登録の場合は 0 を返す。
     *
     * @param  int $post_id 投稿ID
     * @return int
     */
    public static function get_like_count($post_id)
    {
        return (int) get_post_meta($post_id, '_post_like_count', true);
    }
}
