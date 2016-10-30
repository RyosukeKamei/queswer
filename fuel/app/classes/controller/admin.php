<?php
/**
 * Controller_Admin
 * 管理者CRUD
 * scaffoldベース
 * 
 * プログラミング規約は下記のURLを参照
 * http://sr2s.org/2016/03/Credo.html
 * 
 *
 * 
 * @author sr2smail
 *
 */
class Controller_Admin extends Controller_Template
{
	//管理者かどうかを示すプロパティ
	public $is_admin = false;

	public function before()
	{
		//before()をオーバーライドするので、親クラスのbefore()を呼び出す
		parent::before();
	
		//ユーザが管理者（Administratorsグループ）であれば
		//is_adminプロパティをtrueに設定
		//Auth::member(100)だと値が取れない？
		if ((int)Auth::get('group') === 100)
		{
			$this->is_admin = true;
				
		}
	
		//is_adminプロパティをビューに受け渡す
		View::set_global('is_admin', $this->is_admin);
	
		/*
		 * 管理者ログインが必要なアクション
		 * index
		 * create
		 * edit
		 * delete
		 *
		 * 管理者ログインが不要なアクション
		 * login
		 * logout
		*/
		$admin_login_need_action = array('index', 'create', 'edit', 'delete');
			
		// 現在アクティブなアクション
		$active = Request::active()->action;
			
		/*
		 * ログインが必要な画面は認証をかける
		 */
		if(in_array($active, $admin_login_need_action, true)) {
			if (!(Auth::check() && (int)Auth::get('group') === 100)) {
				Response::redirect('admin/login');
			}
		}
	}
	
	/**
	 * action_index
	 * Adminの一覧
	 * 
	 * scaffoldそのまま
	 * 
	 */
    public function action_index()
	{
		/*
		 * 全件取得
		 */
	    $data['admins'] = Model_Admin::find('all');

	    /*
	     * 画面タイトルは日本語に
	     */
	    $this->template->title = "管理者";
	    
	    /*
	     * （みたらわかるけど最初だけ書いときます）
	     * テンプレート呼び出し
	     */
		$this->template->content = View::forge('admin/index', $data);

	}

	/**
	 * action_view
	 * 詳細画面
	 * scaffoldそのまま
	 * 
	 * 廃止予定
	 * 編集画面があれば良い
	 * 
	 * @param string $id
	 */
// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('admin');

// 		if ( ! $data['admin'] = Model_Admin::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find admin #'.$id);
// 			Response::redirect('admin');
// 		}

// 		$this->template->title = "管理者";
// 		$this->template->content = View::forge('admin/view', $data);

// 	}

	/**
	 * action_create
	 * 登録
	 * 
	 * scaffoldベースにカスタマイズ
	 * ごめん、blowfishって話をしたけど
	 * Fuelphpにsimpleauthって機能あった（笑）
	 * http://fuelphp.jp/docs/1.7/packages/auth/simpleauth/usage.html
	 * ↓
	 * プログラミング規約
	 * FuelPHPの作法に従い、極力FuelPHPのライブラリを使おう！コーディング負荷を軽減
	 * 
	 */
	public function action_create()
	{
		if (Input::post())
		{
			try
			{
				Auth::create_user(
					Input::post('username')
					, Input::post('password')
					, Input::post('email')
					, Input::post('examination_id')
				);
				/*
				 * ブラウザに表示する成功メッセージ
				 * メッセージを一元管理をするかは後ほど検討
				 */
				Session::set_flash('success', '管理者を追加しました。');
				Response::redirect('admin');
			}
			
			catch (Exception $e)
			{
				/*
				 * バリデーションエラーなど
				 * simpleauthのエラーメッセージもここで取得
				 */
				Session::set_flash('error', $e->getMessage());
			}
		}
		
		/*
		 * 画面名
		 */
		$this->template->title = '管理者';
		$this->template->content = View::forge('admin/create');

// 		if (Input::method() == 'POST')
// 		{
// 			/*
// 			 * $valだと「値」と混同するので$validation
// 			 * （Fuelのデフォルト$valだけどここは変えておくことにしようねー）
// 			 * ↓
// 			 * 【プログラミング規約】
// 			 * 変数名・関数名は「短いコメント」と思い、明確で具体的で誤解のない単語を選び、接頭辞・接尾辞をうまく使おう！
// 			 */
// 		    $validation = Model_Admin::validate('create');

// 			if ($validation->run())
// 			{
//                 /*
//                  * パスワードはsimpleauthを使う
//                  * FuelPHPの標準機能だからテスト自動化は一旦不要
//                  */
// // 				$password = Input::post('password');
// // 				var_dump($password);
// // 				var_dump(password_hash($password, PASSWORD_DEFAULT, array('cost' => $this->cost))):
								
// 				$admin = Model_Admin::forge(array(
// 					/*
// 					 * 【プログラミング規約】
// 					 * データベースのカラム名・変数名・inputタグのname属性は統一
// 					 */
// 				    'user_id'        => Input::post('user_id'),
// 					'password'       => Input::post('password'),
// 					'examination_id' => Input::post('examination_id'),
// // 					'deleted_at'     => Input::post('deleted_at'),
// 				));

// 				if ($admin and $admin->save())
// 				{
// 					/*
// 					 * ブラウザに表示する成功メッセージ
// 					 * メッセージを一元管理をするかは後ほど検討
// 					 */
// 				    Session::set_flash('success', '管理者を追加しました。 #'.$admin->id.'.');

// 					Response::redirect('admin');
// 				}

// 				else
// 				{
// 					/*
// 					 * SQLエラーなど（ここは起こりえないはず）
// 					 */
// 				    Session::set_flash('error', '管理者を追加できませんでした。');
// 				}
// 			}
// 			else
// 			{
// 				/*
// 				 * バリデーションエラー
// 				 * 
// 				 */
// 			    Session::set_flash('error', $validation->error());
// 			}
// 		}

// 		/*
// 		 * 画面名
// 		 */
// 		$this->template->title = "管理者作成";
// 		$this->template->content = View::forge('admin/create');

	}

	/**
	 * action_edit
	 * 管理者編集
	 * 
	 * @param int $id 管理者ID
	 */
	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('admin');
		
		/*
		 * @TODO：ここでdeleted_atも条件に追加したい
		 *        削除済みデータは、POST後、simpleauthのチェックで弾いているが。。。
		 */
		if (!$admin = Model_Admin::find($id))
		{
			Session::set_flash('error', '該当する管理者情報は存在しません。');
			Response::redirect('admin');
		}
		
		if (Input::post())
		{
			try
			{
				Auth::update_user(
						$id
						, Input::post('username')
						, Input::post('email')
// 						, Input::post('examination_id')
						, 100
				);
				/*
				 * ブラウザに表示する成功メッセージ
				 * メッセージを一元管理をするかは後ほど検討
				 */
				Session::set_flash('success', '管理者を更新しました。');
				Response::redirect('admin');
			}
				
			catch (Exception $e)
			{
				/*
				 * バリデーションエラーなど
				 * simpleauthのエラーメッセージもここで取得
				 */
				Session::set_flash('error', $e->getMessage());
			}
		}

		/*
		 * 画面名
		 */
		$this->template->title = '管理者';
		$this->template->set_global('admin', $admin, false);
		$this->template->content = View::forge('admin/edit');
	}

	/**
	 * action_delete
	 * 管理者削除
	 *
	 * @param int $id 管理者ID
	 */
	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('admin');
		
		/*
		 * @TODO：ここでdeleted_atも条件に追加したい
		 *        削除済みデータは、POST後、simpleauthのチェックで弾いているが。。。
		 */
		if (!$admin = Model_Admin::find($id))
		{
			Session::set_flash('error', '該当する管理者情報は存在しません。');
			Response::redirect('admin');
		}
		
		try
		{
			Auth::delete_user($id);
			/*
			 * ブラウザに表示する成功メッセージ
			 * メッセージを一元管理をするかは後ほど検討
			*/
			Session::set_flash('success', '管理者を削除しました。');
			Response::redirect('admin');
		}
		
		catch (Exception $e)
		{
			/*
			 * バリデーションエラーなど
			 * simpleauthのエラーメッセージもここで取得
			 */
			Session::set_flash('error', $e->getMessage());
		}

		Response::redirect('admin');

	}
		
	/**
	 * action_login
	 * ログイン
	 *
	 */
	public function action_login()
	{
		//既にログイン済みであれば会員トップページにリダイレクト
        Auth::check() and Response::redirect('keyword/index');
        
        //usernameとpasswordがPOSTされている場合は認証を試みる
        if (Input::post('username') and Input::post('password'))
        {
            $username = Input::post('username');
            $password = Input::post('password');
            $auth = Auth::instance();

	        //認証に成功したら会員トップページにリダイレクト
	        if ($auth->login($username, $password))
	        {
	        	//リダイレクト
	            Response::redirect('keyword/index');
	        }
	            
	        Session::set_flash('error', 'ユーザー名とパスワードが一致しません。');
        }
        
        //ログインフォームの表示
        $this->template->title = "管理者";
        $this->template->content = View::forge('admin/login');
	}
	
	/**
	 * action_logout
	 * ログアウト
	 *
	 */
	public function action_logout()
	{
		//ログアウト
		$auth = Auth::instance();
		$auth->logout();
		
		//ログイン画面にリダイレクト
		Response::redirect('admin/login');
	}
}
