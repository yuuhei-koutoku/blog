<!-- 記事の一覧のタイトルを表示する。 -->
<h2>記事一覧</h2>

<!-- 記事の一覧を表示するためのリストを開始する。 -->
<ul>
<?php foreach ($posts as $post) : ?>
	<!-- 各記事のタイトル、編集リンク、削除リンクを表示する。 -->
	<li id="post_<?php echo h($post['Post']['id']); ?>">
		<?php
		// 記事のタイトルをクリックすると詳細ページに遷移するリンクを生成する。
		echo $this->Html->link($post['Post']['title'],'/posts/view/'.$post['Post']['id']);
		echo '&nbsp;';
		// 記事の編集ページへのリンクを生成する。
		echo $this->Html->link('編集', array('action'=>'edit', $post['Post']['id']));
		echo '&nbsp;';
		// 記事を削除するためのリンクを生成する。
		echo $this->Html->link('削除', '#', array('class'=>'delete', 'data-post-id'=>$post['Post']['id']));
		?>
	</li>
<?php endforeach; ?>
</ul>

<!-- 新しい記事を追加するリンクを表示する。 -->
<h2>Add Post</h2>
<?php echo $this->Html->link('Add post', array('controller'=>'posts','action'=>'add')); ?>

<!-- 削除リンクをクリックした際の動作を定義するJavaScriptを書く。 -->
<script>
$(function() {
    $('a.delete').click(function(e) {
        // 削除確認ダイアログを表示する。
        if (confirm('sure?')) {
            // 削除リクエストを送信する。
            $.post('/posts/delete/'+$(this).data('post-id'), {}, function(res) {
                // 削除が成功した場合、該当する記事をフェードアウトで非表示にする。
                $('#post_'+res.id).fadeOut();
            }, "json");
        }
        return false;
    });
});
</script>
