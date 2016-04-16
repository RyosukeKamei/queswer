<?php
class Controller_Examination extends Controller_Template
{

	public function action_index()
	{
		$data['examinations'] = Model_Examination::find('all');
		$this->template->title = "Examinations";
		$this->template->content = View::forge('examination/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('examination');

		if ( ! $data['examination'] = Model_Examination::find($id))
		{
			Session::set_flash('error', 'Could not find examination #'.$id);
			Response::redirect('examination');
		}

		$this->template->title = "Examination";
		$this->template->content = View::forge('examination/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Examination::validate('create');

			if ($val->run())
			{
				$examination = Model_Examination::forge(array(
					'examination_name' => Input::post('examination_name'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($examination and $examination->save())
				{
					Session::set_flash('success', 'Added examination #'.$examination->id.'.');

					Response::redirect('examination');
				}

				else
				{
					Session::set_flash('error', 'Could not save examination.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Examinations";
		$this->template->content = View::forge('examination/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('examination');

		if ( ! $examination = Model_Examination::find($id))
		{
			Session::set_flash('error', 'Could not find examination #'.$id);
			Response::redirect('examination');
		}

		$val = Model_Examination::validate('edit');

		if ($val->run())
		{
			$examination->examination_name = Input::post('examination_name');
			$examination->deleted_at = Input::post('deleted_at');

			if ($examination->save())
			{
				Session::set_flash('success', 'Updated examination #' . $id);

				Response::redirect('examination');
			}

			else
			{
				Session::set_flash('error', 'Could not update examination #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$examination->examination_name = $val->validated('examination_name');
				$examination->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('examination', $examination, false);
		}

		$this->template->title = "Examinations";
		$this->template->content = View::forge('examination/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('examination');

		if ($examination = Model_Examination::find($id))
		{
			$examination->delete();

			Session::set_flash('success', 'Deleted examination #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete examination #'.$id);
		}

		Response::redirect('examination');

	}

}
