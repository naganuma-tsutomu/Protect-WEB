import $ from "jquery";

// pickup記事のタブ切り替え
$(function () {

    const tab = ".blog-title__button"
    const blog = ".Pickup-Posts"
    $(tab).on('click', function () {
        // activeを消す
        $(tab).removeClass('active');
        $(blog).removeClass('active');

        // activeにする
        $(this).addClass('active');

        const index = $(tab).index(this);
        $(blog).eq(index).addClass('active');

    });
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
































$(function () {
    const $header = $(".main-content__index");
    const $subindex = $(".sub-index-list");
    let $links = [];

    // アウトラインの作成
    // $header.find("h2").each(function (index) {
    //     const $element = $(this);
    //     const id = "content_" + index;
    //     $element.attr("id", id);
    //     const $link = $("<a></a>")
    //         .text($element.text())
    //         .attr("href", "#" + id);
    //     $subindex.append($("<li></li>").append($link));
    //     $links.push({ link: $link, target: $element });
    // });

    // スクロール時の処理
    $(window).on("scroll", function () {
        // 現在のスクロール位置
        const scrollTop = $(window).scrollTop();
        let currentSection = null;

        $links.forEach(function (item) {
            // 格タイトルの画面上の位置
            const targetTop = item.target.offset().top;
            // もしもスクロール位置が、該当タイトルよりも大きい場合
            if (scrollTop >= targetTop) {
                // 適当なオフセット
                currentSection = item;
            }
        });

        if (currentSection) {
            $subindex.find("li").removeClass("active");
            currentSection.link.parent("li").addClass("active");
        }
    });
});