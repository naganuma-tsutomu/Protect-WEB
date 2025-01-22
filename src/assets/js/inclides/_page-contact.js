import { createApp } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email, helpers, maxLength } from "@vuelidate/validators";
import VueScrollTo from "vue-scrollto";

export default function contactValidator() {
  const formData = function () {
    return {
      contact_name: "",
      contact_company: "",
      mail: "",
      telnumber: "",
      content: "",
    };
  };

  const form_field = {
    contact_name: {
      label: "お名前",
      type: "text",
      placeholder: "山田 太郎",
      value: "",
      error: {
        required: "名前を入力してください",
      },
    },
    contact_company: {
      label: "貴社名",
      type: "text",
      placeholder: "株式会社プロテクト",
      value: "",
    },
    mail: {
      label: "メールアドレス",
      type: "email",
      placeholder: "info@example.com",
      value: "",
      error: {
        required: "メールアドレスが入力されていません。",
        email: "メールアドレスの形式が正しくありません",
      },
    },
    telnumber: {
      label: "電話番号",
      type: "tel",
      placeholder: "0246-85-5811",
      value: "",
      error: {
        required: "電話番号が入力されていません",
        maxLengthValue: "電話番号は15桁以内で入力してください",
      },
    },
    content: {
      label: "お問い合わせ内容",
      type: "textarea",
      placeholder: "こちらにお問い合わせ内容をご記入ください",
      value: "",
      error: {
        required: "お問い合わせ内容が入力されていません",
      },
    },
  };

  const form = createApp({
    setup() {
      return { v$: useVuelidate() };
    },
    data() {
      return {
        scroll: {
          anchor: "#contact_form",
          error: ".error",
          setting: {
            easing: "ease-in-out",
            offset: -50, // 必要ならオフセット調整
          },
        },
        step: 1,
        formFields: form_field,
        isSubmitting: false, // ボタン状態を管理
      };
    },
    methods: {
      reset(get) {
        this.$data.formFields[get].value = formData()[get];
      },
      popState() {
        // 履歴を記録する
        history.pushState({ step: this.step }, "", `?step=${this.step}`);
      },
      stepForm() {
        this.v$.$touch();
        if (!this.v$.$invalid) {
          this.step = 2;
          this.popState(); // 履歴を記録する
        } else {
          this.$nextTick(() => {
            VueScrollTo.scrollTo(this.scroll.error, 500, this.scroll.setting);
          });
        }
      },
      backForm() {
        this.step = 1;
        this.popState(); // 履歴を記録する
      },
      checkSubmit(event) {
        this.step = 3;
        this.popState(); // 履歴を記録する
      },
      adjustHeight() {
        // アクティブな要素の高さを取得して親要素に適用
        this.$nextTick(() => {
          const form = this.$refs.form;
          const activeBox = form.querySelector(
            `.v-height:nth-of-type(${this.step})`
          );
          if (activeBox) {
            form.style.height = `${activeBox.offsetHeight + 20}px`;
          }
        });
      },
      onFormSubmit(event) {
        this.isSubmitting = true; // ボタンを無効化
      },
      onMailFailed(event) {
        alert("送信に失敗しました。もう一度お試しください。");
        this.isSubmitting = false; // ボタンを再び有効化
      },
      wpcf7Classes(field, key) {
        return {
          "wpcf7-form-control": true,
          error: field.error && this.v$.formFields[key]?.value.$error,
        };
      },
    },
    watch: {
      v$(v) {
        this.adjustHeight();
      },
      step() {
        this.v$.$touch();
        if (this.v$.$invalid) {
          this.isSubmitting = true; // ボタンを無効化
        }
        // スクロールを実行
        VueScrollTo.scrollTo(this.scroll.anchor, 500, this.scroll.setting);
      },
    },
    mounted() {
      // 初期のパラメータ、履歴を管理
      const urlParams = new URLSearchParams(window.location.search);
      const step = parseInt(urlParams.get("step"), 10);
      if (!urlParams.has("step") || step !== 1) {
        this.popState(); // 履歴を記録する
      }
      // 初期化時の高さ調整
      this.adjustHeight();
      // フォーム送信イベントを監視
      document.addEventListener("submit", this.onFormSubmit);
      document.addEventListener("wpcf7mailsent", this.checkSubmit);
      document.addEventListener("wpcf7mailfailed", this.onMailFailed);
      document.addEventListener("wpcf7spam", this.onMailFailed);
      document.addEventListener("wpcf7invalid", this.onMailFailed);
      // popstateイベントを監視
      window.addEventListener("popstate", (event) => {
        if (event.state && event.state.step) {
          this.step = event.state.step;
        }
      });
    },
    validations() {
      return {
        formFields: {
          contact_name: {
            value: { required }, // Matches this.firstName
          },
          mail: {
            value: { required, email }, // Matches this.firstName
          },
          telnumber: {
            value: { required, maxLengthValue: maxLength(15) }, // Matches this.firstName
          },
          content: {
            value: { required }, // Matches this.firstName
          },
        },
      };
    },
  });

  const form_id = document.getElementById("contact_form");
  if (form_id) {
    form.use(VueScrollTo);
    form.mount("#contact_form");
  }
}
