<?php
class Controller_Second_Category extends Controller_Template
{

	public function action_index()
	{
		$data['second_categories'] = Model_Second_Category::find('all');
		$this->template->title = "Second_categories";
		$this->template->content = View::forge('second/category/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('second/category');

		if ( ! $data['second_category'] = Model_Second_Category::find($id))
		{
			Session::set_flash('error', 'Could not find second_category #'.$id);
			Response::redirect('second/category');
		}

		$this->template->title = "Second_category";
		$this->template->content = View::forge('second/category/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Second_Category::validate('create');

			if ($val->run())
			{
				$second_category = Model_Second_Category::forge(array(
					'second_category_name' => Input::post('second_category_name'),
					'third_category_id' => Input::post('third_category_id'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($second_category and $second_category->save())
				{
					Session::set_flash('success', 'Added second_category #'.$second_category->id.'.');

					Response::redirect('second/category');
				}

				else
				{
					Session::set_flash('error', 'Could not save second_category.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Second_Categories";
		$this->template->content = View::forge('second/category/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('second/category');

		if ( ! $second_category = Model_Second_Category::find($id))
		{
			Session::set_flash('error', 'Could not find second_category #'.$id);
			Response::redirect('second/category');
		}

		$val = Model_Second_Category::validate('edit');

		if ($val->run())
		{
			$second_category->second_category_name = Input::post('second_category_name');
			$second_category->third_category_id = Input::post('third_category_id');
			$second_category->deleted_at = Input::post('deleted_at');

			if ($second_category->save())
			{
				Session::set_flash('success', 'Updated second_category #' . $id);

				Response::redirect('second/category');
			}

			else
			{
				Session::set_flash('error', 'Could not update second_category #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$second_category->second_category_name = $val->validated('second_category_name');
				$second_category->third_category_id = $val->validated('third_category_id');
				$second_category->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('second_category', $second_category, false);
		}

		$this->template->title = "Second_categories";
		$this->template->content = View::forge('second/category/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('second/category');

		if ($second_category = Model_Second_Category::find($id))
		{
			$second_category->delete();

			Session::set_flash('success', 'Deleted second_category #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete second_category #'.$id);
		}

		Response::redirect('second/category');

	}

}
