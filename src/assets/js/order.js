
const form = document.getElementById('order_form');
const selects = form.querySelectorAll('select');

// 各 select 要素にイベントリスナーを設定
selects.forEach(select => {
  // 初期状態で色を設定
  if (!select.value) {
    select.style.color = "gray";
  }

  // 値が変更されたときの処理
  select.addEventListener('change', () => {
    if (!select.value) {
      select.style.color = "gray"; // 初期値の場合
    } else {
      select.style.color = "black"; // 変更された場合
    }
  });
});