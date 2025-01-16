import { gsap } from "gsap";

import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

const slideJs = gsap.utils.toArray(".slideJs");
slideJs.forEach((target) => {
  gsap.fromTo(
    target,
    {
      y: 50,
      autoAlpha: 0,
    },
    {
      y: 0,
      duration: 1 /*アニメーションの時間*/,
      autoAlpha: 1,
      scrollTrigger: {
        trigger: target, //アニメーションが始まるトリガーとなる要素
        start: "center bottom", //アニメーションが始まる位置
      },
    }
  );
});