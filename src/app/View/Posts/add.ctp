<!-- 新しい記事を追加するためのフォームのタイトルを表示する。 -->
<h2>Add post</h2>

<?php
// 新しい記事を追加するためのフォームを生成する。
echo $this->Form->create('Post');
echo $this->Form->input('title'); // 記事のタイトル入力フィールド
echo $this->Form->input('body', array('rows'=>3)); // 記事の本文入力エリア
echo $this->Form->end('Save Post'); // フォームの送信ボタン
?>
