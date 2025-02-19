import { gsap } from "gsap";

import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

const slideJs = gsap.utils.toArray(".slideJs");
slideJs.forEach((target) => {
  gsap.fromTo(
    target,
    {
      y: 30,
      autoAlpha: 0,
    },
    {
      y: 0,
      duration: 1 /*アニメーションの時間*/,
      autoAlpha: 1,
      scrollTrigger: {
        trigger: target, //アニメーションが始まるトリガーとなる要素
        start: "center bottom+=15%", //アニメーションが始まる位置
      },
    }
  );
});

const slideJs_x2 = gsap.utils.toArray(".slideJs_x2");
slideJs_x2.forEach((target) => {
  gsap.fromTo(
    target,
    {
      x: -50,
      autoAlpha: 0,
    },
    {
      x: 0,
      duration: 1 /*アニメーションの時間*/,
      autoAlpha: 1,
      scrollTrigger: {
        trigger: target, //アニメーションが始まるトリガーとなる要素
        start: "center bottom", //アニメーションが始まる位置
      },
    }
  );
});

const slideJs_x2_2 = gsap.utils.toArray(".slideJs_x2_2");
slideJs_x2_2.forEach((target) => {
  gsap.fromTo(
    target,
    {
      x: -50,
      autoAlpha: 0,
    },
    {
      x: 0,
      delay: 0.5 /*アニメーションの開始時間*/,
      duration: 3.5 /*アニメーションの時間*/,
      autoAlpha: 1,
      scrollTrigger: {
        trigger: target, //アニメーションが始まるトリガーとなる要素
        start: "center bottom", //アニメーションが始まる位置
      },
    }
  );
});

const slideJs_x2_3 = gsap.utils.toArray(".slideJs_x2_3");
slideJs_x2_3.forEach((target) => {
  gsap.fromTo(
    target,
    {
      x: 50,
      autoAlpha: 0,
    },
    {
      x: 0,
      duration: 1 /*アニメーションの時間*/,
      autoAlpha: 1,
      scrollTrigger: {
        trigger: target, //アニメーションが始まるトリガーとなる要素
        start: "center bottom", //アニメーションが始まる位置
      },
    }
  );
});

const slideJs_x3_2 = gsap.utils.toArray(".slideJs_x3_2");
slideJs_x3_2.forEach((target) => {
  gsap.fromTo(
    target,
    {
      x: 50,
      autoAlpha: 0,
    },
    {
      x: 0,
      delay: 1.5 /*アニメーションの開始時間*/,
      duration: 2 /*アニメーションの時間*/,
      autoAlpha: 1,
      scrollTrigger: {
        trigger: target, //アニメーションが始まるトリガーとなる要素
        start: "center bottom", //アニメーションが始まる位置
      },
    }
  );
});

const slideJs_y2 = gsap.utils.toArray(".slideJs_y2");
slideJs_y2.forEach((target) => {
  gsap.fromTo(
    target,
    {
      y: 30,
      autoAlpha: 0,
    },
    {
      y: 0,
      delay: 2 /*アニメーションの開始時間*/,
      duration: 2 /*アニメーションの時間*/,
      autoAlpha: 1,
      scrollTrigger: {
        trigger: target, //アニメーションが始まるトリガーとなる要素
        start: "center bottom", //アニメーションが始まる位置
      },
    }
  );
});

// 対象の要素を取得
const paragraph = document.querySelector(".js-text");
if (paragraph) {
  // テキストコンテンツを取得
  const textContent = paragraph.textContent;
  // テキストコンテンツを一文字ずつ分割して<span>タグで囲んで新しい文字列を作成
  const newTextContent = [...textContent]
    .map((char) => `<span>${char}</span>`)
    .join("");
  // 新しい文字列をHTMLに挿入
  paragraph.innerHTML = newTextContent;
  paragraph.style.opacity = 1;
  gsap.fromTo(
    ".js-text span", // アニメーションさせる要素
    {
      autoAlpha: 0, // アニメーション開始前は透明
      y: 20, // 20px下に移動
    },
    {
      autoAlpha: 1, // アニメーション後は出現(透過率0)
      y: 0, // 20px上に移動
      repeat: 0, // リピート無し
      //repeatDelay: 1.2, // 1.2秒遅れでリピート
      stagger: 0.1, // 0.1秒遅れて順番に再生
    }
  );
}

window.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".menu a[href]").forEach(function (link) {
    link.addEventListener("click", function () {
      document.getElementById("checkbox-toggle").checked = false;
    });
  });
});
