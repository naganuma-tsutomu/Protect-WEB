<?php

namespace hooks\setting;

use hooks\setting\Create_Taxonomy;

/**
 * 固定ページカテゴリの作成
 */
class Create_Taxonomy_Main_Cat extends Create_Taxonomy
{
    /**
     * カテゴリの自動生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->cat_slug = 'main_cat';
        $this->object_type = 'test';
        $this->label = 'メインカテゴリ';
        $this->showColumn = true;
        $this->terms = $this->createTerms();
    }

    /**
     * アクションフックの設定
     *
     * @return void
     */
    public function addAction()
    {
        $this->addCategory();
    }

    /**
     * 作成するターム配列の作成
     *
     * 配列内はnameがラベル
     * argsがwp_insert_termで使用する付加情報
     * 詳細は@link
     * parentはスラッグで処理可能
     *
     * @return array
     * @link https://elearn.jp/wpman/function/wp_insert_term.html
     */
    private function createTerms()
    {
        return [
            ['name' => 'お知らせ', 'args' => ['slug' => 'regular-news']],
            ['name' => '更新', 'args' => ['slug' => 'update']],
        ];
    }
}