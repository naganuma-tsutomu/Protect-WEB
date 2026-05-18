<?php

namespace hooks\setting;

use hooks\Hook_Interface;
use hooks\setting\Create_Taxonomy;

/**
 * ブログカテゴリの作成
 */
class Create_Taxonomy_Blog_Cat extends Create_Taxonomy implements Hook_Interface
{
    /**
     * カテゴリの自動生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->cat_slug = 'blog_cat';
        $this->object_type = 'blog';
        $this->label = 'ブログカテゴリ';
        $this->showColumn = true;
        $this->terms = $this->createTerms();
    }

    /**
     * アクションフックの設定
     */
    public function addAction(): void
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