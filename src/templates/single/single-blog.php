<?php /* single-blog */ ?>
    <div class="container">
        <main class="main">
            <div class="flex-box">
                <!-- 記事
                ------------------------------------------------->
                <div class="main-block">
                    <!-- box shadow --->
                    <div class="box-shadow">
                        <!-- 見出し --->
                        <div class="article">
                            <div class="lead">
                                <div class="lead-top">
                                    <div class="lead__date">
                                        <span class="lead__date_text">20XX.XX.XX</span>
                                    </div>
                                    <div class="lead__button">
                                        <span class="lead__button_heart">♡</span>
                                        <span class="lead__button_number">11</span>
                                    </div>
                                </div>
                                <div class="lead__title">
                                    <h1>新人AI禁止令と、その結果の答え合わせ</h1>
                                </div>
                                <div class="lead-sub">
                                    <div class="lead__category">
                                        <object class="lead__category_text">
                                            <a class="lead__category_link"
                                                href="https://web.kk-protect.co.jp/">AI</a></object>
                                    </div>
                                    <div class="lead__tag">
                                        <ul class="tag-list">
                                            <li class="tag-item">
                                                <a class="tag-item__link" href="#">#AI</a>
                                            </li>
                                            <li class="tag-item">
                                                <a class="tag-item__link" href="#">#tag</a>
                                            </li>
                                            <li class="tag-item">
                                                <a class="tag-item__link" href="#">#タグ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="thumbnail">
                                <img class="thumbnail__img" src="assets/img/blog_01.jpg" alt="サムネイル画像">
                            </div>
                        </div>
                        <!-- 記事 --->
                        <div class="main-box">
                            <!-- 目次 --->
                            <div class="index">
                                <span class="index__border"></span>
                                <div class="index__title">
                                    <span class="index__box"></span>
                                    <div class="index__title_text">目次</div>
                                </div>
                                <div class="index__text">
                                    <ol class="index-list">
                                        <li class="index-item">
                                            <i class="fa-regular fa-square"></i>
                                            <a class="index-item__link" href="#index-1">はじめに</a>
                                        </li>
                                        <li class="index-item">
                                            <i class="fa-regular fa-square"></i>
                                            <a class="index-item__link" href="#index-2">最初は「AIをどんどん使わせていた」</a>
                                        </li>
                                        <li class="index-item">
                                            <i class="fa-regular fa-square"></i>
                                            <a class="index-item__link" href="#index-3">レビュー830件の衝撃</a>
                                        </li>
                                        <li class="index-item">
                                            <i class="fa-regular fa-square"></i>
                                            <a class="index-item__link" href="#index-4">「AIを神だと思っていました」</a>
                                        </li>
                                        <li class="index-item">
                                            <i class="fa-regular fa-square"></i>
                                            <a class="index-item__link" href="#index-5">AI禁止令</a>
                                        </li>
                                    </ol>
                                </div>
                                <span class="index__border"></span>
                            </div>
                            <!-- 本文 --->
                            <div class="main-content">
                                <div class="main-content__index">
                                    <!-- 見出し --->
                                    <h2 id="index-1">はじめに</h2>
                                    <span class="main-content__border"></span>
                                    <p>こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。<br>
                                        弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                        Codeを配布、業務効率化・実装スピード強化・精度向上を進めてきました。</p>
                                    <p>そんな会社で、私はある新人エンジニアに対して「AIの使用を禁止する」という判断を下しました。<br>
                                        先日ちょっと話題になってましたね、こちらの彼の話です。</p>
                                    <!-- バナー --->
                                    <img class="banner" src="./assets/img/banner_01.jpg" alt="バナー">
                                    <p>社内でも圧倒的なAI推進派の私がなぜそのような判断をしたのか。そして3ヶ月後、その新人はどう変わったのか。この記事では、私の目線からのある種答え合わせ的なつもりで経緯と結果をまとめてみました。
                                    </p>
                                    <!-- 見出し --->
                                    <h2 id="index-2">最初は「AIをどんどん使わせていた」</h2>
                                    <span class="main-content__border"></span>
                                    <p>新人が入社した当初、私は彼にもCursorを使わせていました。なんならClaude Codeも使わせていました。理由はシンプルです。</p>
                                    <p>
                                        ・実装スピードが上がる（はず）<br>
                                        ・最新のベストプラクティスを学べる（はず）<br>
                                        ・コード品質が向上する（はず）<br>
                                        ・実際、彼は完全未経験でしたがそれなりのスピードで機能を実装していきました。CRUD機能も、データベース操作も、それなりに「動くもの」を作ってきます。
                                    </p>
                                    <p>「これはいい流れかもな～」と思っていました。最初は。</p>
                                    <!-- 見出し --->
                                    <h2 id="index-3">レビュー830件の衝撃</h2>
                                    <span class="main-content__border"></span>
                                    <p>最初の大きな機能のコードレビューを行った時のことです。<br>
                                        レビューコメントは830件に達しました（実際は静的解析による自動コメントも含まれてます）。
                                    </p>
                                    <p>主な問題点を挙げると：</p>
                                    <p>・Model層でHTML生成（MVCアーキテクチャを完全に無視）<br>
                                        ・デバッグコードが本番に混入（error_logが大量に残存）<br>
                                        ・500行を超える大規模インラインJavaScript<br>
                                        ・テストコードが1つもない<br>
                                        ・変数名や関数名が既存コードのパターンと全く異なる
                                    </p>
                                    <p>実際に、Model層で直接HTMLを生成しているコードを見たときは、「あ、こいつAIや」と一目でわかりました。</p>
                                    <p>Before: Model層でHTML生成（MVC違反）</p>
                                    <!-- コード --->
                                    <pre class="code">
                                        <code>aaaaa</code>
                                    </pre>
                                    <p>いやまあコードは「動く」んですよね。しかし、弊社ルールで推奨している保守性や拡張性、既存システムとの整合性という観点で見ると、「よし、ええから黙ってやり直せ」の状態でした。
                                    </p>
                                    <!-- 見出し --->
                                    <h2 id="index-4">「AIを神だと思っていました」</h2>
                                    <span class="main-content__border"></span>
                                    <p>レビューしながら彼に<br>
                                        「なぜModel層でHTML生成をしたの？」<br>
                                        と聞いたんですが、ドストレートで衝撃でしたね。</p>
                                    <p>「AIがそう実装してくれたので、正しいと思っていました」</p>
                                    <p>「（うわぁ、ホントにこんなことあるんだぁ）」と思いました。</p>

                                    <p>それに続けて<br>
                                        「正直、出力されたコードは自分が考えるより正しいと実際思っちゃう節があります。もはや神と変わんないですね。（誇張）」</p>
                                    <p>「なるほどな～」というめちゃくちゃ腑に落ちました。やっぱりAIの出力を判断する「基礎」がないと、結構やばいことになりそうだなと。</p>
                                    <!-- 見出し --->
                                    <h2 id="index-5">AI禁止令</h2>
                                    <span class="main-content__border"></span>
                                    <p>というわけで、「ＡＩ禁止！触ったら手が溶けると思え。自分の頭で考える筋トレタイム」 を命じました。</p>
                                    <p>禁止期間中にやってもらったこと</p>
                                    <p>1.公式ドキュメントを読む<br>
                                        ・フレームワークの公式ドキュメント<br>
                                        ・PHPUnit/PSRの仕様</p>
                                    <p>2.既存コードを読む<br>
                                        ・似た機能を実装した過去のコードを読み解く<br>
                                        ・コードの「パターン」を発見する</p>
                                    <p>3.設計を言語化する<br>
                                        ・実装前に設計書を書く<br>
                                        ・責務分離を図で表現する</p>
                                    <p>質問の質があっさり変わった</p>
                                    <p>禁止前：<br>
                                        ・「このエラーが出ます。どうすればいいですか？」<br>
                                        ・「動きません」</p>
                                    <p>禁止後：<br>
                                        ・「この設計だと、Controllerに実装が集中しそうなんですが、Service層に切り出した方がいいですか？」<br>
                                        ・「既存のProductHelperと今回のProductService、命名規則が違うんですが、どっちがいいですかね？」</p>
                                </div>
                                <div class="category-sub">
                                    <p class="category-sub__title">この記事のカテゴリ・タグ一覧</p>
                                    <div class="bottom">
                                        <div class="bottom__category">
                                            <a class="bottom__category_link"
                                                href="https://web.kk-protect.co.jp/">AI</a></object>
                                        </div>
                                        <div class="bottom__tag">
                                            <ul class="tag-list">
                                                <li class="tag-item">
                                                    <a class="tag-item__link" href="#">#AI</a>
                                                </li>
                                                <li class="tag-item">
                                                    <a class="tag-item__link" href="#">#tag</a>
                                                </li>
                                                <li class="tag-item">
                                                    <a class="tag-item__link" href="#">#タグ</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <button class="good">
                                            <span class="good__item">♡</span>
                                            <span class="good__number">11</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 前・次・記事一覧のボタン
                    ------------------------------------------------->
                    <div class="blog-pagination">
                        <button class="blog-pagination__before" type="button">【エンジニア向け】ChatGPTのカスタム指示を考えてみた
                            <div class="blog-pagination__before_item">← 前の記事</div>
                        </button>
                        <button class="blog-pagination__after" type="button">人工知能概論【まとめ】
                            <div class="blog-pagination__after_item">次の記事 →</div>
                        </button>
                    </div>
                    <button class="blog-pagination__index" type="button">記事一覧</button>

                    <!-- 関連記事
                    ------------------------------------------------->
                    <div class="Related-Posts">
                        <div class="Related-Posts__title">関連記事</div>
                        <ul class="Related-Posts-list">
                            <li class="Related-Posts-item">
                                <a class="Related-Posts-item-link" href="#">
                                    <div class="Related-Posts-thumbnail">
                                        <img class="Related-Posts-thumbnail__img" src="assets/img/blog_01.jpg"
                                            alt="サムネイル画像">
                                    </div>
                                    <div class="Related-Posts-lead">
                                        <div class="Related-Posts-lead__title">
                                            <div class="Related-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ</div>
                                        </div>
                                        <div class="Related-Posts-lead__main">
                                            <div class="Related-Posts-lead__main_text">
                                                こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude Codeを配布、
                                            </div>
                                        </div>
                                        <div class="Related-Posts-lead-sub">
                                            <div class="Related-Posts-lead__date">
                                                <span class="Related-Posts-lead__date_text">20XX.XX.XX</span>
                                            </div>
                                            <div class="Related-Posts-lead__category">
                                                <object class="Related-Posts-lead__category_text">
                                                    <a class="Related-Posts-lead__category_link"
                                                        href="https://web.kk-protect.co.jp/">AI</a></object>
                                            </div>
                                            <div class="Related-Posts-lead__tag">
                                                <object class="Related-Posts-lead__tag_text">
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#AI</a>
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                </object>
                                            </div>
                                            <div class="Related-Posts-lead__button">
                                                <span class="Related-Posts-lead__button_heart">♡</span>
                                                <span class="Related-Posts-lead__button_number">11</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="Related-Posts-item">
                                <a class="Related-Posts-item-link" href="#">
                                    <div class="Related-Posts-thumbnail">
                                        <img class="Related-Posts-thumbnail__img" src="assets/img/blog_02.jpg"
                                            alt="サムネイル画像">
                                    </div>
                                    <div class="Related-Posts-lead">
                                        <div class="Related-Posts-lead__title">
                                            <div class="Related-Posts-lead__title_text">
                                                Javaのメモリ管理をざっくり理解する（Out-of-Memoryに至る流れ）</div>
                                        </div>
                                        <div class="Related-Posts-lead__main">
                                            <div class="Related-Posts-lead__main_text">
                                                こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude Codeを配布、
                                            </div>
                                        </div>
                                        <div class="Related-Posts-lead-sub">
                                            <div class="Related-Posts-lead__date">
                                                <span class="Related-Posts-lead__date_text">20XX.XX.XX</span>
                                            </div>
                                            <div class="Related-Posts-lead__category">
                                                <object class="Related-Posts-lead__category_text">
                                                    <a class="Related-Posts-lead__category_link"
                                                        href="https://web.kk-protect.co.jp/">クラウド</a></object>
                                            </div>
                                            <div class="Related-Posts-lead__tag">
                                                <object class="Related-Posts-lead__tag_text">
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#AI</a>
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                </object>
                                            </div>
                                            <div class="Related-Posts-lead__button">
                                                <span class="Related-Posts-lead__button_heart">♡</span>
                                                <span class="Related-Posts-lead__button_number">11</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="Related-Posts-item">
                                <a class="Related-Posts-item-link" href="#">
                                    <div class="Related-Posts-thumbnail">
                                        <img class="Related-Posts-thumbnail__img" src="assets/img/blog_03.jpg"
                                            alt="サムネイル画像">
                                    </div>
                                    <div class="Related-Posts-lead">
                                        <div class="Related-Posts-lead__title">
                                            <div class="Related-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ</div>
                                        </div>
                                        <div class="Related-Posts-lead__main">
                                            <div class="Related-Posts-lead__main_text">
                                                こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude Codeを配布、
                                            </div>
                                        </div>
                                        <div class="Related-Posts-lead-sub">
                                            <div class="Related-Posts-lead__date">
                                                <span class="Related-Posts-lead__date_text">20XX.XX.XX</span>
                                            </div>
                                            <div class="Related-Posts-lead__category">
                                                <object class="Related-Posts-lead__category_text">
                                                    <a class="Related-Posts-lead__category_link"
                                                        href="https://web.kk-protect.co.jp/">Java
                                                        Script</a></object>
                                            </div>
                                            <div class="Related-Posts-lead__tag">
                                                <object class="Related-Posts-lead__tag_text">
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#AI</a>
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                </object>
                                            </div>
                                            <div class="Related-Posts-lead__button">
                                                <span class="Related-Posts-lead__button_heart">♡</span>
                                                <span class="Related-Posts-lead__button_number">11</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="Related-Posts-item">
                                <a class="Related-Posts-item-link" href="#">
                                    <div class="Related-Posts-thumbnail">
                                        <img class="Related-Posts-thumbnail__img" src="assets/img/blog_04.jpg"
                                            alt="サムネイル画像">
                                    </div>
                                    <div class="Related-Posts-lead">
                                        <div class="Related-Posts-lead__title">
                                            <div class="Related-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ</div>
                                        </div>
                                        <div class="Related-Posts-lead__main">
                                            <div class="Related-Posts-lead__main_text">
                                                こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude Codeを配布、
                                            </div>
                                        </div>
                                        <div class="Related-Posts-lead-sub">
                                            <div class="Related-Posts-lead__date">
                                                <span class="Related-Posts-lead__date_text">20XX.XX.XX</span>
                                            </div>
                                            <div class="Related-Posts-lead__category">
                                                <object class="Related-Posts-lead__category_text">
                                                    <a class="Related-Posts-lead__category_link"
                                                        href="https://web.kk-protect.co.jp/">Word
                                                        Press</a></object>
                                            </div>
                                            <div class="Related-Posts-lead__tag">
                                                <object class="Related-Posts-lead__tag_text">
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#AI</a>
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                </object>
                                            </div>
                                            <div class="Related-Posts-lead__button">
                                                <span class="Related-Posts-lead__button_heart">♡</span>
                                                <span class="Related-Posts-lead__button_number">11</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="Related-Posts-item">
                                <a class="Related-Posts-item-link" href="#">
                                    <div class="Related-Posts-thumbnail">
                                        <img class="Related-Posts-thumbnail__img" src="assets/img/blog_05.jpg"
                                            alt="サムネイル画像">
                                    </div>
                                    <div class="Related-Posts-lead">
                                        <div class="Related-Posts-lead__title">
                                            <div class="Related-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ</div>
                                        </div>
                                        <div class="Related-Posts-lead__main">
                                            <div class="Related-Posts-lead__main_text">
                                                こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude Codeを配布、
                                            </div>
                                        </div>
                                        <div class="Related-Posts-lead-sub">
                                            <div class="Related-Posts-lead__date">
                                                <span class="Related-Posts-lead__date_text">20XX.XX.XX</span>
                                            </div>
                                            <div class="Related-Posts-lead__category">
                                                <object class="Related-Posts-lead__category_text">
                                                    <a class="Related-Posts-lead__category_link"
                                                        href="https://web.kk-protect.co.jp/">サプライチェーン攻撃</a></object>
                                            </div>
                                            <div class="Related-Posts-lead__tag">
                                                <object class="Related-Posts-lead__tag_text">
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#AI</a>
                                                    <a class="Related-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                </object>
                                            </div>
                                            <div class="Related-Posts-lead__button">
                                                <span class="Related-Posts-lead__button_heart">♡</span>
                                                <span class="Related-Posts-lead__button_number">11</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- サイドバー
                ------------------------------------------------->
                <div class="sidebar">
                    <!-- 検索ボックス
                    ------------------------------------------------->
                    <form class="search-box">
                        <div class="search-box__block">
                            <input type="search" name="search" class="search-box__block_search" placeholder="キーワード検索" />
                        </div>
                        <div class="search-box__icon">
                            <button type="submit" name="submit" class="search-box__icon_submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </form>

                    <!-- カテゴリ
                    ------------------------------------------------->
                    <div class="category">
                        <div class="category-block">
                            <ul class="category-item">
                                <li class="category-list">
                                    <a class="category-list__link" href="#">
                                        <span class="category-list__box">AI</span>
                                    </a>
                                </li>
                                <li class="category-list">
                                    <a class="category-list__link" href="#">
                                        <span class="category-list__box">DX</span>
                                    </a>
                                </li>
                                <li class="category-list">
                                    <a class="category-list__link" href="#">
                                        <span class="category-list__box">CLOUD</span>
                                    </a>
                                </li>
                                <li class="category-list">
                                    <a class="category-list__link" href="#">
                                        <span class="category-list__box">HTML</span>
                                    </a>
                                </li>
                                <li class="category-list">
                                    <a class="category-list__link" href="#">
                                        <span class="category-list__box">CSS</span>
                                    </a>
                                </li>
                                <li class="category-list">
                                    <a class="category-list__link" href="#">
                                        <span class="category-list__box">Java Script</span>
                                    </a>
                                </li>
                                <li class="category-list">
                                    <a class="category-list__link" href="#">
                                        <span class="category-list__box">technology</span>
                                    </a>
                                </li>
                                <li class="category-list">
                                    <a class="category-list__link" href="#">
                                        <span class="category-list__box">information technology</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- タグ
                    ------------------------------------------------->
                    <div class="tag">
                        <div class="tag-block">
                            <ul class="tag-item">
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#AI</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#html</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#css</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#js</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#jquery</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#javascript</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#java</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#information technology</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#technology</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#it</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#ui</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#ux</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#scss</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#github</span>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    <a class="tag-list__link" href="#">
                                        <span class="tag-list__title">#google</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- ピックアップ記事
                        ------------------------------------------------->
                    <div class="pickup">
                        <ul class="blog-title">
                            <li class="blog-title__button active">
                                <a class="blog-title__button_link" href="">新着</a>
                            </li>
                            <li class="blog-title__button">
                                <a class="blog-title__button_link" href="">人気</a>
                            </li>
                        </ul>

                        <!-- 新着記事一覧
                        ------------------------------------------------->
                        <div class="Pickup-Posts active">
                            <ul class="Pickup-Posts-list">
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_01.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">AI</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_02.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">
                                                    Javaのメモリ管理をざっくり理解する（Out-of-Memoryに至る流れ）</div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">クラウド</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_03.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">Java
                                                            Script</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_04.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">Word
                                                            Press</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_05.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">サプライチェーン攻撃</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <button class="view-more">もっと見る...</button>
                        </div>

                        <!-- 人気記事一覧
                        ------------------------------------------------->
                        <div class="Pickup-Posts">
                            <ul class="Pickup-Posts-list">
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_01.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">active:新人AI禁止令と、その結果の答え合わせ
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">AI</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_02.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">
                                                    Javaのメモリ管理をざっくり理解する（Out-of-Memoryに至る流れ）</div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">クラウド</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_03.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">Java
                                                            Script</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_04.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">Word
                                                            Press</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="Pickup-Posts-item">
                                    <a class="Pickup-Posts-item-link" href="#">
                                        <div class="Pickup-Posts-thumbnail">
                                            <img class="Pickup-Posts-thumbnail__img" src="assets/img/blog_04.jpg"
                                                alt="サムネイル画像">
                                        </div>
                                        <div class="Pickup-Posts-lead">
                                            <div class="Pickup-Posts-lead__title">
                                                <div class="Pickup-Posts-lead__title_text">新人AI禁止令と、その結果の答え合わせ
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead__main">
                                                <div class="Pickup-Posts-lead__main_text">
                                                    こんにちは、和田です。いえらぶGROUPで開発部の執行役員を務めています。
                                                    弊社も例に漏れず、今年はAI活用に非常に注力してきました。Cursorを全エンジニアに導入し、テックリードにはClaude
                                                    Codeを配布、
                                                </div>
                                            </div>
                                            <div class="Pickup-Posts-lead-sub">
                                                <div class="Pickup-Posts-lead__date">
                                                    <span class="Pickup-Posts-lead__date_text">20XX.XX.XX</span>
                                                </div>
                                                <div class="Pickup-Posts-lead__category">
                                                    <object class="Pickup-Posts-lead__category_text">
                                                        <a class="Pickup-Posts-lead__category_link"
                                                            href="https://web.kk-protect.co.jp/">サプライチェーン攻撃</a></object>
                                                </div>
                                                <div class="Pickup-Posts-lead__tag">
                                                    <object class="Pickup-Posts-lead__tag_text">
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#AI</a>
                                                        <a class="Pickup-Posts-lead__tag_link01" href="#">#生成AI</a>
                                                    </object>
                                                </div>
                                                <div class="Pickup-Posts-lead__button">
                                                    <span class="Pickup-Posts-lead__button_heart">♡</span>
                                                    <span class="Pickup-Posts-lead__button_number">11</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <button class="view-more">もっと見る...</button>
                        </div>
                    </div>

                    <!-- 目次
                    ------------------------------------------------->
                    <div class="sub-index">
                        <div class="sub-index__title">目次</div>
                        <ul class="sub-index-item">
                            <li class="sub-index-list">
                                <a class="sub-index-list__link" href="#index-1">
                                    <i class="fa-regular fa-square"></i>
                                    はじめに</a>
                            </li>
                            <li class="sub-index-list">
                                <a class="sub-index-list__link" href="#index-2">
                                    <i class="fa-regular fa-square"></i>
                                    最初は「AIをどんどん使わせていた」</a>
                            </li>
                            <li class="sub-index-list">
                                <a class="sub-index-list__link" href="#index-3">
                                    <i class="fa-regular fa-square"></i>
                                    レビュー830件の衝撃</a>
                            </li>
                            <li class="sub-index-list">
                                <a class="sub-index-list__link" href="#index-4">
                                    <i class="fa-regular fa-square"></i>
                                    「AIを神だと思っていました」</a>
                            </li>
                            <li class="sub-index-list">
                                <a class="sub-index-list__link" href="#index-5">
                                    <i class="fa-regular fa-square"></i>
                                    AI禁止令</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>