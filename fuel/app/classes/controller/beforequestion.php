<?php
/**
 * スキャフォルトで作成しただけ
 * 使わない
 * 
 * @author sr2smail
 *
 */
// class Controller_Beforequestion extends Controller_Template
// {

// 	/**
// 	 * action_index
// 	 * 元のウェブサイトからSQLコンバートした過去問の一覧
// 	 * 
// 	 * 使わない
// 	 */
// 	public function action_index()
// 	{
// 		$data['beforequestions'] = Model_Beforequestion::find('all');
// 		$this->template->title = "Beforequestions";
// 		$this->template->content = View::forge('beforequestion/index', $data);

// 	}

// 	/**
// 	 * action_view
// 	 * 元のウェブサイトからSQLコンバートした過去問の詳細
// 	 * 
// 	 * @param string $id
// 	 */
// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('beforequestion');

// 		if ( ! $data['beforequestion'] = Model_Beforequestion::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find beforequestion #'.$id);
// 			Response::redirect('beforequestion');
// 		}

// 		$this->template->title = "Beforequestion";
// 		$this->template->content = View::forge('beforequestion/view', $data);

// 	}

// 	public function action_create()
// 	{
// 		if (Input::method() == 'POST')
// 		{
// 			$val = Model_Beforequestion::validate('create');

// 			if ($val->run())
// 			{
// 				$beforequestion = Model_Beforequestion::forge(array(
// 					'question_number' => Input::post('question_number'),
// 					'question_body' => Input::post('question_body'),
// 					'question_commentary' => Input::post('question_commentary'),
// 					'first_category_id' => Input::post('first_category_id'),
// 					'divition_id' => Input::post('divition_id'),
// 					'round_id' => Input::post('round_id'),
// 					'prefix_id' => Input::post('prefix_id'),
// 					'deleted_at' => Input::post('deleted_at'),
// 				));

// 				if ($beforequestion and $beforequestion->save())
// 				{
// 					Session::set_flash('success', 'Added beforequestion #'.$beforequestion->id.'.');

// 					Response::redirect('beforequestion');
// 				}

// 				else
// 				{
// 					Session::set_flash('error', 'Could not save beforequestion.');
// 				}
// 			}
// 			else
// 			{
// 				Session::set_flash('error', $val->error());
// 			}
// 		}

// 		$this->template->title = "Beforequestions";
// 		$this->template->content = View::forge('beforequestion/create');

// 	}

// 	public function action_edit($id = null)
// 	{
// 		is_null($id) and Response::redirect('beforequestion');

// 		if ( ! $beforequestion = Model_Beforequestion::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find beforequestion #'.$id);
// 			Response::redirect('beforequestion');
// 		}

// 		$val = Model_Beforequestion::validate('edit');

// 		if ($val->run())
// 		{
// 			$beforequestion->question_number = Input::post('question_number');
// 			$beforequestion->question_body = Input::post('question_body');
// 			$beforequestion->question_commentary = Input::post('question_commentary');
// 			$beforequestion->first_category_id = Input::post('first_category_id');
// 			$beforequestion->divition_id = Input::post('divition_id');
// 			$beforequestion->round_id = Input::post('round_id');
// 			$beforequestion->prefix_id = Input::post('prefix_id');
// 			$beforequestion->deleted_at = Input::post('deleted_at');

// 			if ($beforequestion->save())
// 			{
// 				Session::set_flash('success', 'Updated beforequestion #' . $id);

// 				Response::redirect('beforequestion');
// 			}

// 			else
// 			{
// 				Session::set_flash('error', 'Could not update beforequestion #' . $id);
// 			}
// 		}

// 		else
// 		{
// 			if (Input::method() == 'POST')
// 			{
// 				$beforequestion->question_number = $val->validated('question_number');
// 				$beforequestion->question_body = $val->validated('question_body');
// 				$beforequestion->question_commentary = $val->validated('question_commentary');
// 				$beforequestion->first_category_id = $val->validated('first_category_id');
// 				$beforequestion->divition_id = $val->validated('divition_id');
// 				$beforequestion->round_id = $val->validated('round_id');
// 				$beforequestion->prefix_id = $val->validated('prefix_id');
// 				$beforequestion->deleted_at = $val->validated('deleted_at');

// 				Session::set_flash('error', $val->error());
// 			}

// 			$this->template->set_global('beforequestion', $beforequestion, false);
// 		}

// 		$this->template->title = "Beforequestions";
// 		$this->template->content = View::forge('beforequestion/edit');

// 	}

// 	public function action_delete($id = null)
// 	{
// 		is_null($id) and Response::redirect('beforequestion');

// 		if ($beforequestion = Model_Beforequestion::find($id))
// 		{
// 			$beforequestion->delete();

// 			Session::set_flash('success', 'Deleted beforequestion #'.$id);
// 		}

// 		else
// 		{
// 			Session::set_flash('error', 'Could not delete beforequestion #'.$id);
// 		}

// 		Response::redirect('beforequestion');

// 	}

// }
