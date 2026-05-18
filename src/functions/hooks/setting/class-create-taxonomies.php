<?php

namespace hooks\setting;

use hooks\Hook_Interface;

/**
 * タクソノミー（カテゴリ）の自動生成
 *
 * 内部の TAXONOMIES 定数にタクソノミー定義を列挙する。
 * タクソノミーを増やしたいときは TAXONOMIES に1要素追加するだけ。
 */
class Create_Taxonomies implements Hook_Interface
{
    /**
     * 作成するタクソノミー定義
     *
     * キーがタクソノミーのスラッグ。値は以下のキーを持つ配列。
     *   - object_type   : 紐づける投稿タイプのスラッグ
     *   - label         : 管理画面に表示するラベル
     *   - showColumn    : 一覧画面にカラムを表示するか（省略時 false）
     *   - hierarchical  : 階層を持たせるか（省略時 true）
     *   - terms         : 作成するターム配列（省略可）
     *       - name : ターム名
     *       - args : wp_insert_term へ渡す引数。parent はスラッグで指定可
     *
     * @link https://elearn.jp/wpman/function/wp_insert_term.html
     */
    private const TAXONOMIES = [
        'blog_cat' => [
            'object_type' => 'blog',
            'label' => 'ブログカテゴリ',
            'showColumn' => true,
            'hierarchical' => true,
            'terms' => [
                ['name' => 'wordpress', 'args' => ['slug' => 'wordpress']],
                ['name' => 'php', 'args' => ['slug' => 'php']],
                ['name' => 'mysql', 'args' => ['slug' => 'mysql']],
                ['name' => 'javascript', 'args' => ['slug' => 'javascript']],
                ['name' => 'typescript', 'args' => ['slug' => 'typescript']],
                ['name' => 'laravel', 'args' => ['slug' => 'laravel']],
                ['name' => 'vue', 'args' => ['slug' => 'vue']],
                ['name' => 'react', 'args' => ['slug' => 'react']],
                ['name' => 'docker', 'args' => ['slug' => 'docker']],
                ['name' => 'git', 'args' => ['slug' => 'git']],
                ['name' => 'aws', 'args' => ['slug' => 'aws']],
                ['name' => 'linux', 'args' => ['slug' => 'linux']],
            ],
        ],
        'blog_tag' => [
            'object_type' => 'blog',
            'label' => 'メインタグ',
            'showColumn' => true,
            'hierarchical' => true,
            'terms' => [
                ['name' => 'バックアップ', 'args' => ['slug' => 'backup']],
                ['name' => '更新', 'args' => ['slug' => 'update']],
                ['name' => 'チュートリアル', 'args' => ['slug' => 'tutorial']],
                ['name' => 'Tips', 'args' => ['slug' => 'tips']],
                ['name' => 'トラブルシューティング', 'args' => ['slug' => 'troubleshooting']],
                ['name' => 'カスタム投稿タイプ', 'args' => ['slug' => 'custom-post-type']],
                ['name' => 'REST API', 'args' => ['slug' => 'rest-api']],
                ['name' => 'フック', 'args' => ['slug' => 'hooks']],
            ],
        ],
    ];

    /**
     * アクションフックの設定
     *
     * @return void
     */
    public function addAction(): void
    {
        add_action('init', [$this, 'registerAll']);
    }

    /**
     * 全タクソノミーの登録＋タームの作成
     *
     * 同一コールバック内で register_taxonomy → wp_insert_term を実行する。
     *
     * @return void
     */
    public function registerAll(): void
    {
        foreach (self::TAXONOMIES as $slug => $tax) {
            $this->registerTaxonomy($slug, $tax); // タクソノミー登録
            $this->insertTerms($slug, $tax['terms'] ?? []); // ターム作成
        }
    }

    /**
     * カスタムタクソノミーの登録
     *
     * @param string $slug タクソノミースラッグ
     * @param array  $tax  TAXONOMIES の1要素
     * @return void
     */
    private function registerTaxonomy(string $slug, array $tax): void
    {
        register_taxonomy(
            $slug, // カテゴリのスラッグ
            $tax['object_type'], // カテゴリを紐づけるページ
            [
                'label' => $tax['label'], // ラベル
                'show_in_rest' => true, // REST_API用
                'show_admin_column' => $tax['showColumn'] ?? false, // 一覧画面にカラム
                'hierarchical' => $tax['hierarchical'] ?? true, // 階層
            ]
        );
    }

    /**
     * タームの追加
     *
     * @param string $taxSlug 紐づけるタクソノミーのスラッグ
     * @param array  $terms   ターム定義配列
     * @return void
     */
    private function insertTerms(string $taxSlug, array $terms): void
    {
        if (empty($terms)) return; // 作成するタームが無い場合処理中止
        foreach ($terms as $term) {
            $term = $this->resolveParent($term, $taxSlug); // 親のタームの検索処理
            if (!get_term_by('slug', $term['args']['slug'], $taxSlug)) { // タームが存在しなければ
                wp_insert_term($term['name'], $taxSlug, $term['args']); // タームを作成
            }
        }
    }

    /**
     * 親タームのスラッグを ID に解決
     *
     * @param  array  $termData 1ターム分の定義
     * @param  string $taxSlug  タクソノミースラッグ
     * @return array
     */
    private function resolveParent(array $termData, string $taxSlug): array
    {
        if (array_key_exists('parent', $termData['args'])) { // parentのキーが存在すれば
            $parent = $termData['args']['parent'];
            if (!empty($parent)) { // 空でないとき
                $term = get_term_by('slug', $parent, $taxSlug); // 親タームのオブジェクトの取得
                $termData['args']['parent'] = $term->term_id; // 元配列のparentキーの値をIDに変更
            }
        }
        return $termData;
    }
}
