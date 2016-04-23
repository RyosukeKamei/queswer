<?php
class Controller_Top_Category extends Controller_Template
{

	public function action_index()
	{
		$data['top_categories'] = Model_Top_Category::find('all');
		$this->template->title = "Top_categories";
		$this->template->content = View::forge('top/category/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('top/category');

		if ( ! $data['top_category'] = Model_Top_Category::find($id))
		{
			Session::set_flash('error', 'Could not find top_category #'.$id);
			Response::redirect('top/category');
		}

		$this->template->title = "Top_category";
		$this->template->content = View::forge('top/category/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Top_Category::validate('create');

			if ($val->run())
			{
				$top_category = Model_Top_Category::forge(array(
					'top_category_name' => Input::post('top_category_name'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($top_category and $top_category->save())
				{
					Session::set_flash('success', 'Added top_category #'.$top_category->id.'.');

					Response::redirect('top/category');
				}

				else
				{
					Session::set_flash('error', 'Could not save top_category.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Top_Categories";
		$this->template->content = View::forge('top/category/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('top/category');

		if ( ! $top_category = Model_Top_Category::find($id))
		{
			Session::set_flash('error', 'Could not find top_category #'.$id);
			Response::redirect('top/category');
		}

		$val = Model_Top_Category::validate('edit');

		if ($val->run())
		{
			$top_category->top_category_name = Input::post('top_category_name');
			$top_category->deleted_at = Input::post('deleted_at');

			if ($top_category->save())
			{
				Session::set_flash('success', 'Updated top_category #' . $id);

				Response::redirect('top/category');
			}

			else
			{
				Session::set_flash('error', 'Could not update top_category #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$top_category->top_category_name = $val->validated('top_category_name');
				$top_category->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('top_category', $top_category, false);
		}

		$this->template->title = "Top_categories";
		$this->template->content = View::forge('top/category/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('top/category');

		if ($top_category = Model_Top_Category::find($id))
		{
			$top_category->delete();

			Session::set_flash('success', 'Deleted top_category #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete top_category #'.$id);
		}

		Response::redirect('top/category');

	}

}
