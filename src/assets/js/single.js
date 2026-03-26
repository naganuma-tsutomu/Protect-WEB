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

// いいね機能の実装
$(function () {
    const storageKey = 'protect_web_liked_posts';
    // ローカルストレージから「いいね」した記事IDの配列を取得
    let likedPosts = JSON.parse(localStorage.getItem(storageKey)) || [];

    // UI状態を更新する関数
    function updateLikeUI(postId, isLiked) {
        $(`[data-post-id="${postId}"]`).each(function() {
            const $btn = $(this);
            if (isLiked) {
                $btn.addClass('is-active');
                $btn.find('.good__item').text('♥');
            } else {
                $btn.removeClass('is-active');
                $btn.find('.good__item').text('♡');
            }
        });
    }

    // 初期化：保存されている「いいね」をUIに反映
    likedPosts.forEach(id => updateLikeUI(id, true));

    // クリックイベント
    $(document).on('click', '.js-like-button', function() {
        const $btn = $(this);
        const postId = $btn.data('post-id').toString();
        const isActive = $btn.hasClass('is-active');
        const type = isActive ? 'unlike' : 'like';

        // 連続クリック防止
        $('.js-like-button[data-post-id="' + postId + '"]').css('pointer-events', 'none');

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'toggle_like',
                post_id: postId,
                type: type
            },
            success: function(response) {
                if (response.success) {
                    const newCount = response.data.count;
                    
                    // 数値の更新（ページ内の同一IDすべて）
                    $(`[data-post-id="${postId}"]`).each(function() {
                        $(this).find('.good__number, .lead__button_number, .Related-Posts-lead__button_number, .Pickup-Posts-lead__button_number').text(newCount);
                    });

                    // UI（ハートマークとクラス）の更新
                    updateLikeUI(postId, type === 'like');

                    // LocalStorageの更新
                    if (type === 'like') {
                        if (!likedPosts.includes(postId)) likedPosts.push(postId);
                    } else {
                        likedPosts = likedPosts.filter(id => id !== postId);
                    }
                    localStorage.setItem(storageKey, JSON.stringify(likedPosts));
                }
            },
            complete: function() {
                $('.js-like-button[data-post-id="' + postId + '"]').css('pointer-events', 'auto');
            }
        });
    });
});