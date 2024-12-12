<?php

/**
 * テーマのコアクラス。
 * functions.php で初期化される。
 */

class My_Theme
{
    const CLASS_FILE_PREFIX = 'class-';
    const HOOK_NAME = 'hooks\\';
    const HOOK_CLASSES = array('head','setting');

    /**
     * 初期化
     */
    public function init()
    {
        //クラスファイルのAutoLoad
        spl_autoload_register(array($this, 'autoload'));
        //各種フックの登録
        $this->bind_hook(self::HOOK_CLASSES);
    }

    /**
     * オートロード（spl_autoload_registerのコールバック）
     */
    public function autoload($class)
    {
        $class_path = __DIR__ . DIRECTORY_SEPARATOR . $this->get_classfile_name($class);
        if (is_file($class_path)) {
            require($class_path);
            return;
        }
    }

    /**
     * クラス名からクラスファイル名を取得
     */
    private function get_classfile_name($class)
    {
        $position = strrpos($class, '\\') + 1;
        $new_string = substr_replace($class, self::CLASS_FILE_PREFIX, $position, 0);
        $class =  strtolower(str_replace('_', '-', $new_string)) . '.php';
        $classfile_name = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        return $classfile_name;
    }

    /**
     * フック用クラスの初期化
     */
    public function bind_hook($hooks)
    {
        foreach ($hooks as $hook) {
			$class = self::HOOK_NAME . $hook;
            if (class_exists($class)) {
                $instance = new $class();
                if (method_exists($instance, 'init')) {
                    $instance->init();
                }
            }
        }
    }
}