import { createApp } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email, helpers, maxLength } from "@vuelidate/validators";
import VueScrollTo from "vue-scrollto";
import axios from "axios";

// バリデーション
export function orderValidator() {
  const formData = function () {
    return {
      homepage_project_type: { value: "" },
      homepage_category: { value: "" },
      homepage_purpose: { value: "" },
      production_plan: { value: "" },
      completion_deadline: { value: "" },
      homepage_url: { value: "" },
      reference_site: { value: "" },
      page_content: { value: "" },
      server_contract: { value: "" },
      domain_acquisition: { value: "" },
      content: { value: "" },
      order_company: { value: "" },
      order_name: { value: "" },
      order_zip: { value: "" },
      order_address: { value: "" },
      mail: { value: "" }, // 修正
      telnumber: { value: "" },
      faxnumber: { value: "" },
    };
  };

  const form_field = function () {
    return {
      homepage_project_type: {
        label: "制作概要",
        type: "select",
        value: "",
        options: [
          { label: "新規ホームページ作成", value: "new-website" },
          { label: "既存ホームページリニューアル", value: "renewal-website" },
        ],
        error: {
          required: "選択してください",
        },
      },
      homepage_category: {
        label: "ホームページの分類",
        type: "select",
        value: "",
        options: [
          { label: "コーポレートサイト", value: "corporate" },
          { label: "ランディングページ（LP）", value: "landing-page" },
          { label: "サービスサイト", value: "service-site" },
          { label: "店舗・施設サイト", value: "store-facility" },
          { label: "ECサイト", value: "ec-site" },
          { label: "ポータルサイト", value: "portal-site" },
          { label: "メディアサイト", value: "media-site" },
          { label: "その他", value: "other" },
        ],
        error: {
          required: "選択してください",
        },
      },
      homepage_purpose: {
        label: "ホームページの目的",
        type: "select",
        value: "",
        options: [
          { label: "企業情報を発信したい", value: "corporate-info" },
          { label: "集客と売り上げを伸ばしたい", value: "increase-sales" },
        ],
        error: {
          required: "選択してください",
        },
      },
      production_plan: {
        label: "ご希望の制作プラン",
        type: "select",
        value: "",
        options: [
          { label: "ランディングページ（LP）", value: "landing-page" },
          { label: "シンプルプラン", value: "simple-plan" },
          { label: "スタンダードプラン", value: "standard-plan" },
          { label: "ビジネスプロ", value: "business-pro" },
        ],
        error: {
          required: "選択してください",
        },
      },
      completion_deadline: {
        label: "完成希望納期",
        type: "select",
        value: "",
        options: [
          { label: "１ヶ月以内", value: "within-1-month" },
          { label: "１ヶ月～２ヶ月以内", value: "1-to-2-months" },
          { label: "２ヶ月～３ヶ月以内", value: "2-to-3-months" },
          { label: "３ヶ月～６ヶ月以内", value: "3-to-6-months" },
        ],
        error: {
          required: "選択してください",
        },
      },
      homepage_url: {
        label: "現在のホームページURL",
        type: "url",
        placeholder: "https://example.com",
        value: "",
      },
      reference_site: {
        label: "ご希望の参考サイト",
        type: "url",
        placeholder: "https://example.com",
        value: "",
      },
      page_content: {
        label: "ホームページ内容やページ構成について",
        type: "textarea",
        value: "",
      },
      server_contract: {
        label: "サーバー契約",
        type: "select",
        value: "",
        options: [
          { label: "新規サーバー契約", value: "new-server" },
          { label: "既存サーバーを使用", value: "existing-server" },
        ],
        error: {
          required: "選択してください",
        },
      },
      domain_acquisition: {
        label: "ドメイン取得",
        type: "select",
        value: "",
        options: [
          { label: "新規ドメイン取得", value: "new-domain" },
          { label: "既存ドメインを使用", value: "existing-domain" },
        ],
        error: {
          required: "選択してください",
        },
      },
      content: {
        label: "その他・備考",
        type: "textarea",
        value: "",
      },
      order_company: {
        label: "貴社名",
        type: "text",
        placeholder: "株式会社プロテクト",
        value: "",
      },
      order_name: {
        label: "ご担当者様名",
        type: "text",
        placeholder: "山田 太郎",
        value: "",
        error: {
          required: "名前を入力してください",
        },
      },
      order_zip: {
        label: "郵便番号",
        type: "text",
        placeholder: "9790201",
        value: "",
        error: {
          required: "郵便番号を入力してください",
          validZipLength: "7桁で入力してください",
        },
      },
      order_address: {
        label: "所在地",
        type: "text",
        placeholder: "",
        value: "",
        error: {
          required: "所在地を入力してください",
        },
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
      faxnumber: {
        label: "FAX",
        type: "tel",
        placeholder: "0246-85-5812",
        value: "",
      },
    };
  };

  const form = createApp({
    setup() {
      return { v$: useVuelidate() };
    },
    data() {
      return {
        scroll: {
          anchor: "#order_form",
          error: ".error",
          setting: {
            easing: "ease-in-out",
            offset: -50, // 必要ならオフセット調整
          },
        },
        step: 1,
        formFields: form_field(),
        isSubmitting: false, // ボタン状態を管理
      };
    },
    methods: {
      reset(get) {
        this.$data.formFields[get].value = formData()[get].value;
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
      checkSubmit() {
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
      onFormSubmit() {
        this.isSubmitting = true; // ボタンを無効化
      },
      onMailFailed() {
        alert("送信に失敗しました。もう一度お試しください。");
        this.isSubmitting = false; // ボタンを再び有効化
      },
      async getAddress() {
        const zip = this.formFields.order_zip.value;
        if (zip.length === 7) {
          try {
            const response = await axios.get(
              `https://api.zipaddress.net/?zipcode=${zip}`
            );
            if (response.data.code === 200 && response.data.data) {
              this.formFields.order_address.value =
                response.data.data.fullAddress;
            } else {
              alert("住所が見つかりませんでした");
            }
          } catch (error) {
            console.error(error);
            alert("エラーが発生しました");
          }
        }
      },
      async handleSubmit(event) {
        // FormDataオブジェクトを作成
        const formData = new FormData(event.target);
        // `type: "select"`のすべての項目を処理
        Object.keys(this.formFields).forEach((key) => {
          const selectedValue = formData.get(key);
          if (!selectedValue.trim()) {
            formData.set(key, "-");
          }
          const field = this.formFields[key];
          if (field.type === "select" && selectedValue) {
            // 対応するラベルを取得
            const selectedOption = field.options.find(
              (option) => option.value === selectedValue
            );
            // フォームデータをラベルに置き換え
            if (selectedOption) {
              formData.set(key, selectedOption.label);
            }
          }
        });

        const formId = formData.get("_wpcf7"); // CF7フォームのID
        const homeUrl = formData.get("_home_url"); // TOPのアドレス
        const apiEndpoint = `${homeUrl}wp-json/contact-form-7/v1/contact-forms/${formId}/feedback`;

        try {
          this.onFormSubmit(); // ボタンを無効化
          const response = await axios.post(apiEndpoint, formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          });

          if (response.data.status === "mail_sent") {
            this.checkSubmit();
          } else {
            this.onMailFailed();
          }
        } catch (error) {
          this.onMailFailed();
          console.log("送信エラーです。");
        }
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
          homepage_project_type: {
            value: { required },
          },
          homepage_category: {
            value: { required },
          },
          homepage_purpose: {
            value: { required },
          },
          production_plan: {
            value: { required },
          },
          completion_deadline: {
            value: { required },
          },
          homepage_project_type: {
            value: { required },
          },
          server_contract: {
            value: { required },
          },
          domain_acquisition: {
            value: { required },
          },
          order_name: {
            value: { required },
          },
          order_zip: {
            value: {
              required,
              validZipLength: helpers.regex(/^[0-9]{7}$/),
            },
          },
          order_address: {
            value: { required },
          },
          mail: {
            value: { required, email },
          },
          telnumber: {
            value: { required, maxLengthValue: maxLength(15) },
          },
        },
      };
    },
  });

  const form_id = document.getElementById("order_form");
  if (form_id) {
    form.mount("#order_form");
  }
}

// セレクトボックスの初期値をグレーにする
export function selectColor() {
  const form = document.getElementById("order_form");
  if (form) {
    const selects = form.querySelectorAll("select");

    // 各 select 要素にイベントリスナーを設定
    selects.forEach((select) => {
      // 初期状態で色を設定
      if (!select.value) {
        select.style.color = "gray";
      }

      // 値が変更されたときの処理
      select.addEventListener("change", () => {
        if (!select.value) {
          select.style.color = "gray"; // 初期値の場合
        } else {
          select.style.color = "black"; // 変更された場合
        }
      });
    });
  }
}
