<?php

namespace hooks\setting;

/**
 * カテゴリの自動生成
 */

class Create_Taxonomy
{
    public string $cat_slug; // カテゴリのスラッグ
    public $object_type; // カテゴリを紐づけるページスラッグ
    public string $label; // 管理画面に表示するラベル
    public bool $showColumn = false; // 一覧画面にカラムを表示するか
    public bool $hierarchical = true; // 階層を持たせるか
    public array|null $terms = null; // 作成するターム配列

    /**
     * カテゴリの追加
     *
     * カスタムタクソノミーの追加
     *
     * @return void
     */
    public function addTaxonomyCategory()
    {
        register_taxonomy(
            $this->cat_slug, // カテゴリのスラッグ
            $this->object_type, // カテゴリを紐づけるページ
            array(
                'label' => $this->label, // ラベル
                'show_in_rest' => true, // REST_API用
                'show_admin_column' => $this->showColumn, // 一覧画面にカラム
                'hierarchical' => $this->hierarchical, // 階層
            )
        );
    }

    /**
     * タームの追加
     *
     * @return void
     */
    public function addTerms()
    {
        if (empty($this->terms)) return; // 作成するタームが無い場合処理中止
        foreach ($this->terms as $term) {
            $term = $this->searchParentId($term); // 親のタームの検索処理
            if (!get_term_by('slug', $term['args']['slug'], $this->cat_slug)) { // タームが存在しなければ
                wp_insert_term($term['name'], $this->cat_slug, $term['args']); // タームを作成
            }
        }
    }

    /**
     * 親のタームの設定
     *
     * @param array $termData
     * @return void
     */
    private function searchParentId($termData)
    {
        if (array_key_exists('parent', $termData['args'])) { // parentのキーが存在すれば
            $parent = $termData['args']['parent'];
            if(!empty($parent)){ // 空でないとき
                $term = get_term_by('slug', $parent, $this->cat_slug); // 親タームのオブジェクトの取得
                $termData['args']['parent'] = $term->term_id; // 元配列のparentキーの値をIDに変更
            }
        }
        return $termData;
    }

    /**
     * カテゴリー追加関数
     *
     * @return void
     */
    public function addCategory()
    {
        add_action('init', array($this, 'addTaxonomyCategory')); // カテゴリの作成
        add_action("registered_taxonomy_{$this->cat_slug}", array($this, 'addTerms')); // カテゴリが作成されたときにタームの作成
    }
}
