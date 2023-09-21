<?php

// PostクラスはAppModelを継承する。
// AppModelはCakePHPの基本的なモデルの機能を提供する。
class Post extends AppModel {

	// Postモデルは多数のCommentモデルを持つ関係だ。
	public $hasMany = "Comment";

    // $validate配列は、データのバリデーションルールを定義する。
    public $validate = array(
        // titleフィールドには空でないことを確認するバリデーションルールを設定する。
        'title' => array(
            'rule' => 'notBlank',
            'message' => 'タイトルを入力してください。'
        ),
        // bodyフィールドにも空でないことを確認するバリデーションルールを設定する。
        'body' => array(
            'rule' => 'notBlank',
			'message' => '本文を入力してください。'
        )
    );
}
