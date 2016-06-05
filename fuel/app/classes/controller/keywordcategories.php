<?php
class Controller_Keywordcategories extends Controller_Template
{

	public function action_index()
	{
		$data['keywordcategories'] = Model_Keywordcategory::find('all');
		$this->template->title = "Keywordcategories";
		$this->template->content = View::forge('keywordcategories/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('keywordcategories');

		if ( ! $data['keywordcategory'] = Model_Keywordcategory::find($id))
		{
			Session::set_flash('error', 'Could not find keywordcategory #'.$id);
			Response::redirect('keywordcategories');
		}

		$this->template->title = "Keywordcategory";
		$this->template->content = View::forge('keywordcategories/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Keywordcategory::validate('create');

			if ($val->run())
			{
				$keywordcategory = Model_Keywordcategory::forge(array(
					'firstcategory_id' => Input::post('firstcategory_id'),
					'keyword_id' => Input::post('keyword_id'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($keywordcategory and $keywordcategory->save())
				{
					Session::set_flash('success', 'Added keywordcategory #'.$keywordcategory->id.'.');

					Response::redirect('keywordcategories');
				}

				else
				{
					Session::set_flash('error', 'Could not save keywordcategory.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Keywordcategories";
		$this->template->content = View::forge('keywordcategories/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('keywordcategories');

		if ( ! $keywordcategory = Model_Keywordcategory::find($id))
		{
			Session::set_flash('error', 'Could not find keywordcategory #'.$id);
			Response::redirect('keywordcategories');
		}

		$val = Model_Keywordcategory::validate('edit');

		if ($val->run())
		{
			$keywordcategory->firstcategory_id = Input::post('firstcategory_id');
			$keywordcategory->keyword_id = Input::post('keyword_id');
			$keywordcategory->deleted_at = Input::post('deleted_at');

			if ($keywordcategory->save())
			{
				Session::set_flash('success', 'Updated keywordcategory #' . $id);

				Response::redirect('keywordcategories');
			}

			else
			{
				Session::set_flash('error', 'Could not update keywordcategory #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$keywordcategory->firstcategory_id = $val->validated('firstcategory_id');
				$keywordcategory->keyword_id = $val->validated('keyword_id');
				$keywordcategory->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('keywordcategory', $keywordcategory, false);
		}

		$this->template->title = "Keywordcategories";
		$this->template->content = View::forge('keywordcategories/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('keywordcategories');

		if ($keywordcategory = Model_Keywordcategory::find($id))
		{
			$keywordcategory->delete();

			Session::set_flash('success', 'Deleted keywordcategory #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete keywordcategory #'.$id);
		}

		Response::redirect('keywordcategories');

	}

}
