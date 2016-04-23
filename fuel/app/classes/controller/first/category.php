<?php
class Controller_First_Category extends Controller_Template
{

	public function action_index()
	{
		$data['first_categories'] = Model_First_Category::find('all');
		$this->template->title = "First_categories";
		$this->template->content = View::forge('first/category/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('first/category');

		if ( ! $data['first_category'] = Model_First_Category::find($id))
		{
			Session::set_flash('error', 'Could not find first_category #'.$id);
			Response::redirect('first/category');
		}

		$this->template->title = "First_category";
		$this->template->content = View::forge('first/category/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_First_Category::validate('create');

			if ($val->run())
			{
				$first_category = Model_First_Category::forge(array(
					'first_category_name' => Input::post('first_category_name'),
					'second_category_id' => Input::post('second_category_id'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($first_category and $first_category->save())
				{
					Session::set_flash('success', 'Added first_category #'.$first_category->id.'.');

					Response::redirect('first/category');
				}

				else
				{
					Session::set_flash('error', 'Could not save first_category.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "First_Categories";
		$this->template->content = View::forge('first/category/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('first/category');

		if ( ! $first_category = Model_First_Category::find($id))
		{
			Session::set_flash('error', 'Could not find first_category #'.$id);
			Response::redirect('first/category');
		}

		$val = Model_First_Category::validate('edit');

		if ($val->run())
		{
			$first_category->first_category_name = Input::post('first_category_name');
			$first_category->second_category_id = Input::post('second_category_id');
			$first_category->deleted_at = Input::post('deleted_at');

			if ($first_category->save())
			{
				Session::set_flash('success', 'Updated first_category #' . $id);

				Response::redirect('first/category');
			}

			else
			{
				Session::set_flash('error', 'Could not update first_category #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$first_category->first_category_name = $val->validated('first_category_name');
				$first_category->second_category_id = $val->validated('second_category_id');
				$first_category->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('first_category', $first_category, false);
		}

		$this->template->title = "First_categories";
		$this->template->content = View::forge('first/category/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('first/category');

		if ($first_category = Model_First_Category::find($id))
		{
			$first_category->delete();

			Session::set_flash('success', 'Deleted first_category #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete first_category #'.$id);
		}

		Response::redirect('first/category');

	}

}
