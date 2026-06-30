import $ from "jquery";

// pickup記事のタブ切り替え
$(function () {

    const tab = ".blog-title__button"
    const title = ".blog-title__button_link"
    const blog = ".pickup-posts"
    $(tab).on('click', function () {
        // activeを消す
        $(tab).removeClass('active');
        $(title).removeClass('active');
        $(blog).removeClass('active');

        // activeにする
        $(this).addClass('active');

        const index = $(tab).index(this);
        $(blog).eq(index).addClass('active');

    });
});

// サイドバーの目次スクロール追従
$(window).on("scroll.toc", function () {
    const subindex = ".sub-index-list";
    const threshold = 100; // 判定位置のオフセット（px）
    let activeIndex = -1;

    // h2だけでなく、h3も含めたすべての見出しを上から順番に判定する
    $(".main-content__index h2, .main-content__index h3").each(function (i) {
        const targetTop = $(this).offset().top;
        const scrollTop = $(window).scrollTop();

        if (scrollTop > targetTop - threshold) {
            activeIndex = i;
        }
    });

    // 本文の見出し（h2, h3）とサイドバーの目次リストから一斉にactiveを消す
    $(".main-content__index h2, .main-content__index h3").removeClass('active');
    $(subindex).removeClass('active');

    // activeにする
    if (activeIndex >= 0) {
        // 今読んでいる階層の見出しと、サイドバーの対応する目次（連番）にactiveを付与
        $(".main-content__index h2, .main-content__index h3").eq(activeIndex).addClass('active');
        $(subindex).eq(activeIndex).addClass('active');
    }
});

// いいね機能の実装
$(function () {
    const storageKey = 'protect_web_liked_posts';
    // ローカルストレージから「いいね」した記事IDの配列を取得
    let likedPosts = JSON.parse(localStorage.getItem(storageKey)) || [];

    // UI状態を更新する関数
    function updateLikeUI(postId, isLiked) {
        $(`[data-post-id="${postId}"]`).each(function () {
            const $btn = $(this);
            // ページ内の全ボタンのハートを対象にする
            const $heart = $btn.find('.good__item, .lead__button_heart, .Related-Posts-lead__button_heart');
            if (isLiked) {
                $btn.addClass('is-active');
                $heart.text('♥');
            } else {
                $btn.removeClass('is-active');
                $heart.text('♡');
            }
        });
    }

    // 初期化：保存されている「いいね」をUIに反映
    likedPosts.forEach(id => updateLikeUI(id, true));

    // クリックイベント
    $(document).on('click', '.js-like-button', function () {
        const $btn = $(this);
        const postId = $btn.data('post-id').toString();
        const nonce = $btn.data('nonce');
        const isActive = $btn.hasClass('is-active');
        const type = isActive ? 'unlike' : 'like';

        // 同じpostIdを持つページ内の全ボタンを取得
        const $targetButtons = $(`[data-post-id="${postId}"]`);

        // 連続クリック防止
        $targetButtons.css('pointer-events', 'none');

        $.ajax({
            // dev.phpで定義した like_vars.ajax_url を優先的に使用する
            url: (typeof like_vars !== 'undefined') ? like_vars.ajax_url : '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'toggle_like',
                post_id: postId,
                type: type,
                nonce: nonce // セキュリティトークンを送信
            },
            success: function (response) {
                if (response.success) {
                    const newCount = response.data.count;

                    // 数値の更新（ページ内の同一IDすべて）
                    $targetButtons.each(function () {
                        $(this).find('.good__number, .lead__button_number, .Related-Posts-lead__button_number, .pickup-posts-lead__button_number').text(newCount);
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
            complete: function () {
                $targetButtons.css('pointer-events', 'auto');
            }
        });
    });
});