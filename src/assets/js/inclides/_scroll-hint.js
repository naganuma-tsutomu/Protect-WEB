import ScrollHint from 'scroll-hint'
import "scroll-hint/css/scroll-hint.css";

const page_id = document.getElementById("plan");
if (page_id) {
  window.addEventListener("DOMContentLoaded", function () {
    new ScrollHint(".js-scrollable", {
      scrollHintIconAppendClass: "scroll-hint-icon-white",
      suggestiveShadow: true,
      i18n: {
        scrollable: "スクロールできます",
      },
    });
  });
}
