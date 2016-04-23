<?php
class Controller_Third_Category extends Controller_Template
{

	public function action_index()
	{
		$data['third_categories'] = Model_Third_Category::find('all');
		$this->template->title = "Third_categories";
		$this->template->content = View::forge('third/category/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('third/category');

		if ( ! $data['third_category'] = Model_Third_Category::find($id))
		{
			Session::set_flash('error', 'Could not find third_category #'.$id);
			Response::redirect('third/category');
		}

		$this->template->title = "Third_category";
		$this->template->content = View::forge('third/category/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Third_Category::validate('create');

			if ($val->run())
			{
				$third_category = Model_Third_Category::forge(array(
					'third_category_name' => Input::post('third_category_name'),
					'top_category_id' => Input::post('top_category_id'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($third_category and $third_category->save())
				{
					Session::set_flash('success', 'Added third_category #'.$third_category->id.'.');

					Response::redirect('third/category');
				}

				else
				{
					Session::set_flash('error', 'Could not save third_category.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Third_Categories";
		$this->template->content = View::forge('third/category/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('third/category');

		if ( ! $third_category = Model_Third_Category::find($id))
		{
			Session::set_flash('error', 'Could not find third_category #'.$id);
			Response::redirect('third/category');
		}

		$val = Model_Third_Category::validate('edit');

		if ($val->run())
		{
			$third_category->third_category_name = Input::post('third_category_name');
			$third_category->top_category_id = Input::post('top_category_id');
			$third_category->deleted_at = Input::post('deleted_at');

			if ($third_category->save())
			{
				Session::set_flash('success', 'Updated third_category #' . $id);

				Response::redirect('third/category');
			}

			else
			{
				Session::set_flash('error', 'Could not update third_category #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$third_category->third_category_name = $val->validated('third_category_name');
				$third_category->top_category_id = $val->validated('top_category_id');
				$third_category->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('third_category', $third_category, false);
		}

		$this->template->title = "Third_categories";
		$this->template->content = View::forge('third/category/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('third/category');

		if ($third_category = Model_Third_Category::find($id))
		{
			$third_category->delete();

			Session::set_flash('success', 'Deleted third_category #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete third_category #'.$id);
		}

		Response::redirect('third/category');

	}

}
