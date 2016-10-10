<?php
/**
 * Controller_Secondcategories
 * 中項目（基礎理論・アルゴリズムとプログラミングなど）
 * 今のところ増減する予定なし、あったとしても頻度は限りなく小さい
 * 当面はDB直接操作で運用
 * ↓
 * コメントアウト
 * 
 * @author sr2smail
 *
 */
class Controller_Secondcategories extends Controller_Template
{

	public function action_index()
	{
		$data['secondcategories'] = Model_Secondcategory::find('all');
		$this->template->title = "Secondcategories";
		$this->template->content = View::forge('secondcategories/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('secondcategories');

		if ( ! $data['secondcategory'] = Model_Secondcategory::find($id))
		{
			Session::set_flash('error', 'Could not find secondcategory #'.$id);
			Response::redirect('secondcategories');
		}

		$this->template->title = "Secondcategory";
		$this->template->content = View::forge('secondcategories/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Secondcategory::validate('create');

			if ($val->run())
			{
				$secondcategory = Model_Secondcategory::forge(array(
					'thirdcategory_id' => Input::post('thirdcategory_id'),
					'second_category_name' => Input::post('second_category_name'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($secondcategory and $secondcategory->save())
				{
					Session::set_flash('success', 'Added secondcategory #'.$secondcategory->id.'.');

					Response::redirect('secondcategories');
				}

				else
				{
					Session::set_flash('error', 'Could not save secondcategory.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Secondcategories";
		$this->template->content = View::forge('secondcategories/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('secondcategories');

		if ( ! $secondcategory = Model_Secondcategory::find($id))
		{
			Session::set_flash('error', 'Could not find secondcategory #'.$id);
			Response::redirect('secondcategories');
		}

		$val = Model_Secondcategory::validate('edit');

		if ($val->run())
		{
			$secondcategory->thirdcategory_id = Input::post('thirdcategory_id');
			$secondcategory->second_category_name = Input::post('second_category_name');
			$secondcategory->deleted_at = Input::post('deleted_at');

			if ($secondcategory->save())
			{
				Session::set_flash('success', 'Updated secondcategory #' . $id);

				Response::redirect('secondcategories');
			}

			else
			{
				Session::set_flash('error', 'Could not update secondcategory #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$secondcategory->thirdcategory_id = $val->validated('thirdcategory_id');
				$secondcategory->second_category_name = $val->validated('second_category_name');
				$secondcategory->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('secondcategory', $secondcategory, false);
		}

		$this->template->title = "Secondcategories";
		$this->template->content = View::forge('secondcategories/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('secondcategories');

		if ($secondcategory = Model_Secondcategory::find($id))
		{
			$secondcategory->delete();

			Session::set_flash('success', 'Deleted secondcategory #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete secondcategory #'.$id);
		}

		Response::redirect('secondcategories');

	}

}
