import $ from "jquery";

export default function single() {
    // pickup記事のタブ切り替え
    const tab = ".blog-title__button";
    const blog = ".Pickup-Posts";
    $(tab).on('click', function () {
        // activeを消す
        $(tab).removeClass('active');
        $(blog).removeClass('active');

        // activeにする
        $(this).addClass('active');

        const index = $(tab).index(this);
        $(blog).eq(index).addClass('active');
    });

    // サイドバーの目次スクロール追従
    $(window).on("scroll", function () {
        const subindex = ".sub-index-list";
        const threshold = 100; // 判定位置のオフセット（px）
        let activeIndex = -1;

        // 現在どのh2のエリアにいるか判定
        $(".main-content__index>h2").each(function (i) {
            const targetTop = $(this).offset().top;
            const scrollTop = $(window).scrollTop();

            if (scrollTop > targetTop - threshold) {
                activeIndex = i;
            }
        });

        // activeを消す
        $(".main-content__index>h2").removeClass('active');
        $(subindex).removeClass('active');

        // activeにする
        if (activeIndex >= 0) {
            $(".main-content__index>h2").eq(activeIndex).addClass('active');
            $(subindex).eq(activeIndex).addClass('active');
        }
    });

    // アウトラインのスクロール同期
    const $subindex = $(".sub-index-list");
    let $links = [];

    // ※注: 必要に応じてアウトライン生成ロジックを追加してください

    $(window).on("scroll", function () {
        const scrollTop = $(window).scrollTop();
        let currentSection = null;

        $links.forEach(function (item) {
            const targetTop = item.target.offset().top;
            if (scrollTop >= targetTop) {
                currentSection = item;
            }
        });

        if (currentSection) {
            $subindex.find("li").removeClass("active");
            currentSection.link.parent("li").addClass("active");
        }
    });
}