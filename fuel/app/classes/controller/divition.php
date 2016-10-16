<?php
/**
 * Controller_Divition
 * 問題種別
 * 今のところ増減する予定なし、あったとしても頻度は限りなく小さい
 * 当面はDB直接操作で運用
 * ↓
 * コメントアウト
 * 
 * @author sr2smail
 *
 */
class Controller_Divition extends Controller_Template
{
	
	public function before()
	{
		parent::before();
		
		//許可するアクション
 		$action = array('view');
 		//アクティブなアクション
 		$active = Request::active()->action;
	 		
		//ログイン画面にリダイレクト
		if (!Auth::check()) {
			Response::redirect('admin/login');
		}
		
		//管理者アクセス不可の場合、管理者一覧画面にリダイレクト ※暫定
		if (!in_array($active, $action, true)) {
			Response::redirect('admin/index');
		}
	}

	public function action_index()
	{
		$data['divitions'] = Model_Divition::find('all');
		$this->template->title = "Divitions";
		$this->template->content = View::forge('divition/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('divition');

		if ( ! $data['divition'] = Model_Divition::find($id))
		{
			Session::set_flash('error', 'Could not find divition #'.$id);
			Response::redirect('divition');
		}

		$this->template->title = "Divition";
		$this->template->content = View::forge('divition/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Divition::validate('create');

			if ($val->run())
			{
				$divition = Model_Divition::forge(array(
					'divition_name' => Input::post('divition_name'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($divition and $divition->save())
				{
					Session::set_flash('success', 'Added divition #'.$divition->id.'.');

					Response::redirect('divition');
				}

				else
				{
					Session::set_flash('error', 'Could not save divition.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Divitions";
		$this->template->content = View::forge('divition/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('divition');

		if ( ! $divition = Model_Divition::find($id))
		{
			Session::set_flash('error', 'Could not find divition #'.$id);
			Response::redirect('divition');
		}

		$val = Model_Divition::validate('edit');

		if ($val->run())
		{
			$divition->divition_name = Input::post('divition_name');
			$divition->deleted_at = Input::post('deleted_at');

			if ($divition->save())
			{
				Session::set_flash('success', 'Updated divition #' . $id);

				Response::redirect('divition');
			}

			else
			{
				Session::set_flash('error', 'Could not update divition #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$divition->divition_name = $val->validated('divition_name');
				$divition->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('divition', $divition, false);
		}

		$this->template->title = "Divitions";
		$this->template->content = View::forge('divition/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('divition');

		if ($divition = Model_Divition::find($id))
		{
			$divition->delete();

			Session::set_flash('success', 'Deleted divition #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete divition #'.$id);
		}

		Response::redirect('divition');

	}

}
