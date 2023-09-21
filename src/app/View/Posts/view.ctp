<!-- 記事のタイトルを表示する。 -->
<h2><?php echo h($post['Post']['title']); ?></h2>

<!-- 記事の本文を表示する。 -->
<p><?php echo h($post['Post']['body']); ?></p>

<!-- 記事に対するコメントの一覧のタイトルを表示する。 -->
<h2>Comments</h2>

<!-- コメントの一覧を表示するためのリストを開始する。 -->
<ul>
<?php foreach ($post['Comment'] as $comment): ?>
	<!-- 各コメントの内容と削除リンクを表示する。 -->
	<li id="comment_<?php echo h($comment['id']); ?>">
		<?php
		// コメントの内容と投稿者名を表示する。
		echo h($comment['body']) ?> by <?php echo h($comment['commenter']);
		echo '&nbsp;';
		// コメントを削除するためのリンクを生成する。
		echo $this->Html->link('削除', '#', array('class'=>'delete', 'data-comment-id'=>$comment['id']));
		?>
	</li>
<?php endforeach; ?>
</ul>

<!-- 新しいコメントを追加するためのフォームを表示する。 -->
<h2>Add Comment</h2>
<?php
echo $this->Form->create('Comment', array('action'=>'add'));
echo $this->Form->input('commenter'); // コメントの投稿者名入力フィールド
echo $this->Form->input('body', array('rows'=>3)); // コメントの本文入力エリア
echo $this->Form->input('Comment.post_id', array('type'=>'hidden', 'value'=>$post['Post']['id'])); // 対象の記事IDを隠しフィールドで持たせる
echo $this->Form->end('post comment'); // フォームの送信ボタン
?>

<!-- 削除リンクをクリックした際の動作を定義するJavaScriptを書く。 -->
<script>
$(function() {
    $('a.delete').click(function(e) {
        // 削除確認ダイアログを表示する。
        if (confirm('sure?')) {
            // 削除リクエストを送信する。
            $.post('/comments/delete/'+$(this).data('comment-id'), {}, function(res) {
                // 削除が成功した場合、該当するコメントをフェードアウトで非表示にする。
                $('#comment_'+res.id).fadeOut();
            }, "json");
        }
        return false;
    });
});
</script>
