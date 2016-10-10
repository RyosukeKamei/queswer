<?php
/**
 * Controller_Thirdcategories
 * 大項目（基礎理論・コンピュータシステムなど）
 * 今のところ増減する予定なし、あったとしても頻度は限りなく小さい
 * 当面はDB直接操作で運用
 * ↓
 * コメントアウト
 * 
 * @author sr2smail
 *
 */
class Controller_Thirdcategories extends Controller_Template
{

	public function action_index()
	{
		$data['thirdcategories'] = Model_Thirdcategory::find('all');
		$this->template->title = "Thirdcategories";
		$this->template->content = View::forge('thirdcategories/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('thirdcategories');

		if ( ! $data['thirdcategory'] = Model_Thirdcategory::find($id))
		{
			Session::set_flash('error', 'Could not find thirdcategory #'.$id);
			Response::redirect('thirdcategories');
		}

		$this->template->title = "Thirdcategory";
		$this->template->content = View::forge('thirdcategories/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Thirdcategory::validate('create');

			if ($val->run())
			{
				$thirdcategory = Model_Thirdcategory::forge(array(
					'topcategory_id' => Input::post('topcategory_id'),
					'third_category_name' => Input::post('third_category_name'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($thirdcategory and $thirdcategory->save())
				{
					Session::set_flash('success', 'Added thirdcategory #'.$thirdcategory->id.'.');

					Response::redirect('thirdcategories');
				}

				else
				{
					Session::set_flash('error', 'Could not save thirdcategory.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Thirdcategories";
		$this->template->content = View::forge('thirdcategories/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('thirdcategories');

		if ( ! $thirdcategory = Model_Thirdcategory::find($id))
		{
			Session::set_flash('error', 'Could not find thirdcategory #'.$id);
			Response::redirect('thirdcategories');
		}

		$val = Model_Thirdcategory::validate('edit');

		if ($val->run())
		{
			$thirdcategory->topcategory_id = Input::post('topcategory_id');
			$thirdcategory->third_category_name = Input::post('third_category_name');
			$thirdcategory->deleted_at = Input::post('deleted_at');

			if ($thirdcategory->save())
			{
				Session::set_flash('success', 'Updated thirdcategory #' . $id);

				Response::redirect('thirdcategories');
			}

			else
			{
				Session::set_flash('error', 'Could not update thirdcategory #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$thirdcategory->topcategory_id = $val->validated('topcategory_id');
				$thirdcategory->third_category_name = $val->validated('third_category_name');
				$thirdcategory->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('thirdcategory', $thirdcategory, false);
		}

		$this->template->title = "Thirdcategories";
		$this->template->content = View::forge('thirdcategories/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('thirdcategories');

		if ($thirdcategory = Model_Thirdcategory::find($id))
		{
			$thirdcategory->delete();

			Session::set_flash('success', 'Deleted thirdcategory #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete thirdcategory #'.$id);
		}

		Response::redirect('thirdcategories');

	}

}
