<?php

namespace hooks;

use hooks\setting\{
    Create_Post_Type,
    Create_Page,
    Create_Taxonomy_Main_Cat,
    Create_Taxonomy_Blog_Cat,
    Redirect,
};

/**
 * 初期設定のクラス
 */
class Setting
{
    private const HANDLERS = [
        Create_Post_Type::class,
        Create_Page::class,
        Create_Taxonomy_Main_Cat::class,
        Create_Taxonomy_Blog_Cat::class,
        Redirect::class,
    ];

    /** @var Hook_Interface[] */
    private array $instances = [];

    public function __construct()
    {
        foreach (self::HANDLERS as $class) {
            $this->instances[] = new $class();
        }
    }

    /**
     * アクションの発火
     */
    public function init(): void
    {
        foreach ($this->instances as $instance) {
            $instance->addAction();
        }
    }
}
