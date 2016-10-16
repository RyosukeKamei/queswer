<?php
/**
 * Controller_Topcategories
 * カテゴリ（テクノロジ・マネジメント・ストラテジなど）
 * 今のところ増減する予定なし、あったとしても頻度は限りなく小さい
 * 当面はDB直接操作で運用
 * ↓
 * コメントアウト
 * 
 * @author sr2smail
 *
 */
class Controller_Topcategories extends Controller_Template
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
		$data['topcategories'] = Model_Topcategory::find('all');
		$this->template->title = "Topcategories";
		$this->template->content = View::forge('topcategories/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('topcategories');

		if ( ! $data['topcategory'] = Model_Topcategory::find($id))
		{
			Session::set_flash('error', 'Could not find topcategory #'.$id);
			Response::redirect('topcategories');
		}

		$this->template->title = "Topcategory";
		$this->template->content = View::forge('topcategories/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Topcategory::validate('create');

			if ($val->run())
			{
				$topcategory = Model_Topcategory::forge(array(
					'organization_id' => Input::post('organization_id'),
					'top_category_name' => Input::post('top_category_name'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($topcategory and $topcategory->save())
				{
					Session::set_flash('success', 'Added topcategory #'.$topcategory->id.'.');

					Response::redirect('topcategories');
				}

				else
				{
					Session::set_flash('error', 'Could not save topcategory.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Topcategories";
		$this->template->content = View::forge('topcategories/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('topcategories');

		if ( ! $topcategory = Model_Topcategory::find($id))
		{
			Session::set_flash('error', 'Could not find topcategory #'.$id);
			Response::redirect('topcategories');
		}

		$val = Model_Topcategory::validate('edit');

		if ($val->run())
		{
			$topcategory->organization_id = Input::post('organization_id');
			$topcategory->top_category_name = Input::post('top_category_name');
			$topcategory->deleted_at = Input::post('deleted_at');

			if ($topcategory->save())
			{
				Session::set_flash('success', 'Updated topcategory #' . $id);

				Response::redirect('topcategories');
			}

			else
			{
				Session::set_flash('error', 'Could not update topcategory #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$topcategory->organization_id = $val->validated('organization_id');
				$topcategory->top_category_name = $val->validated('top_category_name');
				$topcategory->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('topcategory', $topcategory, false);
		}

		$this->template->title = "Topcategories";
		$this->template->content = View::forge('topcategories/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('topcategories');

		if ($topcategory = Model_Topcategory::find($id))
		{
			$topcategory->delete();

			Session::set_flash('success', 'Deleted topcategory #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete topcategory #'.$id);
		}

		Response::redirect('topcategories');

	}

}
