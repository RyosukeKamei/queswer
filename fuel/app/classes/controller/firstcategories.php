<?php
/**
 * Controller_Firstcategories
 * 小項目（離散数学など）
 * 今のところ増減する予定なし、あったとしても頻度は限りなく小さい
 * 当面はDB直接操作で運用
 * ↓
 * コメントアウト
 * 
 * @author sr2smail
 *
 */
// class Controller_Firstcategories extends Controller_Template
// {
	
// 	public function before()
// 	{
// 		parent::before();
		
// 	 	/*
//  		 * 管理者ログインが必要なアクション
//  		 * index
//  		 * view
//  		 * create
//  		 * edit
//  		 * delete
//  		 * 
//  		 */
//  		$admin_login_need_action = array('index', 'view', 'create', 'edit', 'delete'); 
 		
//  		// 現在アクティブなアクション
//  		$active = Request::active()->action;
 		
//  		/*
//  		 * editとdeleteはログインが必要
//  		 */
//  		if(in_array($active, $admin_login_need_action, true)) {
//  			if (!(Auth::check() && (int)Auth::get('group') === 100)) {
//  				Response::redirect('admin/login');
//  			}
//  		}
// 	}

// 	public function action_index()
// 	{
// 		$data['firstcategories'] = Model_Firstcategory::find('all');
// 		$this->template->title = "Firstcategories";
// 		$this->template->content = View::forge('firstcategories/index', $data);

// 	}

// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('firstcategories');

// 		if ( ! $data['firstcategory'] = Model_Firstcategory::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find firstcategory #'.$id);
// 			Response::redirect('firstcategories');
// 		}

// 		$this->template->title = "Firstcategory";
// 		$this->template->content = View::forge('firstcategories/view', $data);

// 	}

// 	public function action_create()
// 	{
// 		if (Input::method() == 'POST')
// 		{
// 			$val = Model_Firstcategory::validate('create');

// 			if ($val->run())
// 			{
// 				$firstcategory = Model_Firstcategory::forge(array(
// 					'secondcategory_id' => Input::post('secondcategory_id'),
// 					'first_category_name' => Input::post('first_category_name'),
// 					'deleted_at' => Input::post('deleted_at'),
// 				));

// 				if ($firstcategory and $firstcategory->save())
// 				{
// 					Session::set_flash('success', 'Added firstcategory #'.$firstcategory->id.'.');

// 					Response::redirect('firstcategories');
// 				}

// 				else
// 				{
// 					Session::set_flash('error', 'Could not save firstcategory.');
// 				}
// 			}
// 			else
// 			{
// 				Session::set_flash('error', $val->error());
// 			}
// 		}

// 		$this->template->title = "Firstcategories";
// 		$this->template->content = View::forge('firstcategories/create');

// 	}

// 	public function action_edit($id = null)
// 	{
// 		is_null($id) and Response::redirect('firstcategories');

// 		if ( ! $firstcategory = Model_Firstcategory::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find firstcategory #'.$id);
// 			Response::redirect('firstcategories');
// 		}

// 		$val = Model_Firstcategory::validate('edit');

// 		if ($val->run())
// 		{
// 			$firstcategory->secondcategory_id = Input::post('secondcategory_id');
// 			$firstcategory->first_category_name = Input::post('first_category_name');
// 			$firstcategory->deleted_at = Input::post('deleted_at');

// 			if ($firstcategory->save())
// 			{
// 				Session::set_flash('success', 'Updated firstcategory #' . $id);

// 				Response::redirect('firstcategories');
// 			}

// 			else
// 			{
// 				Session::set_flash('error', 'Could not update firstcategory #' . $id);
// 			}
// 		}

// 		else
// 		{
// 			if (Input::method() == 'POST')
// 			{
// 				$firstcategory->secondcategory_id = $val->validated('secondcategory_id');
// 				$firstcategory->first_category_name = $val->validated('first_category_name');
// 				$firstcategory->deleted_at = $val->validated('deleted_at');

// 				Session::set_flash('error', $val->error());
// 			}

// 			$this->template->set_global('firstcategory', $firstcategory, false);
// 		}

// 		$this->template->title = "Firstcategories";
// 		$this->template->content = View::forge('firstcategories/edit');

// 	}

// 	public function action_delete($id = null)
// 	{
// 		is_null($id) and Response::redirect('firstcategories');

// 		if ($firstcategory = Model_Firstcategory::find($id))
// 		{
// 			$firstcategory->delete();

// 			Session::set_flash('success', 'Deleted firstcategory #'.$id);
// 		}

// 		else
// 		{
// 			Session::set_flash('error', 'Could not delete firstcategory #'.$id);
// 		}

// 		Response::redirect('firstcategories');

// 	}

// }
