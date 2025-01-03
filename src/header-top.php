<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <!-- <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache"> -->
    <script src="https://kit.fontawesome.com/96247f2368.js" crossorigin="anonymous"></script>

    <?php /* ios 入力欄タップ時に画面がズームされないようにする記述  始め */ ?>
    <script>
        var ua = navigator.userAgent.toLowerCase();
        var isiOS = (ua.indexOf('iphone') > -1) || (ua.indexOf('ipad') > -1);
        if (isiOS) {
            var viewport = document.querySelector('meta[name="viewport"]');
            if (viewport) {
                var viewportContent = viewport.getAttribute('content');
                viewport.setAttribute('content', viewportContent + ', user-scalable=no');
            }
        }
    </script>
    <?php /* ios 入力欄タップ時に画面がズームされないようにする記述  終わり */ ?>

    <?php /* フォント追加 */ ?>
    <script>
        (function(d) {
            var config = {
                    kitId: 'rpt3hla',
                    scriptTimeout: 3000,
                    async: true
                },
                h = d.documentElement,
                t = setTimeout(function() {
                    h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
                }, config.scriptTimeout),
                tk = d.createElement("script"),
                f = false,
                s = d.getElementsByTagName("script")[0],
                a;
            h.className += " wf-loading";
            tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
            tk.async = true;
            tk.onload = tk.onreadystatechange = function() {
                a = this.readyState;
                if (f || a && a != "complete" && a != "loaded") return;
                f = true;
                clearTimeout(t);
                try {
                    Typekit.load(config)
                } catch (e) {}
            };
            s.parentNode.insertBefore(tk, s)
        })(document);
    </script>

    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

    <?php wp_head(); ?>
    <meta name="google-site-verification" content="rDkRniiSrOzF_k5ccyGpkrfLe4dCJIARBhFrvuNsvlY" />
</head>

<body <?php body_class(); ?>>
    <main class="main">
        <?php //get_template_part('templates/parts/nav-menu'); 
        ?>
        <?php //get_template_part('templates/parts/breadcrumbs'); 
        ?>
        <div class="top">
            <div class="top-left">
                <ul>
                    <li>
                        <div class="outer-menu">
                            <input class="checkbox-toggle" type="checkbox" />
                            <div class="hamburger">
                                <div></div>
                            </div>
                            <div class="menu">
                                <div>
                                    <div>
                                        <ul>
                                            <li><a href="<?php echo esc_url(home_url()); ?>">HOME</a></li>
                                            <li><a href="<?php echo esc_url(home_url()); ?>#service">SERVICE</a></li>
                                            <li><a href="<?php echo esc_url(home_url('/plan/')); ?>">PLAN</a></li>
                                            <li><a href="<?php echo esc_url(home_url('/order/')); ?>">ORDER</a></li>
                                            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">CONTACT</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="top-left__text">
                            PROTECT WEB CREATION &ensp;<span class="top-left__text_line01">━━━━━━━</span><span class="top-left__text_line02">━━━━━━━</span>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="top-right">
                <div class="top-box"></div>
                <div class="top-box pc"></div>
                <div class="container-top">
                    <div class="container-top__text01">
                        <div class="container-top__text01_inner">
                            <div class="container-top__text01_inner01">あなたのビジョンを、</div>
                            <div class="container-top__text01_inner02">デザインで形に。</div>
                        </div>
                    </div>
                    <div class="container-top__text02">
                        PROTECT <span>WEB</span> CREATION
                    </div>
                </div>
            </div>
        </div>