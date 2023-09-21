<?php

// CommentsControllerクラスはAppControllerを継承する。
// AppControllerはCakePHPの基本的なコントローラの機能を提供する。
class CommentsController extends AppController {

    // helpers配列には、ビューで使用するヘルパーを指定する。
    // HtmlヘルパーとFormヘルパーは、ビューでHTMLやフォームを簡単に作成するためのものだ。
    public $helpers = array('Html', 'Form');

    // addアクションは、新しいコメントを追加する。
    public function add() {
        // POSTリクエストの場合のみ、データの保存を試みる。
        if ($this->request->is('post')) {
            if ($this->Comment->save($this->request->data)) {
                // 保存に成功した場合は、フラッシュメッセージを表示し、関連する記事の詳細ページにリダイレクトする。
                $this->Session->setFlash('Success!');
                $this->redirect(array('controller'=>'posts','action'=>'view',$this->data['Comment']['post_id']));
            } else {
                // 保存に失敗した場合は、フラッシュメッセージを表示する。
                $this->Session->setFlash('failed!');
            }
        }
    }

    // deleteアクションは、指定されたIDのコメントを削除する。
	public function delete($id) {
        // GETリクエストは許可しないので、例外をスローする。
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        // AJAXリクエストの場合、データの削除を試みる。
        if ($this->request->is('ajax')) {
            if ($this->Comment->delete($id)) {
                // レンダリングをオフにし、JSONレスポンスを返す。
                $this->autoRender = false;
                $this->autoLayout = false;
                $response = array('id' => $id);
                $this->header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }
        }

        // 削除後、記事一覧ページにリダイレクトする。
        $this->redirect(array('controller'=>'posts', 'action'=>'index'));
    }
}
