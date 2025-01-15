import { createApp } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email, helpers, maxLength } from "@vuelidate/validators";

// バリデーション
export function orderValidator() {

  const formData = function () {
    return {
      projectSummaryVal: "",
      pageCategoryVal: "",
      pagePurposeVal: "",
      productionPlanVal: "",
      completionDeadlineVal: "",
      homepageUrlVal: "",
      referenceSiteVal: "",
      pageContentVal: "",
      serverContractVal: "",
      domainAcquisitionVal: "",
      postVal: "",
      companyVal: "",
      nameVal: "",
      addressVal: "",
      mailVal: "",
      telVal: "",
    };
  };

  const form = createApp({
    setup() {
      return { v$: useVuelidate() };
    },
    data() {
      return {
        step: {
          show: true,
          show2: false,
          show3: false,
        },
        val: {
          projectSummaryVal: "",
          pageCategoryVal: "",
          pagePurposeVal: "",
          productionPlanVal: "",
          completionDeadlineVal: "",
          homepageUrlVal: "",
          referenceSiteVal: "",
          pageContentVal: "",
          serverContractVal: "",
          domainAcquisitionVal: "",
          postVal: "",
          companyVal: "",
          nameVal: "",
          addressVal: "",
          mailVal: "",
          telVal: "",
        },
      };
    },
    methods: {
      stepForm() {
        this.v$.$touch();
        if (!this.v$.$invalid) {
          this.step.show = !this.step.show;
          this.step.show2 = !this.step.show2;
        }
      },
      reset(get) {
        this.$data.val[get] = formData()[get];
        // Object.assign(this.$data.val, formData()); // 全てリセットの場合
        // this.$v.$touch();
      },
    },
    validations() {
      return {
        val: {
          projectSummaryVal: { required }, // Matches this.select
          pageCategoryVal: { required }, // Matches this.select
          pagePurposeVal: { required }, // Matches this.select
          productionPlanVal: { required }, // Matches this.select
          completionDeadlineVal: { required }, // Matches this.select
          serverContractVal: { required }, // Matches this.select
          domainAcquisitionVal: { required }, // Matches this.select
          postVal: { required}, // Matches this.lastName
          companyVal: { required }, // Matches this.firstName
          nameVal: { required }, // Matches this.firstName
          addressVal: { required }, // Matches this.firstName
          mailVal: { required, email }, // Matches this.contact.email
          telVal: { required, maxLengthValue: maxLength(15) }, // Matches this.contact.email
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
