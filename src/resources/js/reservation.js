// 予約フォーム画面にて、入力したフォーム内容をリアルタイムで反映させるためのJavaScriptファイル

// 要素を取得
const reservationDate = document.getElementById('reservation_date');
const reservationTime = document.getElementById('reservation_time');
const numberOfPeople = document.getElementById('number_of_people');

// 確認セクションの要素を取得
const confirmDate = document.getElementById('confirm_date');
const confirmTime = document.getElementById('confirm_time');
const confirmPeople = document.getElementById('confirm_people');

// イベントリスナーを追加して動的に更新
reservationDate.addEventListener('change', function() {
    confirmDate.textContent = 'Date: ' + reservationDate.value;
});

reservationTime.addEventListener('change', function() {
    confirmTime.textContent = 'Time: ' + reservationTime.value;
});

numberOfPeople.addEventListener('change', function() {
    confirmPeople.textContent = 'Number: ' + numberOfPeople.value;
});
