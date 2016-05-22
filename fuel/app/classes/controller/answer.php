<?php
class Controller_Answer extends Controller_Template
{

	public function action_index()
	{
		$data['answers'] = Model_Answer::find('all');
		$this->template->title = "Answers";
		$this->template->content = View::forge('answer/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('answer');

		if ( ! $data['answer'] = Model_Answer::find($id))
		{
			Session::set_flash('error', 'Could not find answer #'.$id);
			Response::redirect('answer');
		}

		$this->template->title = "Answer";
		$this->template->content = View::forge('answer/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Answer::validate('create');

			if ($val->run())
			{
				$answer = Model_Answer::forge(array(
					'round_id' => Input::post('round_id'),
					'user_id' => Input::post('user_id'),
					'finish_flag' => Input::post('finish_flag'),
					'frequency' => Input::post('frequency'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($answer and $answer->save())
				{
					Session::set_flash('success', 'Added answer #'.$answer->id.'.');

					Response::redirect('answer');
				}

				else
				{
					Session::set_flash('error', 'Could not save answer.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Answers";
		$this->template->content = View::forge('answer/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('answer');

		if ( ! $answer = Model_Answer::find($id))
		{
			Session::set_flash('error', 'Could not find answer #'.$id);
			Response::redirect('answer');
		}

		$val = Model_Answer::validate('edit');

		if ($val->run())
		{
			$answer->round_id = Input::post('round_id');
			$answer->user_id = Input::post('user_id');
			$answer->finish_flag = Input::post('finish_flag');
			$answer->frequency = Input::post('frequency');
			$answer->deleted_at = Input::post('deleted_at');

			if ($answer->save())
			{
				Session::set_flash('success', 'Updated answer #' . $id);

				Response::redirect('answer');
			}

			else
			{
				Session::set_flash('error', 'Could not update answer #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$answer->round_id = $val->validated('round_id');
				$answer->user_id = $val->validated('user_id');
				$answer->finish_flag = $val->validated('finish_flag');
				$answer->frequency = $val->validated('frequency');
				$answer->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('answer', $answer, false);
		}

		$this->template->title = "Answers";
		$this->template->content = View::forge('answer/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('answer');

		if ($answer = Model_Answer::find($id))
		{
			$answer->delete();

			Session::set_flash('success', 'Deleted answer #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete answer #'.$id);
		}

		Response::redirect('answer');

	}

}
