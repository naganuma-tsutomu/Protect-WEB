<?php

namespace hooks;

use hooks\setting\{
    Create_Post_Type,
    Create_Page,
    Create_Taxonomy_Main_Cat,
};

/**
 * 初期設定のクラス
 */
class Setting
{

    private object $Create_Post_Type;
    private object $Create_Page;
    private object $Create_Taxonomy_Main_Cat;

    /**
     * インスタンスの作成
     */
    public function __construct()
    {
        $this->Create_Post_Type = new Create_Post_Type();
        $this->Create_Page = new Create_Page();
        $this->Create_Taxonomy_Main_Cat = new Create_Taxonomy_Main_Cat();
    }

    /**
     * アクションの発火
     *
     * @return void
     */
    public function init()
    {
        // $this->Create_Post_Type->addAction();
        // $this->Create_Page->addAction();
        // $this->Create_Taxonomy_Main_Cat->addAction();
    }
}
