<?php
class Controller_Keyword_Category extends Controller_Template
{

	public function action_index()
	{
		$data['keyword_categories'] = Model_Keyword_Category::find('all');
		$this->template->title = "Keyword_categories";
		$this->template->content = View::forge('keyword/category/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('keyword/category');

		if ( ! $data['keyword_category'] = Model_Keyword_Category::find($id))
		{
			Session::set_flash('error', 'Could not find keyword_category #'.$id);
			Response::redirect('keyword/category');
		}

		$this->template->title = "Keyword_category";
		$this->template->content = View::forge('keyword/category/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Keyword_Category::validate('create');

			if ($val->run())
			{
				$keyword_category = Model_Keyword_Category::forge(array(
					'first_category_id' => Input::post('first_category_id'),
					'keyword_id' => Input::post('keyword_id'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($keyword_category and $keyword_category->save())
				{
					Session::set_flash('success', 'Added keyword_category #'.$keyword_category->id.'.');

					Response::redirect('keyword/category');
				}

				else
				{
					Session::set_flash('error', 'Could not save keyword_category.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Keyword_Categories";
		$this->template->content = View::forge('keyword/category/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('keyword/category');

		if ( ! $keyword_category = Model_Keyword_Category::find($id))
		{
			Session::set_flash('error', 'Could not find keyword_category #'.$id);
			Response::redirect('keyword/category');
		}

		$val = Model_Keyword_Category::validate('edit');

		if ($val->run())
		{
			$keyword_category->first_category_id = Input::post('first_category_id');
			$keyword_category->keyword_id = Input::post('keyword_id');
			$keyword_category->deleted_at = Input::post('deleted_at');

			if ($keyword_category->save())
			{
				Session::set_flash('success', 'Updated keyword_category #' . $id);

				Response::redirect('keyword/category');
			}

			else
			{
				Session::set_flash('error', 'Could not update keyword_category #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$keyword_category->first_category_id = $val->validated('first_category_id');
				$keyword_category->keyword_id = $val->validated('keyword_id');
				$keyword_category->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('keyword_category', $keyword_category, false);
		}

		$this->template->title = "Keyword_categories";
		$this->template->content = View::forge('keyword/category/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('keyword/category');

		if ($keyword_category = Model_Keyword_Category::find($id))
		{
			$keyword_category->delete();

			Session::set_flash('success', 'Deleted keyword_category #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete keyword_category #'.$id);
		}

		Response::redirect('keyword/category');

	}

}
