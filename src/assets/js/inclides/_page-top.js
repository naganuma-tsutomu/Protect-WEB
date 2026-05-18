import $ from "jquery";

export default function pageTop() {
    const $pageTop = $('.js-pagetop');
    const fixedThreshold = 300; //固定を開始するスクロール位置（ページ上部から300px）
    const activeClass = 'active';

    // 表示・非表示を切り替える関数
    const togglePageTop = () => {
        const currentScroll = $(window).scrollTop();
        if (fixedThreshold <= currentScroll){
            $pageTop.addClass(activeClass);
        }else {
            $pageTop.removeClass(activeClass);
        }
    };

    // 実行
    togglePageTop();
    $(window).on('scroll', togglePageTop);

    // クリック時にトップへスムーズスクロール
    $pageTop.on('click', function (e) {
        e.preventDefault();
        $('body,html').animate({
            scrollTop: 0
        }, 500); // 500ミリ秒（0.5秒）かけてトップへ戻る
    });
}