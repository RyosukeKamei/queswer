<?php
class Controller_Answerdetail extends Controller_Template
{

	public function action_index()
	{
		$data['answerdetails'] = Model_Answerdetail::find('all');
		$this->template->title = "Answerdetails";
		$this->template->content = View::forge('answerdetail/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('answerdetail');

		if ( ! $data['answerdetail'] = Model_Answerdetail::find($id))
		{
			Session::set_flash('error', 'Could not find answerdetail #'.$id);
			Response::redirect('answerdetail');
		}

		$this->template->title = "Answerdetail";
		$this->template->content = View::forge('answerdetail/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Answerdetail::validate('create');

			if ($val->run())
			{
				$answerdetail = Model_Answerdetail::forge(array(
					'question_num' => Input::post('question_num'),
					'answer_id' => Input::post('answer_id'),
					'answer' => Input::post('answer'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($answerdetail and $answerdetail->save())
				{
					Session::set_flash('success', 'Added answerdetail #'.$answerdetail->id.'.');

					Response::redirect('answerdetail');
				}

				else
				{
					Session::set_flash('error', 'Could not save answerdetail.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Answerdetails";
		$this->template->content = View::forge('answerdetail/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('answerdetail');

		if ( ! $answerdetail = Model_Answerdetail::find($id))
		{
			Session::set_flash('error', 'Could not find answerdetail #'.$id);
			Response::redirect('answerdetail');
		}

		$val = Model_Answerdetail::validate('edit');

		if ($val->run())
		{
			$answerdetail->question_num = Input::post('question_num');
			$answerdetail->answer_id = Input::post('answer_id');
			$answerdetail->answer = Input::post('answer');
			$answerdetail->deleted_at = Input::post('deleted_at');

			if ($answerdetail->save())
			{
				Session::set_flash('success', 'Updated answerdetail #' . $id);

				Response::redirect('answerdetail');
			}

			else
			{
				Session::set_flash('error', 'Could not update answerdetail #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$answerdetail->question_num = $val->validated('question_num');
				$answerdetail->answer_id = $val->validated('answer_id');
				$answerdetail->answer = $val->validated('answer');
				$answerdetail->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('answerdetail', $answerdetail, false);
		}

		$this->template->title = "Answerdetails";
		$this->template->content = View::forge('answerdetail/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('answerdetail');

		if ($answerdetail = Model_Answerdetail::find($id))
		{
			$answerdetail->delete();

			Session::set_flash('success', 'Deleted answerdetail #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete answerdetail #'.$id);
		}

		Response::redirect('answerdetail');

	}

}
