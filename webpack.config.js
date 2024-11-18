// 環境変数読み込み
require("dotenv").config(); // dotenv読み込み
const Ip = process.env.IP; // .env.IP 環境変数の取得

const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const RemoveEmptyScriptsPlugin = require("webpack-remove-empty-scripts");
const WebpackWatchedGlobEntries = require("webpack-watched-glob-entries-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const CopyPlugin = require("copy-webpack-plugin");
// ファイルパス
const filePath = {
  js: "./src/assets/js/",
  sass: "./src/assets/scss/",
};
const entries = WebpackWatchedGlobEntries.getEntries(
  [
    path.resolve(__dirname, `${filePath.js}*.js`),
    path.resolve(__dirname, `${filePath.sass}*.scss`),
  ],
  {
    ignore: [
      path.resolve(__dirname, `${filePath.sass}_*.scss`),
      path.resolve(__dirname, `${filePath.js}_*.js`),
    ],
  }
)();

module.exports = (env, argv) => {
  // コンパイルモード
  // mode: "production",
  // devtool: "source-map",
  return {
    // エントリーポイントの設定
    entry:
      // コンパイル対象のファイルを指定
      entries,
    // 出力設定
    output: {
      path: path.resolve(__dirname, "./dist/"), // 出力先フォルダを絶対パスで指定
      filename: `assets/js/[name].js`, // [name]にはentry:で指定したキーが入る
      clean: true,
      assetModuleFilename: "assets/images/[name][ext][query]",
    },
    module: {
      rules: [
        // sassのコンパイル設定
        {
          // node_module内のcss
          test: /node_modules\/(.+)\.css$/,
          use: [
            {
              loader: 'style-loader',
            },
            {
              loader: 'css-loader',
              options: { url: false },
            },
          ],
          sideEffects: true, // production modeでもswiper-bundle.cssが使えるように
        },
        {
          test: /\.(sa|sc)ss$/, // 対象にするファイルを指定
          use: [
            MiniCssExtractPlugin.loader, // JSとCSSを別々に出力する
            {
              loader: "css-loader",
              options: {
                // dev モードではソースマップを付ける
                sourceMap: true,
              },
            },
            {
              loader: "postcss-loader",
              options: {
                sourceMap: true,
                postcssOptions: {
                  plugins: [require("autoprefixer")({ grid: true })],
                },
              },
            },
            {
              loader: "sass-loader",
              options: {
                sourceMap: true,
              },
            },
            // 下から順にコンパイル処理が実行されるので、記入順序に注意
          ],
        },
        {
          test: /\.(gif|png|jpg|jpeg|webp)$/,
          type: "asset",
          parser: {
            dataUrlCondition: {
              maxSize: 50 * 1024,
            },
          },
        },
      ],
    },
    optimization: {
      minimizer: [
        new TerserPlugin(),
        // For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`), uncomment the next line
        // `...`,  ここを追加することでjsのminifyの設定を維持しつつcssをminifyできる（スプレッド演算子のイメージ）。
        new CssMinimizerPlugin({
          exclude: /style.css/,
        }), // cssのminify
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        //出力ファイル名
        filename: `./assets/css/[name].css`,
      }),
      new RemoveEmptyScriptsPlugin(), // CSS別出力時の不要JSファイルを削除
      new BrowserSyncPlugin({
        host: "localhost",
        files: ["src/*", "src/assets/**/*"],
        port: 3000,
        // dockerとホストをつないでいるポートをproxyで指定
        proxy: {
          target: Ip + ":8080",
        },
        open: "external", // ローカルIPアドレスでサーバを立ち上げる
        notify: false, // ブラウザ更新時に出てくる通知を非表示にする
      }),
      new WebpackWatchedGlobEntries(),
      new CopyPlugin({
        patterns: [
          {
            from: "src",
            globOptions: {
              ignore: ["**/_*.*", "**/js/*.js", "**/*.scss", "**/css/*.css"],
            },
          },
        ],
      }),
    ],
    resolve: {
      alias: {
        vue: 'vue/dist/vue.esm-bundler.js',
      },
    },
    // node_modules を監視（watch）対象から除外
    watchOptions: {
      ignored: /node_modules/,
    },
  };
};
