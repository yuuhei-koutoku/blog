<!-- 記事を編集するためのフォームのタイトルを表示する。 -->
<h2>Edit Post</h2>

<?php
// 記事を編集するためのフォームを生成する。
echo $this->Form->create('Post', array('action'=>'edit'));
echo $this->Form->input('title'); // 記事のタイトル入力フィールド
echo $this->Form->input('body', array('rows'=>3)); // 記事の本文入力エリア
echo $this->Form->end('Save!'); // フォームの送信ボタン
?>
