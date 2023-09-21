<?php

// PostsControllerクラスはAppControllerを継承する。
// AppControllerはCakePHPの基本的なコントローラの機能を提供する。
class PostsController extends AppController {

    // helpers配列には、ビューで使用するヘルパーを指定する。
    // HtmlヘルパーとFormヘルパーは、ビューでHTMLやフォームを簡単に作成するためのものだ。
    public $helpers = array('Html', 'Form');

    // indexアクションは、ブログの記事一覧を表示する。
    public function index() {
        // Postモデルを使って、すべての記事を取得する。
        $this->set('posts', $this->Post->find('all'));

        // ビューの<title>タグで表示するタイトルを設定する。
		$this->set('title_for_layout', '記事一覧');
    }

    // viewアクションは、指定されたIDのブログ記事を表示する。
	public function view($id = null) {
        // Postモデルのidに、指定されたIDを設定する。
        $this->Post->id = $id;

        // 指定されたIDの記事の詳細を取得してビューにセットする。
        $this->set('post', $this->Post->read());
    }

    // addアクションは、新しいブログ記事を追加する。
	public function add() {
        // POSTリクエストの場合のみ、データの保存を試みる。
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                // 保存に成功した場合は、フラッシュメッセージを表示し、記事一覧ページにリダイレクトする。
                $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'index'));
            } else {
                // 保存に失敗した場合は、フラッシュメッセージを表示する。
                $this->Session->setFlash('failed!');
            }
        }
    }

    // editアクションは、指定されたIDのブログ記事を編集する。
	public function edit($id = null) {
        $this->Post->id = $id;

        // GETリクエストの場合、編集する記事のデータを取得してフォームに表示する。
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            // POSTリクエストの場合、編集したデータの保存を試みる。
            if ($this->Post->save($this->request->data)) {
                // 保存に成功した場合は、フラッシュメッセージを表示し、記事一覧ページにリダイレクトする。
                $this->Session->setFlash('success!');
                $this->redirect(array('action'=>'index'));
            } else {
                // 保存に失敗した場合は、フラッシュメッセージを表示する。
                $this->Session->setFlash('failed!');
            }
        }
    }

    // deleteアクションは、指定されたIDのブログ記事を削除する。
    public function delete($id) {
        // GETリクエストは許可しないので、例外をスローする。
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        // AJAXリクエストの場合、データの削除を試みる。
        if ($this->request->is('ajax')) {
            if ($this->Post->delete($id)) {
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
        $this->redirect(array('action'=>'index'));
    }
}
