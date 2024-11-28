<?php

namespace hooks\setting;

/**
 * 固定ページの自動生成
 */
class Create_Page
{
    // 作成したい固定ページのタイトル名・スラッグを入れる。
    private const PAGES = array(
        array('title' => 'テストページ', 'name' => 'test', 'parent' => '', 'content' => ''),
    );

    /**
     * アクションフックの作成
     *
     * @return void
     */
    public function addAction()
    {
        add_action('after_switch_theme', array($this, 'createAllPages'));
    }

    /**
     * 固定ページ設定の作成
     *
     * @param array $page
     * @return void
     */
    private function createPage($page)
    {
        if (empty(get_page_by_path($page['slug']))) {
            //固定ページがなければ作成
            wp_insert_post(
                array(
                    'post_title'   => $page['title'],
                    'post_name'    => $page['name'],
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                    'post_parent'  => $page['parent'],
                    'post_content' => $page['content'],
                )
            );
        } else {
            //固定ページがすでにあれば更新
            $page_obj = get_page_by_path($page['slug']);
            $page_id = $page_obj->ID;
            $base_post = array(
                'ID'           => $page_id,
                'post_title'   => $page['title'],
                'post_name'    => $page['name'],
            );
            wp_update_post($base_post);
        }
    }

    /**
     * 親ページの設定
     *
     * @param array $page
     * @return void
     */
    private function setParent($page)
    {
        // 親ページ判別
        if (empty($page['parent'])) {
            $page['slug'] = $page['name'];
            $page['parent'] = '';
        } else {
            $page['slug'] = $page['parent'] . '/' . $page['name'];
            $parent_id = get_page_by_path($page['parent']);
            $page['parent'] = $parent_id->ID;
        }
        return $page;
    }

    /**
     * 記事内容判別
     *
     * @param  array $page
     * @return void
     */
    private function setContent($page)
    {
        if (empty($page['content'])) {
            $page['content'] = '';
        }
        return $page;
    }

    private function setPage($page)
    {
        $page = $this->setParent($page);
        $page = $this->setContent($page);
        return $page;
    }

    /**
     * 固定ページの作成
     *
     * @return void
     */
    public function createAllPages()
    {
        foreach (self::PAGES as $value) {
            $value = $this->setPage($value); // 親ページの設定
            $this->createPage($value);
        }
    }
}
