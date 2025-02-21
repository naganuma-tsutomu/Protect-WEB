// import Swiper JS
import Swiper from "swiper/bundle";
// import Swiper styles
import "swiper/swiper-bundle.css";

const swiper = new Swiper(".swiper", {
  // Optional parameters
  loop: true, // ループさせる
  effect: "slide", // フェードのエフェクト
  speed: 1000,
  autoplay: {
    delay: 2000,
  },

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
  },

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
