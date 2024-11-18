#!/bin/bash

# WordPressセットアップ admin_user,admin_passwordは管理画面のログインID,PW
wp core install \
--url=http://${IP}:8080 \
--title=${HP_TITLE} \
--admin_user=${WP_USER} \
--admin_password=${WP_PASS} \
--admin_email=${WP_EMAIL} \
--allow-root

# 日本語化
wp language core install ja --activate --allow-root
wp core update --locale=ja --force --allow-root

# タイムゾーンと日時表記
wp option update timezone_string 'Asia/Tokyo' --allow-root
wp option update date_format 'Y-m-d' --allow-root
wp option update time_format 'H:i' --allow-root

# キャッチフレーズの設定 (空にする)
wp option update blogdescription '' --allow-root

# プラグインの削除 (不要な初期プラグインを削除)
wp plugin delete hello.php --allow-root
wp plugin delete akismet --allow-root

# プラグインのインストール (必要に応じてコメントアウトを外す)
wp plugin install wp-multibyte-patch --activate --allow-root
wp plugin install contact-form-7 --activate --allow-root
wp plugin install wp-mail-smtp --activate --allow-root
wp plugin install advanced-custom-fields --activate --allow-root
wp plugin install custom-post-type-ui --activate --allow-root
wp plugin install query-monitor --activate --allow-root

# テーマの有効化
wp theme activate $THEME_TITLE --allow-root
# テーマの削除
wp theme delete twentytwentyone --allow-root
wp theme delete twentytwentytwo --allow-root
wp theme delete twentytwentythree --allow-root

# パーマリンク更新
wp option update permalink_structure /%postname%/ --allow-root

# 固定ページの追加
# wp post create --post_type=page --post_title=お問い合わせ --post_status=publish --post_name=contact --allow-root
