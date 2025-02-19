</main>
<footer id="page-top">
    <div class="footer">
        <div class="footer__contents">
            <ul class="footer__contents_info sp">
                <li>
                    <div class="footer__contents_info_title"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/footer/logo.webp')); ?>" alt="PROTECT WEB CREATION">PROTECT WEB CREATION</div>
                    <div class="footer__contents_menu_contact">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                            <div class="footer__contents_menu_contact_button">お問い合わせ</div>
                        </a>
                    </div>
                    <div class="footer__contents_menu_tel"><span>TEL</span> <a href=”tel:0246-85-5811″>0246-85-5811</a></div>
                </li>
                <li class="footer__contents_menu_copyright">Copyright© <?php echo date('Y'); ?> 株式会社プロテクト All Rights Reserved.</li>
            </ul>

            <ul class="footer__contents_info pc">
                <li>
                    <div class="footer__contents_info_title"><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/footer/logo.webp')); ?>" alt="PROTECT WEB CREATION">PROTECT WEB CREATION</div>
                    <div class="footer__contents_menu_contact">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                            <div class="footer__contents_menu_contact_button">お問い合わせ</div>
                        </a>
                    </div>
                    <div class="footer__contents_menu_tel">TEL：<a href=”tel:0246-85-5811″>0246-85-5811</a></div>
                </li>
                <li class="pc">
                    <div class="footer__contents_menu_list">
                        <div class="menu_home"><a href="<?php echo esc_url(home_url()); ?>">HOME</a></div>
                        <div class="menu_service"><a href="<?php echo esc_url(home_url()); ?>#service">SERVICE</a></div>
                        <div class="menu_plan"><a href="<?php echo esc_url(home_url('/plan/')); ?>">PLAN</a></div>
                        <div class="menu_contact"><a href="<?php echo esc_url(home_url('/contact/')); ?>">CONTACT</a></div>
                    </div>
                </li>
                <li class="footer__contents_menu_copyright">Copyright© <?php echo date('Y'); ?> <a href="https://kk-protect.co.jp/">株式会社プロテクト</a> All Rights Reserved.</li>
            </ul>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>