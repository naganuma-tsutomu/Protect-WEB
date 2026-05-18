<?php

namespace hooks\setting;

use hooks\Hook_Interface;

/**
 * カテゴリの自動生成（基底クラス）
 *
 * サブクラスは parent::__construct() で設定値を渡す。
 * 直接インスタンス化はできない（abstract）。
 */
abstract class Create_Taxonomy implements Hook_Interface
{
    /**
     * コンストラクタ
     *
     * @param string     $cat_slug     カテゴリのスラッグ
     * @param string     $object_type  カテゴリを紐づけるページスラッグ
     * @param string     $label        管理画面に表示するラベル
     * @param bool       $showColumn   一覧画面にカラムを表示するか
     * @param bool       $hierarchical 階層を持たせるか
     * @param array|null $terms        作成するターム配列（nameがラベル、argsがwp_insert_termで使用する付加情報。parentはスラッグで指定可能）
     * @link https://elearn.jp/wpman/function/wp_insert_term.html
     */
    public function __construct(
        protected string $cat_slug,
        protected string $object_type,
        protected string $label,
        protected bool $showColumn = false,
        protected bool $hierarchical = true,
        protected ?array $terms = null,
    ) {}

    /**
     * アクションフックの設定
     *
     * カテゴリ追加関数。init でタクソノミー登録し、
     * 登録完了時にタームを作成するフックも合わせて設定する。
     *
     * @return void
     */
    public function addAction(): void
    {
        add_action('init', [$this, 'addTaxonomyCategory']); // カテゴリの作成
        add_action("registered_taxonomy_{$this->cat_slug}", [$this, 'addTerms']); // カテゴリが作成されたときにタームの作成
    }

    /**
     * カテゴリの追加
     *
     * カスタムタクソノミーの追加
     *
     * @return void
     */
    public function addTaxonomyCategory(): void
    {
        register_taxonomy(
            $this->cat_slug, // カテゴリのスラッグ
            $this->object_type, // カテゴリを紐づけるページ
            [
                'label' => $this->label, // ラベル
                'show_in_rest' => true, // REST_API用
                'show_admin_column' => $this->showColumn, // 一覧画面にカラム
                'hierarchical' => $this->hierarchical, // 階層
            ]
        );
    }

    /**
     * タームの追加
     *
     * @return void
     */
    public function addTerms(): void
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
     * @param  array $termData
     * @return array
     */
    private function searchParentId(array $termData): array
    {
        if (array_key_exists('parent', $termData['args'])) { // parentのキーが存在すれば
            $parent = $termData['args']['parent'];
            if (!empty($parent)) { // 空でないとき
                $term = get_term_by('slug', $parent, $this->cat_slug); // 親タームのオブジェクトの取得
                $termData['args']['parent'] = $term->term_id; // 元配列のparentキーの値をIDに変更
            }
        }
        return $termData;
    }
}
