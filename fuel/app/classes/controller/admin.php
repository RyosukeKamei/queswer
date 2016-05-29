<?php
ini_set( 'display_errors', 1 );
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
	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('admin');

		if ( ! $data['admin'] = Model_Admin::find($id))
		{
			Session::set_flash('error', 'Could not find admin #'.$id);
			Response::redirect('admin');
		}

		$this->template->title = "Admin";
		$this->template->content = View::forge('admin/view', $data);

	}

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
		$data = array();
		if (Input::post())
		{
			Auth::create_user(
					Input::post('username'),
					Input::post('password'),
					Input::post('email'),
					Input::post('examination_id')
			);
			Session::set_flash('success','success create your account.');
			Response::redirect('admin');
		}
		$data["subnav"] = array('register'=> 'active' );
		$this->template->title = 'Login &raquo; Register';
		$this->template->content = View::forge('admin/create', $data);
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
	 * action_createを参考に変更
	 * 
	 * @param int $id 管理者ID
	 */
	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('admin');

		if ( ! $admin = Model_Admin::find($id))
		{
			Session::set_flash('error', 'Could not find admin #'.$id);
			Response::redirect('admin');
		}

		$val = Model_Admin::validate('edit');

		if ($val->run())
		{
			$admin->user_id        = Input::post('user_id');
			$admin->password       = Input::post('password');
			$admin->examination_id = Input::post('examination_id');
			$admin->deleted_at     = Input::post('deleted_at');

			if ($admin->save())
			{
				Session::set_flash('success', 'Updated admin #' . $id);

				Response::redirect('admin');
			}

			else
			{
				Session::set_flash('error', 'Could not update admin #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$admin->user_id        = $val->validated('user_id');
				$admin->password       = $val->validated('password');
				$admin->examination_id = $val->validated('examination_id');
				$admin->deleted_at     = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('admin', $admin, false);
		}

		$this->template->title = "Admins";
		$this->template->content = View::forge('admin/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('admin');

		if ($admin = Model_Admin::find($id))
		{
			$admin->delete();

			Session::set_flash('success', 'Deleted admin #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete admin #'.$id);
		}

		Response::redirect('admin');

	}
	
	public function before()
	{
		//before()をオーバーライドするので、親クラスのbefore()を呼び出す
		parent::before();
	
		//認証済みでなく、現在リクエストされているアクションが'login'でない場合は
		//ログインフォームにリダイレクト
		if (!Auth::check() and Request::active()->action != 'login') {
			//Response::redirect('admin/login');
		}
	
		//ユーザが管理者（Administratorsグループ）であれば
		//is_adminプロパティをtrueに設定
		if (Auth::member(100)) {
			$this->is_admin = true;
		}
		//is_adminプロパティをビューに受け渡す
		View::set_global('is_admin', $this->is_admin);
	}
	
	public function action_login()
	{
		//既にログイン済みであれば会員トップページにリダイレクト
        Auth::check() and Response::redirect('round/index/3');
        
        //usernameとpasswordがPOSTされている場合は認証を試みる
        
        if (Input::post('username') and Input::post('password')) {
            $username = Input::post('username');
            $password = Input::post('password');
            $auth = Auth::instance();

	        //認証に成功したら会員トップページにリダイレクト
	        if ($auth->login($username, $password)) {
	            Response::redirect('round/index/3');
	        }
	            
	        else
	        {
	         	Session::set_flash('error', 'Wrong username/password combo. Try again');
	        }
        }
        
        //ログインフォームの表示
        $this->template->title = "Admins";
        $this->template->content = View::forge('admin/login');
	}
	
	public function action_logout()
	{
		//ログアウト
		$auth = Auth::instance();
		$auth->logout();
	
		//'member'にリダイレクト
		Response::redirect('admin/login');
	}
	
	public function action_register()
	{
		$data = array();
		if (Input::post())
		{
			Auth::create_user(
					Input::post('username'),
					Input::post('password')
			);
			Session::set_flash('success','success create your account.');
			Response::redirect('admin/register');
		}
		$data["subnav"] = array('register'=> 'active' );
		$this->template->title = 'Login &raquo; Register';
		$this->template->content = View::forge('admin', $data);
	}
	

}
