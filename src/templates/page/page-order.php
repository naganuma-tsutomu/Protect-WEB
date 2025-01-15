<?php get_header(); ?>

<body <?php body_class(); ?>>
    <main class="main">
        <?php //get_template_part('templates/parts/nav-menu'); 
        ?>
        <?php //get_template_part('templates/parts/breadcrumbs'); 
        ?>

        <div class="wrapper">
            <div class="container">
                <div id="order" class="order">
                    <div class="contact-form">
                        <div class="contact-form__title">
                            <h2 class="contact-form__title_main">見積り依頼フォーム</h2>
                            <span class="contact-form__title_sub">お見積もりは無料です。お気軽にお問い合わせください。</span>
                        </div>
                        <div class="sitecontact">
                            <!-- 入力フォームstep1 -->
                            <div class="sitecontact__block" v-show="step.show">
                                <div class="form-wrap">
                                    <div class="area-name">
                                        <span class="area-name__text">ご依頼内容</span>
                                    </div>
                                    <div class="input">
                                        <!-------------------------------------------- 基本情報-->
                                        <div class="input__box">
                                            <div class="input__box_th">
                                                <span class="required">制作概要</span>
                                            </div>
                                            <div class="input__box_td">
                                                <span class="wpcf7-form-control-wrap" data-name="select-125">
                                                    <select class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="select-125">
                                                        <option value="">選択してください</option>
                                                        <option value="選択肢 1">新規ホームページ作成</option>
                                                        <option value="選択肢 2">既存ホームページリニューアル</option>
                                                    </select>
                                                </span>
                                                <!-- <span v-if="val['nameVal']" class="clear" @click="reset('nameVal')" v-cloak>×</span> -->
                                                <!-- <span class="wpcf7-not-valid-tip" v-if="v$.val.nameVal.$error" v-cloak>名前が入力されていません。</span> -->
                                            </div>
                                        </div>
                                        <div class="input__box">
                                            <div class="input__box_th">
                                                <span class="required">会社名</span>
                                            </div>
                                            <div class="input__box_td">
                                                <span class="wpcf7-form-control-wrap" data-name="select-125">
                                                    <select class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="select-125">
                                                        <option value="">選択してください</option>
                                                        <option value="選択肢 1">新規ホームページ作成</option>
                                                        <option value="選択肢 2">既存ホームページリニューアル</option>
                                                    </select>
                                                </span>
                                                <!-- <span v-if="val['nameVal']" class="clear" @click="reset('nameVal')" v-cloak>×</span> -->
                                                <!-- <span class="wpcf7-not-valid-tip" v-if="v$.val.nameVal.$error" v-cloak>名前が入力されていません。</span> -->
                                            </div>
                                        </div>
                                        <div class="input__box">
                                            <div class="input__box_th">
                                                <span class="required">メールアドレス</span>
                                            </div>
                                            <div class="input__box_td">
                                                <span data-name="mail" class="wpcf7-form-control-wrap">
                                                    <input :class="{ 'error' : v$.val.mailVal.$error}" v-model="val.mailVal" @blur="v$.val.mailVal.$touch()" aria-invalid="false" placeholder="info@example.com" value="" type="email" name="mail" class="wpcf7-form-control wpcf7-email wpcf7-text">
                                                </span>
                                                <!-- <span v-if="val['mailVal']" class="clear" @click="reset('mailVal')" v-cloak>×</span>
                            <div v-if="v$.val.mailVal.$error" v-cloak>
                                <span class="wpcf7-not-valid-tip" v-if="v$.val.mailVal.required.$invalid" v-cloak>メールアドレスが入力されていません。</span>
                                <span class="wpcf7-not-valid-tip" v-if="v$.val.mailVal.email.$invalid" v-cloak>メールアドレスの形式が正しくありません。</span>
                            </div> -->
                                            </div>
                                        </div>
                                        <div class="input__box">
                                            <div class="input__box_th">
                                                <span class="required">電話番号</span>
                                            </div>
                                            <div class="input__box_td">
                                                <span class="wpcf7-form-control-wrap">
                                                    <input aria-invalid="false" placeholder="0246-85-5811" value="" type="tel" name="telnumber" class="wpcf7-form-control wpcf7-tel wpcf7-text wpcf7-validates-as-tel">
                                                </span>
                                                <!-- <span v-if="val['mailVal']" class="clear" @click="reset('mailVal')" v-cloak>×</span>
                            <div v-if="v$.val.mailVal.$error" v-cloak>
                                <span class="wpcf7-not-valid-tip" v-if="v$.val.mailVal.required.$invalid" v-cloak>メールアドレスが入力されていません。</span>
                                <span class="wpcf7-not-valid-tip" v-if="v$.val.mailVal.email.$invalid" v-cloak>メールアドレスの形式が正しくありません。</span>
                            </div> -->
                                            </div>
                                        </div>
                                        <div class="input__box">
                                            <div class="input__box_th vertical">
                                                <span class="required">お問い合わせ内容</span>
                                            </div>
                                            <div class="input__box_td">
                                                <span data-name="content" class="wpcf7-form-control-wrap">
                                                    <textarea :class="{ 'error' : v$.val.postVal.$error}" v-model="val.postVal" @blur="v$.val.postVal.$touch()" rows="10" aria-invalid="false" placeholder="こちらにお問い合わせ内容をご記入ください。" name="content" class="wpcf7-form-control wpcf7-textarea"></textarea>
                                                </span>
                                                <!-- <span v-if="val['postVal']" class="clear" @click="reset('postVal')">×</span>
                            <span class="wpcf7-not-valid-tip" v-if="v$.val.postVal.$error" v-cloak>お問い合わせ内容が入力されていません。</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 確認ボタン等ブロック -->
                                <div class="buttonblock">
                                    <button type="button" class="buttonblock__confirm" @click="stepForm">入力内容確認</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php get_footer(); ?>