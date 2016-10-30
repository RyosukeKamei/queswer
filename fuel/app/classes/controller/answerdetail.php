<?php
class Controller_Answerdetail extends Controller_Template
{
	
	public function before()
	{
		parent::before();
	
		//許可するアクション
// 		$action = array('view');
// 		//アクティブなアクション
// 		$active = Request::active()->action;
	
// 		//ログイン画面にリダイレクト
// 		if (!Auth::check()) {
// 			Response::redirect('admin/login');
// 		}
	
// 		//管理者アクセス不可の場合、管理者一覧画面にリダイレクト ※暫定
// 		if (!in_array($active, $action, true)) {
// 			Response::redirect('admin/index');
// 		}
	}

	public function action_history($round_id)
	{
		/*
		 * ユーザIDはスタブ
		 */
		$user_id = 1;
		
		/*
		 * まずは解答を取得
		 */
		$data['answers'] = DB::select(
	              'answers.id'
	            , 'rounds.round_name'
	            , 'examinations.examination_name'
	            , 'answers.frequency'        /* テスト用 */
	            , 'answers.finish_flag' /* テスト用 */
	    )
	    ->from('answers')
	    ->join('rounds', ' LEFT')
	    ->on('answers.round_id', '=', 'rounds.id')
	    ->join('examinations', 'LEFT')
	    ->on('rounds.examination_id', '=', 'examinations.id')
	    ->where('answers.round_id', $round_id)
	    ->where('answers.user_id', $user_id)
	    ->execute();
		
		foreach($data['answers'] AS $answer_count => $answer) {
			$data['answerdetails'][$answer_count] 
 				= DB::select(
	            	  'answers.id'
	            	  , 'questions.question_number'
	            	  , 'firstcategories.first_category_name'
	            	  , 'secondcategories.second_category_name'
	            	  , 'thirdcategories.third_category_name'
	            	  , 'answerdetails.answer'
	            	  , 'choices.choice_num'
 				)
			    ->from('answerdetails')
	    		->join('answers', ' LEFT')
			    ->on('answerdetails.answer_id', '=', 'answers.id')
	    		->join('questions', ' LEFT')
			    ->on('answers.round_id', '=', 'questions.round_id')
			    ->on('answerdetails.question_number', '=', 'questions.question_number')
	    		->join('choices', ' LEFT')
			    ->on('questions.id', '=', 'choices.question_id')
			    ->on('choices.correct_flag', '=', DB::EXPR(1))
			    ->join('firstcategories', ' LEFT')
			    ->on('questions.firstcategory_id', '=', 'firstcategories.id')
	    		->join('secondcategories', ' LEFT')
			    ->on('firstcategories.secondcategory_id', '=', 'secondcategories.id')
	    		->join('thirdcategories', ' LEFT')
			    ->on('secondcategories.thirdcategory_id', '=', 'thirdcategories.id')
			    ->where('answers.id', $answer['id'])
	    		->execute();
		}
		
		
// var_dump($data['answerdetails']);exit();
		$this->template->title = "解答履歴";
		$this->template->content = View::forge('answerdetail/history', $data);
	
	}
	
	
	/**
	 * action_index
	 * 解答詳細単体で一覧表示することはない
	 */
// 	public function action_index()
// 	{
// 		$data['answerdetails'] = Model_Answerdetail::find('all');
// 		$this->template->title = "Answerdetails";
// 		$this->template->content = View::forge('answerdetail/index', $data);

// 	}	

	/*
	 * 解答詳細単体では見ないので削除
	 */
// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('answerdetail');

// 		if ( ! $data['answerdetail'] = Model_Answerdetail::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find answerdetail #'.$id);
// 			Response::redirect('answerdetail');
// 		}

// 		$this->template->title = "Answerdetail";
// 		$this->template->content = View::forge('answerdetail/view', $data);

// 	}

	/**
	 * action_create
	 * 解答詳細のレコードはヘッダ作成時に一括して作成するので使わない
	 */
// 	public function action_create()
// 	{
// 		if (Input::method() == 'POST')
// 		{
// 			$val = Model_Answerdetail::validate('create');

// 			if ($val->run())
// 			{
// 				$answerdetail = Model_Answerdetail::forge(array(
// 					'question_num' => Input::post('question_num'),
// 					'answer_id' => Input::post('answer_id'),
// 					'answer' => Input::post('answer'),
// 					'deleted_at' => Input::post('deleted_at'),
// 				));

// 				if ($answerdetail and $answerdetail->save())
// 				{
// 					Session::set_flash('success', 'Added answerdetail #'.$answerdetail->id.'.');

// 					Response::redirect('answerdetail');
// 				}

// 				else
// 				{
// 					Session::set_flash('error', 'Could not save answerdetail.');
// 				}
// 			}
// 			else
// 			{
// 				Session::set_flash('error', $val->error());
// 			}
// 		}

// 		$this->template->title = "Answerdetails";
// 		$this->template->content = View::forge('answerdetail/create');

// 	}

	/**
	 * action_edit
	 * 解答詳細を編集することはない
	 * 
	 * @param string $id
	 */
// 	public function action_edit($id = null)
// 	{
// 		is_null($id) and Response::redirect('answerdetail');

// 		if ( ! $answerdetail = Model_Answerdetail::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find answerdetail #'.$id);
// 			Response::redirect('answerdetail');
// 		}

// 		$val = Model_Answerdetail::validate('edit');

// 		if ($val->run())
// 		{
// 			$answerdetail->question_num = Input::post('question_num');
// 			$answerdetail->answer_id = Input::post('answer_id');
// 			$answerdetail->answer = Input::post('answer');
// 			$answerdetail->deleted_at = Input::post('deleted_at');

// 			if ($answerdetail->save())
// 			{
// 				Session::set_flash('success', 'Updated answerdetail #' . $id);

// 				Response::redirect('answerdetail');
// 			}

// 			else
// 			{
// 				Session::set_flash('error', 'Could not update answerdetail #' . $id);
// 			}
// 		}

// 		else
// 		{
// 			if (Input::method() == 'POST')
// 			{
// 				$answerdetail->question_num = $val->validated('question_num');
// 				$answerdetail->answer_id = $val->validated('answer_id');
// 				$answerdetail->answer = $val->validated('answer');
// 				$answerdetail->deleted_at = $val->validated('deleted_at');

// 				Session::set_flash('error', $val->error());
// 			}

// 			$this->template->set_global('answerdetail', $answerdetail, false);
// 		}

// 		$this->template->title = "Answerdetails";
// 		$this->template->content = View::forge('answerdetail/edit');

// 	}

	/**
	 * action_delete
	 * 解答詳細を削除することはない
	 * 
	 * @param string $id
	 */
// 	public function action_delete($id = null)
// 	{
// 		is_null($id) and Response::redirect('answerdetail');

// 		if ($answerdetail = Model_Answerdetail::find($id))
// 		{
// 			$answerdetail->delete();

// 			Session::set_flash('success', 'Deleted answerdetail #'.$id);
// 		}

// 		else
// 		{
// 			Session::set_flash('error', 'Could not delete answerdetail #'.$id);
// 		}

// 		Response::redirect('answerdetail');

// 	}

}
