<?php
class Controller_Keyword extends Controller_Template
{

	public function action_index()
	{
		$data['keywords'] = Model_Keyword::find('all');
		$this->template->title = "Keywords";
		$this->template->content = View::forge('keyword/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('keyword');

		if ( ! $data['keyword'] = Model_Keyword::find($id))
		{
			Session::set_flash('error', 'Could not find keyword #'.$id);
			Response::redirect('keyword');
		}

		$this->template->title = "Keyword";
		$this->template->content = View::forge('keyword/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Keyword::validate('create');

			if ($val->run())
			{
				$keyword = Model_Keyword::forge(array(
					'keyword' => Input::post('keyword'),
					'desctiption' => Input::post('desctiption'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($keyword and $keyword->save())
				{
					Session::set_flash('success', 'Added keyword #'.$keyword->id.'.');

					Response::redirect('keyword');
				}

				else
				{
					Session::set_flash('error', 'Could not save keyword.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Keywords";
		$this->template->content = View::forge('keyword/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('keyword');

		if ( ! $keyword = Model_Keyword::find($id))
		{
			Session::set_flash('error', 'Could not find keyword #'.$id);
			Response::redirect('keyword');
		}

		$val = Model_Keyword::validate('edit');

		if ($val->run())
		{
			$keyword->keyword = Input::post('keyword');
			$keyword->desctiption = Input::post('desctiption');
			$keyword->deleted_at = Input::post('deleted_at');

			if ($keyword->save())
			{
				Session::set_flash('success', 'Updated keyword #' . $id);

				Response::redirect('keyword');
			}

			else
			{
				Session::set_flash('error', 'Could not update keyword #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$keyword->keyword = $val->validated('keyword');
				$keyword->desctiption = $val->validated('desctiption');
				$keyword->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('keyword', $keyword, false);
		}

		$this->template->title = "Keywords";
		$this->template->content = View::forge('keyword/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('keyword');

		if ($keyword = Model_Keyword::find($id))
		{
			$keyword->delete();

			Session::set_flash('success', 'Deleted keyword #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete keyword #'.$id);
		}

		Response::redirect('keyword');

	}

}
