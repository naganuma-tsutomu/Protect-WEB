<?php

namespace hooks\setting;

use hooks\Hook_Interface;

/**
 * カスタム投稿タイプ作成
 */
class Create_Post_Type implements Hook_Interface
{
    private const POST_TYPES = [
        'works' => '制作実績',
        'blog' => 'ブログ・記事',
    ];

    /**
     * カスタム投稿タイプ作成
     *
     * @return void
     */
    public function createPostType(): void
    {
        foreach (self::POST_TYPES as $key => $post_type) {
            register_post_type(
                $key,
                $this->getPostTypeDefinition($post_type)
            );
        }
    }

    /**
     * カスタム投稿タイプ設定
     *
     * @param  string $label
     * @return array
     */
    private function getPostTypeDefinition(string $label): array
    {
        return [
            'label' => $label,
            'public' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'menu_position' => 10,
            'show_in_rest' => true,
            'supports' => [
                'title',
                'editor',
                'thumbnail',
                'revisions',
                'custom-fields',
                'excerpt',
            ],
        ];
    }
    /**
     * アクションフックの設定
     *
     * @return void
     */
    public function addAction(): void
    {
        add_action(
            'init',
            array($this, 'createPostType')
        );
    }
}
