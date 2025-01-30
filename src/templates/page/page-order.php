<?php
$form = get_posts(array(
    'post_type' => 'wpcf7_contact_form',
    'post_status' => 'publish',
    'title' => '見積り依頼フォーム' // title
));

if (!empty($form)) {
    $formID = $form[0]->ID;
} else {
    $formID = ''; // デフォルト値
}
?>

<div class="contact-form" id="order_form">
    <div class="contact-form__title">
        <!--<h2 class="contact-form__title_main">見積り依頼フォーム</h2>-->
        <span class="contact-form__title_sub">お見積りは無料です。<br>お気軽にお問い合わせください。</span>
    </div>
    <form @submit.prevent="handleSubmit">
        <input type="hidden" name="_wpcf7" value="<?php echo esc_attr($formID); ?>">
        <input type="hidden" name="_wpcf7_unit_tag" value="<?php echo esc_attr('wpcf7-f' . $formID) . '-o1'; ?>">
        <input type="hidden" name="_wpcf7_locale" value="ja">
        <input type="hidden" name="_wpcf7_container_post" value="0">
        <input type="hidden" name="_home_url" value="<?php echo esc_url(home_url('/')); ?>">
        <?php /* 入力フォームstep1 */ ?>
        <div class="sitecontact" ref="form">
            <Transition
                name="fade"
                @after-enter="adjustHeight"
                @after-leave="adjustHeight">
                <div class="sitecontact__block v-height" v-show="step === 1">
                    <div class="area-name">
                        <span class="area-name__text">ご依頼内容</span>
                    </div>
                    <?php /* -------------------- 依頼内容 */ ?>
                    <div class="input">
                        <div v-for="([key, field], index) in Object.entries(formFields).slice(0, 11)" :key="key" class="input__box">
                            <div class="input__box_th">
                                <label :class="{'required': field.error,}" :for="key">
                                    {{ field.label }}
                                </label>
                            </div>
                            <div class="input__box_td">
                                <template v-if="field.type === 'select'">
                                    <select
                                        v-model="formFields[key].value"
                                        @blur="v$.formFields[key]?.value?.$touch"
                                        @keydown.enter.prevent
                                        :placeholder="field.placeholder || ''"
                                        :name="key"
                                        :id="key"
                                        value=""
                                        :aria-invalid="field.error && v$.formFields[key]?.value?.$error ? true : false"
                                        :aria-required="field.error ? true : false"
                                        :class="{'error': field.error && v$.formFields[key]?.value.$error,}">
                                        <option value="" disabled selected>選択してください</option>
                                        <option
                                            v-for="option in field.options"
                                            :key="option.value"
                                            :value="option.value">
                                            {{ option.label }}
                                        </option>
                                    </select>
                                </template>

                                <template
                                    v-else-if="['text', 'email', 'tel','url'].includes(field.type)">
                                    <input
                                        v-model="formFields[key].value"
                                        @blur="v$.formFields[key]?.value?.$touch"
                                        @keydown.enter.prevent
                                        :placeholder="field.placeholder || ''"
                                        :name="key"
                                        :id="key"
                                        value=""
                                        :type="field.type"
                                        :aria-invalid="field.error && v$.formFields[key]?.value?.$error ? true : false"
                                        :aria-required="field.error ? true : false"
                                        :class="{'error': field.error && v$.formFields[key]?.value.$error,}" />
                                    <div
                                        v-if="formFields[key].value"
                                        class="clear"
                                        @click="reset(key)"
                                        v-cloak>
                                        <span>×</span>
                                    </div>
                                </template>

                                <template v-if="field.type === 'textarea'">
                                    <textarea
                                        v-model="formFields[key].value"
                                        @blur="v$.formFields[key]?.value?.$touch"
                                        :placeholder="field.placeholder || ''"
                                        :name="key"
                                        :id="key"
                                        :rows="field.rows || '10'"
                                        value=""
                                        :type="field.type"
                                        :aria-invalid="field.error && v$.formFields[key]?.value?.$error ? true : false"
                                        :aria-required="field.error ? true : false"
                                        :class="{'error': field.error && v$.formFields[key]?.value.$error,}"></textarea>
                                    <div
                                        v-if="formFields[key].value"
                                        class="clear"
                                        @click="reset(key)"
                                        v-cloak>
                                        <span>×</span>
                                    </div>
                                </template>

                                <template v-if="field.error && v$.formFields[key]?.value.$error">
                                    <div
                                        v-for="(error_field, error_key) in formFields[key]['error']"
                                        :key="error_key"
                                        v-cloak>
                                        <span
                                            class="not-valid-tip"
                                            v-if="v$.formFields[key].value[error_key].$invalid"
                                            v-cloak>{{ formFields[key].error[error_key] }}</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <?php /* -------------------- 基本情報 */ ?>
                    <div class="area-name">
                        <span class="area-name__text">お客様情報</span>
                    </div>
                    <div class="input">
                        <div v-for="([key, field], index) in Object.entries(formFields).slice(11)" :key="key" class="input__box">
                            <div class="input__box_th">
                                <label :class="{'required': field.error,}" :for="key">
                                    {{ field.label }}
                                </label>
                            </div>
                            <div class="input__box_td">
                                <template v-if="field.type === 'select'">
                                    <select
                                        v-model="formFields[key].value"
                                        @blur="v$.formFields[key]?.value?.$touch"
                                        @keydown.enter.prevent
                                        :placeholder="field.placeholder || ''"
                                        :name="key"
                                        :id="key"
                                        value=""
                                        :aria-invalid="field.error && v$.formFields[key]?.value?.$error ? true : false"
                                        :aria-required="field.error ? true : false"
                                        :class="{'error': field.error && v$.formFields[key]?.value.$error,}">
                                        <option value="" disabled selected>選択してください</option>
                                        <option
                                            v-for="option in field.options"
                                            :key="option.value"
                                            :value="option.value">
                                            {{ option.label }}
                                        </option>
                                    </select>
                                </template>

                                <template v-else-if="field?.error?.validZipLength">
                                    <input
                                        v-model="formFields[key].value"
                                        @blur="v$.formFields[key]?.value?.$touch"
                                        @input="getAddress"
                                        @keydown.enter.prevent
                                        :placeholder="field.placeholder || ''"
                                        :name="key"
                                        :id="key"
                                        value=""
                                        :type="field.type"
                                        :aria-invalid="field.error && v$.formFields[key]?.value?.$error ? true : false"
                                        :aria-required="field.error ? true : false"
                                        :class="{'error': field.error && v$.formFields[key]?.value.$error,}">
                                    <div
                                        v-if="formFields[key].value"
                                        class="clear"
                                        @click="reset(key)"
                                        v-cloak>
                                        <span>×</span>
                                    </div>
                                </template>

                                <template
                                    v-else-if="['text', 'email', 'tel','url'].includes(field.type)">
                                    <input
                                        v-model="formFields[key].value"
                                        @blur="v$.formFields[key]?.value?.$touch"
                                        @keydown.enter.prevent
                                        :placeholder="field.placeholder || ''"
                                        :name="key"
                                        :id="key"
                                        value=""
                                        :type="field.type"
                                        :aria-invalid="field.error && v$.formFields[key]?.value?.$error ? true : false"
                                        :aria-required="field.error ? true : false"
                                        :class="{'error': field.error && v$.formFields[key]?.value.$error,}" />
                                    <div
                                        v-if="formFields[key].value"
                                        class="clear"
                                        @click="reset(key)"
                                        v-cloak>
                                        <span>×</span>
                                    </div>
                                </template>

                                <template v-if="field.type === 'textarea'">
                                    <textarea
                                        v-model="formFields[key].value"
                                        @blur="v$.formFields[key]?.value?.$touch"
                                        :placeholder="field.placeholder || ''"
                                        :name="key"
                                        :id="key"
                                        :rows="field.rows || '10'"
                                        value=""
                                        :type="field.type"
                                        :aria-invalid="field.error && v$.formFields[key]?.value?.$error ? true : false"
                                        :aria-required="field.error ? true : false"
                                        :class="{'error': field.error && v$.formFields[key]?.value.$error,}"></textarea>
                                    <div
                                        v-if="formFields[key].value"
                                        class="clear"
                                        @click="reset(key)"
                                        v-cloak>
                                        <span>×</span>
                                    </div>
                                </template>

                                <template v-if="field.error && v$.formFields[key]?.value.$error">
                                    <div
                                        v-for="(error_field, error_key) in formFields[key]['error']"
                                        :key="error_key"
                                        v-cloak>
                                        <span
                                            class="not-valid-tip"
                                            v-if="v$.formFields[key].value[error_key].$invalid"
                                            v-cloak>{{ formFields[key].error[error_key] }}</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="valid-error">
                        <span v-if="v$.formFields.$error" v-cloak>×入力内容に問題があります。</span>
                    </div>
                    <?php /* 確認ボタン等ブロック */ ?>
                    <div class="buttonblock">
                        <button type="button" class="buttonblock__confirm" @click="stepForm">
                            入力内容確認
                        </button>
                    </div>
                </div>
            </Transition>
            <?php /* 入力フォームstep2 */ ?>
            <Transition
                name="fade"
                @after-enter="adjustHeight"
                @after-leave="adjustHeight">
                <div class="sitecontact__block v-height" v-show="step === 2" v-cloak>
                    <div class="confirm-text">
                        <span class="confirm-text__main">以下の内容で送信してもよろしいですか？</span>
                    </div>
                    <div class="area-name-confirm">
                        <span class="area-name-confirm__text">ご依頼内容</span>
                    </div>
                    <div class="con-input">
                        <?php /* -------------------------------------------- 確認 --- */ ?>
                        <div
                            v-for="([key, field], index) in Object.entries(formFields).slice(0, 11)"
                            :key="key"
                            class="con-input__box">
                            <div class="con-input__box_th">
                                <span class="con-label"> {{ field.label }} </span>
                            </div>
                            <div class="con-input__box_td">
                                <template v-if="field.type === 'select'">
                                    <p>{{ field.options.find(option => option.value === field.value)?.label || "-" }}</p>
                                </template>
                                <template v-else>
                                    <p>{{ field.value || "-" }}</p>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="area-name-confirm">
                        <span class="area-name-confirm__text">お客様情報</span>
                    </div>
                    <div class="con-input">
                        <?php /* -------------------------------------------- 確認 --- */ ?>
                        <div
                            v-for="([key, field], index) in Object.entries(formFields).slice(11)"
                            :key="key"
                            class="con-input__box">
                            <div class="con-input__box_th">
                                <span class="con-label"> {{ field.label }} </span>
                            </div>
                            <div class="con-input__box_td">
                                <template v-if="field.type === 'select'">
                                    <p>{{ field.options.find(option => option.value === field.value)?.label || "-" }}</p>
                                </template>
                                <template v-else>
                                    <p>{{ field.value || "-" }}</p>
                                </template>
                            </div>
                        </div>
                    </div>
                    <p class="recaptcha">
                        このサイトはreCAPTCHAによって保護されており、Googleの
                        <a href="https://policies.google.com/privacy">プライバシーポリシー</a>と
                        <a href="https://policies.google.com/terms">利用規約</a>が適用されます。
                    </p>
                    <?php /* 確認ボタン等ブロック */ ?>
                    <div class="buttonblock">
                        <button type="button" class="buttonblock__edit" @click="backForm">
                            入力内容を編集する
                        </button>
                        <button
                            type="submit"
                            class="buttonblock__send"
                            :disabled="isSubmitting"
                            class="buttonblock__send">
                            {{ isSubmitting ? "送信中..." : "送信する" }}
                        </button>
                    </div>
                </div>
            </Transition>
            <?php /* 入力フォームstep3 */ ?>
            <Transition
                name="fade"
                @after-enter="adjustHeight"
                @after-leave="adjustHeight">
                <div class="sitecontact__block v-height" v-show="step === 3" v-cloak>
                    <div class="thanks">
                        <p class="thankstxt">お問い合わせありがとうございます。</p>
                        <p>
                            ご入力頂きましたメールアドレス宛に、お問い合わせ内容を記載したメールを送信いたしましたのでご確認ください。
                        </p>
                        <p class="thankspstsc">
                            お問い合わせ内容につきましては
                            ２～３日後に回答いたしますので今しばらくお待ちください。<br />なお、一週間がたちましても連絡がない場合は恐れ入りますが。直接お電話にてご確認をお願いいたします。
                        </p>
                    </div>
                    <div class="buttonblock">
                        <a class="buttonblock__top" href="<?php echo esc_url(home_url('/')); ?>">TOPページに戻る</a>
                    </div>
                </div>
            </Transition>
        </div>
    </form>
</div>