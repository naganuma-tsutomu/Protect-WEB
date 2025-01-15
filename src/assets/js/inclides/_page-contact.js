import { createApp } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email, helpers, maxLength } from "@vuelidate/validators";

export default function contactValidator() {

  const formData = function () {
    return {
      // nameVal: "長沼励",
      // mailVal: "m2106m@gmail.com",
      // selectlVal: "商品に対するお問い合わせ",
      // postVal: "配送についてのお問い合わせ",
      nameVal: "",
      companyVal: "",
      mailVal: "",
      telVal: "",
      // セレクトボックスが必要な場合
      // selectlVal: "",
      postVal: "",
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
          nameVal: "",
          companyVal: "",
          mailVal: "",
          telVal: "",
          postVal: "",
        },
        // セレクトボックスが必要な場合
        // val: { nameVal: "", mailVal: "", selectlVal: "", postVal: "" },
      };
    },
    methods: {
      stepForm() {
        this.v$.$touch();
        if (!this.v$.$invalid) {
          this.step.show = !this.step.show;
          this.step.show2 = !this.step.show2;
        }
        // console.log(this.v$.val.postVal);
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
          nameVal: { required }, // Matches this.firstName
          postVal: { required}, // Matches this.lastName
          // セレクトボックスが必要な場合
          // selectlVal: { required }, // Matches this.select
          mailVal: { required, email }, // Matches this.contact.email
          telVal: { required, maxLengthValue: maxLength(15) }, // Matches this.contact.email
        },
      };
    },
  });

  const form_id = document.getElementById("contact_form");
  if (form_id) {
    form.mount("#contact_form");
  }
}
