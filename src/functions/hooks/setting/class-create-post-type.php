<?php

namespace hooks\setting;

/**
 * カスタム投稿タイプ作成
 */
class Create_Post_Type
{
    private const POST_TYPES = [
        'news' => 'お知らせ',
    ];

    /**
     * カスタム投稿タイプ作成
     *
     * @return void
     */
    public function createPostType()
    {
        foreach (self::POST_TYPES as $key => $post_type) {
            register_post_type(
                $key,
                self::getPostTypeDefinition($post_type)
            );
        }
    }

    /**
     * カスタム投稿タイプ設定
     *
     * @param  string $label
     * @return void
     */
    private function getPostTypeDefinition($label)
    {
        return (array(
            'label' => $label,
            'public' => true,
            'has_archive' => true,
            'hierarchicla' => true,
            'menu_position' => 10,
            'show_in_rest' => true,
            'supports' => [
                'title',
                'editor',
                'thumbnail',
                'revisions',
                'custom-fields',
                'excerpt',
            ]
        ));
    }
    /**
     * アクションフックの設定
     *
     * @return void
     */
    public function addAction()
    {
        add_action(
            'init',
            array($this, 'createPostType')
        );
    }
}
