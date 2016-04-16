<?php
class Controller_Choice extends Controller_Template
{

	public function action_index()
	{
		$data['choices'] = Model_Choice::find('all');
		$this->template->title = "Choices";
		$this->template->content = View::forge('choice/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('choice');

		if ( ! $data['choice'] = Model_Choice::find($id))
		{
			Session::set_flash('error', 'Could not find choice #'.$id);
			Response::redirect('choice');
		}

		$this->template->title = "Choice";
		$this->template->content = View::forge('choice/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Choice::validate('create');

			if ($val->run())
			{
				$choice = Model_Choice::forge(array(
					'question_id' => Input::post('question_id'),
					'choice_num' => Input::post('choice_num'),
					'choice_body' => Input::post('choice_body'),
					'correct_flag' => Input::post('correct_flag'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($choice and $choice->save())
				{
					Session::set_flash('success', 'Added choice #'.$choice->id.'.');

					Response::redirect('choice');
				}

				else
				{
					Session::set_flash('error', 'Could not save choice.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Choices";
		$this->template->content = View::forge('choice/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('choice');

		if ( ! $choice = Model_Choice::find($id))
		{
			Session::set_flash('error', 'Could not find choice #'.$id);
			Response::redirect('choice');
		}

		$val = Model_Choice::validate('edit');

		if ($val->run())
		{
			$choice->question_id = Input::post('question_id');
			$choice->choice_num = Input::post('choice_num');
			$choice->choice_body = Input::post('choice_body');
			$choice->correct_flag = Input::post('correct_flag');
			$choice->deleted_at = Input::post('deleted_at');

			if ($choice->save())
			{
				Session::set_flash('success', 'Updated choice #' . $id);

				Response::redirect('choice');
			}

			else
			{
				Session::set_flash('error', 'Could not update choice #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$choice->question_id = $val->validated('question_id');
				$choice->choice_num = $val->validated('choice_num');
				$choice->choice_body = $val->validated('choice_body');
				$choice->correct_flag = $val->validated('correct_flag');
				$choice->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('choice', $choice, false);
		}

		$this->template->title = "Choices";
		$this->template->content = View::forge('choice/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('choice');

		if ($choice = Model_Choice::find($id))
		{
			$choice->delete();

			Session::set_flash('success', 'Deleted choice #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete choice #'.$id);
		}

		Response::redirect('choice');

	}

}
