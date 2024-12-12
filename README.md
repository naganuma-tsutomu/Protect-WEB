# Protect-WEB
- Docker
- SCSS
- webpack

# 必須環境
- Docker
- Node.js
- npm

# 環境構築

### .envファイル作成

.env.exampleをコピーし、.envへリネーム  
作成するプロジェクトに合わせて内容を変更する。

### npmインストール

```
npm install
```

または

```
make npm
```

### Dockerコンテナのビルド

```
docker compose up -d
```

または

```
make up
```

# 使用方法

## Wordpressのインストール

1.「docker exec -it 【WordPressのコンテナ名】 /bin/bash」 でコンテナに入る

```
$ docker exec -it WordPressBaseTheme-wp /bin/bash
```

または

```
$ make wp
```


2.「chmod +x /tmp/wp-install.sh」 で実行権限を付与
  シェルスクリプトに実行権限を付与して実行できるようにします
  
```
$ chmod +x /tmp/wp-install.sh
```

3.「/tmp/wp-install.sh」 でWP-CLI実行

```
$ /tmp/wp-install.sh
```

## 開発サーバーの起動

```
npm run dev
```

を実行し、CLIにエラーが発生しなければ通常に起動します。



Windows + WSL2環境の場合permission deniedエラーが発生する場合があるが、

Dockerコンテナの初回ビルド時にdistファイルがroot権限で生成されるため。

修正する際はWSL2内で、

```
sudo chown {ユーザーネーム}:{ユーザーグループ} dist
```

を実行します。

## CSS

```
├── _common：全ページ共通のcss格納
│   ├── common.scss
│   ├── footer.scss
│   ├── header.scss
│   └── subpage：下層ページ共通のcss格納（=下層2ページ以上にまたがるcss）
├── _custom-pages：各ページごとのcss格納
│   ├── front-page.scss
│   └── page-sample.scss
├── _utils
│   ├── animation.scss：共通cssアニメーション格納
│   ├── function.scss：関数格納
│   └── mixin.scss：mixin格納
├── _var.scss：変数格納
└── style.scss：全体のscss

その他追加する場合は自由に追加してください。
```

## functions

CSS Javascriptの読み込み  
```
src/functions/hooks/class-head.php
```

固定ページ作成, カスタム投稿タイプ作成, カスタムタクソノミー作成  
```
src/functions/hooks/setting/**.php
src/functions/hooks/class-setting.php
```

開発時のみ関数
```
src/functions/modules/dev.php
```

その他関数
```
src/functions.php
```


