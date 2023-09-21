<?php

// CommentクラスはAppModelを継承する。
// AppModelはCakePHPの基本的なモデルの機能を提供する。
class Comment extends AppModel {

    // CommentモデルはPostモデルに所属する関係だ。
    public $belongsTo = 'Post';
}
