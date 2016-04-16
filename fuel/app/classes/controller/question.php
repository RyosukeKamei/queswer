<?php
class Controller_Question extends Controller_Template
{

	public function action_index()
	{
		$data['questions'] = Model_Question::find('all');
		$this->template->title = "Questions";
		$this->template->content = View::forge('question/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('question');

		if ( ! $data['question'] = Model_Question::find($id))
		{
			Session::set_flash('error', 'Could not find question #'.$id);
			Response::redirect('question');
		}

		$this->template->title = "Question";
		$this->template->content = View::forge('question/view', $data);

	}
	
	public function action_convert($id = null)
	{
	    is_null($id) and Response::redirect('question');
	
	    if ( ! $data['before_question'] = Model_Beforequestion::find($id))
	    {
	        Session::set_flash('error', 'Could not find question #'.$id);
	        Response::redirect('question');
	    }
	
 	    $this->template->title = "Question";
 	    $this->template->content = View::forge('question/convert', $data);
	
	}	

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Question::validate('create');

			if ($val->run())
			{
				$question = Model_Question::forge(array(
					'question_number' => Input::post('question_number'),
					'question_body' => Input::post('question_body'),
					'question_commentary' => Input::post('question_commentary'),
					'first_category_id' => Input::post('first_category_id'),
					'divition_id' => Input::post('divition_id'),
					'round_id' => Input::post('round_id'),
					'deleted_at' => Input::post('deleted_at'),
				));

				if ($question and $question->save())
				{
					Session::set_flash('success', 'Added question #'.$question->id.'.');

					Response::redirect('question');
				}

				else
				{
					Session::set_flash('error', 'Could not save question.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Questions";
		$this->template->content = View::forge('question/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('question');

		if ( ! $question = Model_Question::find($id))
		{
			Session::set_flash('error', 'Could not find question #'.$id);
			Response::redirect('question');
		}

		$val = Model_Question::validate('edit');

		if ($val->run())
		{
			$question->question_number = Input::post('question_number');
			$question->question_body = Input::post('question_body');
			$question->question_commentary = Input::post('question_commentary');
			$question->first_category_id = Input::post('first_category_id');
			$question->divition_id = Input::post('divition_id');
			$question->round_id = Input::post('round_id');
			$question->deleted_at = Input::post('deleted_at');

			if ($question->save())
			{
				Session::set_flash('success', 'Updated question #' . $id);

				Response::redirect('question');
			}

			else
			{
				Session::set_flash('error', 'Could not update question #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$question->question_number = $val->validated('question_number');
				$question->question_body = $val->validated('question_body');
				$question->question_commentary = $val->validated('question_commentary');
				$question->first_category_id = $val->validated('first_category_id');
				$question->divition_id = $val->validated('divition_id');
				$question->round_id = $val->validated('round_id');
				$question->deleted_at = $val->validated('deleted_at');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('question', $question, false);
		}

		$this->template->title = "Questions";
		$this->template->content = View::forge('question/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('question');

		if ($question = Model_Question::find($id))
		{
			$question->delete();

			Session::set_flash('success', 'Deleted question #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete question #'.$id);
		}

		Response::redirect('question');

	}

}
