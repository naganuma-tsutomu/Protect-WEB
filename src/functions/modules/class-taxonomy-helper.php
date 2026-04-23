<?php

namespace modules;

/**
 * タクソノミー関連のデータ取得を一元管理するクラス。
 * HTML の出力は一切行わない。
 * テンプレートパーツ (templates/parts/term-links.php) と組み合わせて使う。
 */
class Taxonomy_Helper
{
    /**
     * 投稿に紐づくタームのリンク情報を配列で返す。
     *
     * @param  int    $post_id     投稿ID
     * @param  string $taxonomy    タクソノミー名 ('blog_cat' / 'blog_tag')
     * @param  string $active_slug 現在選択中のスラッグ（アクティブ判定用）
     * @return array  [ ['name'=>..., 'slug'=>..., 'url'=>..., 'is_active'=>bool], ... ]
     *                タームが存在しない場合は空配列
     */
    public static function get_term_links($post_id, $taxonomy, $active_slug = '')
    {
        $terms = get_the_terms($post_id, $taxonomy);
        if (empty($terms) || is_wp_error($terms)) {
            return [];
        }
        return self::build_term_links($terms, $taxonomy, $active_slug);
    }

    /**
     * タクソノミーに登録されているすべてのタームのリンク情報を返す。
     * サイドバーのカテゴリ一覧・タグ一覧など、投稿に紐づかない一覧に使う。
     *
     * @param  string $taxonomy    タクソノミー名
     * @param  string $active_slug 現在選択中のスラッグ（アクティブ判定用）
     * @return array  get_term_links() と同じ形式
     */
    public static function get_all_term_links($taxonomy, $active_slug = '')
    {
        $terms = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => true,
        ]);
        if (empty($terms) || is_wp_error($terms)) {
            return [];
        }
        return self::build_term_links($terms, $taxonomy, $active_slug);
    }

    /**
     * 投稿に紐づくタームの先頭1件のみのリンク情報を返す。
     * サイドバーの新着・人気記事カードなど、1件だけ表示したい場合に使う。
     *
     * @param  int    $post_id     投稿ID
     * @param  string $taxonomy    タクソノミー名
     * @param  string $active_slug 現在選択中のスラッグ（アクティブ判定用）
     * @return array|null  タームが存在する場合は1件分の連想配列、存在しない場合は null
     */
    public static function get_first_term_link($post_id, $taxonomy, $active_slug = '')
    {
        $links = self::get_term_links($post_id, $taxonomy, $active_slug);
        return $links[0] ?? null;
    }

    // ----------------------------------------------------------------
    // private
    // ----------------------------------------------------------------

    /**
     * ターム配列からリンク情報の配列を組み立てる内部メソッド。
     *
     * @param  array  $terms
     * @param  string $taxonomy
     * @param  string $active_slug
     * @return array
     */
    private static function build_term_links($terms, $taxonomy, $active_slug)
    {
        $links = [];

        foreach ($terms as $term) {
            $links[] = [
                'name'      => $term->name,
                'slug'      => $term->slug,
                'url'       => add_query_arg(
                    ['s' => $term->name, $taxonomy => $term->slug],
                    home_url('/')
                ),
                'is_active' => (
                    $active_slug !== '' &&
                    urldecode($active_slug) === urldecode($term->slug)
                ),
            ];
        }

        return $links;
    }
}
