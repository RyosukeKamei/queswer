<?php
class Controller_Gotcards extends Controller_Template
{
	/*
	 * ユーザID
	 */
	private $user_id;
	
	public function before()
	{
		parent::before();
	
		/*
		 * 管理者ログインが必要なアクション
		 * なし
		 *
		 * 管理者ログインが不要なアクション（会員用）
		 * list
		*/
		$admin_login_need_action = array();
			
		// 現在アクティブなアクション
		$active = Request::active()->action;
			
		/*
		 * 管理者ログインが必要な画面は認証する
		 */
// 		if(in_array($active, $admin_login_need_action, true)) {
// 			if (!(Auth::check() && (int)Auth::get('group') === 100)) {
// 				Response::redirect('admin/login');
// 			}
// 		}
	
		/*
		 * ユーザID取得
		 */
		$user_infos = Auth::get_user_id();
	
		$this->user_id = $user_infos[1]; // ユーザID取得
	}
	
	/**
	 * action_usergot
	 * これまでに取得したカードを表示
	 */
	public function action_usergot()
	{
		/*
		 * ユーザIDごとに表示
		 */
		$data['gotcards'] = 
			Model_Gotcard::find(
								  'all'
								, array(
									'where' => array(
        								array('user_id', $this->user_id),
    								),
								)
			);
		
		$this->template->title = "あなたがこれまでに取得したカード！";
		$this->template->content = View::forge('gotcards/usergot', $data);
	}
	
	/*
	 * 自動生成したコードは使わない
	 * マスタじゃないので
	 */
// 	public function action_index()
// 	{
// 		$data['gotcards'] = Model_Gotcard::find('all');
// 		$this->template->title = "Gotcards";
// 		$this->template->content = View::forge('gotcards/index', $data);

// 	}

// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('gotcards');

// 		if ( ! $data['gotcard'] = Model_Gotcard::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find gotcard #'.$id);
// 			Response::redirect('gotcards');
// 		}

// 		$this->template->title = "Gotcard";
// 		$this->template->content = View::forge('gotcards/view', $data);

// 	}

// 	public function action_create()
// 	{
// 		if (Input::method() == 'POST')
// 		{
// 			$val = Model_Gotcard::validate('create');

// 			if ($val->run())
// 			{
// 				$gotcard = Model_Gotcard::forge(array(
// 					'user_id' => Input::post('user_id'),
// 					'card_id' => Input::post('card_id'),
// 				));

// 				if ($gotcard and $gotcard->save())
// 				{
// 					Session::set_flash('success', 'Added gotcard #'.$gotcard->id.'.');

// 					Response::redirect('gotcards');
// 				}

// 				else
// 				{
// 					Session::set_flash('error', 'Could not save gotcard.');
// 				}
// 			}
// 			else
// 			{
// 				Session::set_flash('error', $val->error());
// 			}
// 		}

// 		$this->template->title = "Gotcards";
// 		$this->template->content = View::forge('gotcards/create');

// 	}

// 	public function action_edit($id = null)
// 	{
// 		is_null($id) and Response::redirect('gotcards');

// 		if ( ! $gotcard = Model_Gotcard::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find gotcard #'.$id);
// 			Response::redirect('gotcards');
// 		}

// 		$val = Model_Gotcard::validate('edit');

// 		if ($val->run())
// 		{
// 			$gotcard->user_id = Input::post('user_id');
// 			$gotcard->card_id = Input::post('card_id');

// 			if ($gotcard->save())
// 			{
// 				Session::set_flash('success', 'Updated gotcard #' . $id);

// 				Response::redirect('gotcards');
// 			}

// 			else
// 			{
// 				Session::set_flash('error', 'Could not update gotcard #' . $id);
// 			}
// 		}

// 		else
// 		{
// 			if (Input::method() == 'POST')
// 			{
// 				$gotcard->user_id = $val->validated('user_id');
// 				$gotcard->card_id = $val->validated('card_id');

// 				Session::set_flash('error', $val->error());
// 			}

// 			$this->template->set_global('gotcard', $gotcard, false);
// 		}

// 		$this->template->title = "Gotcards";
// 		$this->template->content = View::forge('gotcards/edit');

// 	}

// 	public function action_delete($id = null)
// 	{
// 		is_null($id) and Response::redirect('gotcards');

// 		if ($gotcard = Model_Gotcard::find($id))
// 		{
// 			$gotcard->delete();

// 			Session::set_flash('success', 'Deleted gotcard #'.$id);
// 		}

// 		else
// 		{
// 			Session::set_flash('error', 'Could not delete gotcard #'.$id);
// 		}

// 		Response::redirect('gotcards');

// 	}

}
