<?php

namespace hooks\setting;

/**
 * メインカテゴリの作成
 */
class Create_Taxonomy_Main_Cat extends Create_Taxonomy
{
    /**
     * カテゴリの自動生成
     *
     * 設定値を基底クラスへ渡す。
     * terms 配列内は name がラベル、args が wp_insert_term の付加情報。
     * parent はスラッグで指定可能。
     *
     * @link https://elearn.jp/wpman/function/wp_insert_term.html
     */
    public function __construct()
    {
        parent::__construct(
            cat_slug: 'main_cat',
            object_type: 'blog',
            label: 'メインカテゴリ',
            showColumn: true,
            terms: [
                ['name' => 'お知らせ', 'args' => ['slug' => 'regular-news']],
                ['name' => '更新', 'args' => ['slug' => 'update']],
            ],
        );
    }
}
