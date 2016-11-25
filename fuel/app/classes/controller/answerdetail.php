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

		/*
		 * ユーザID取得
		 */
		$user_infos = Auth::get_user_id();
			
		$this->user_id = $user_infos[1]; // ユーザID取得
		
		echo($this->user_id);
	}

	public function action_history($round_id)
	{
		/*
		 * 問題の実施回を取得
		 * 情報の使い回し
		 * 例：平成28年度春応用情報技術者試験
		 */
		$data['rounds'] = DB::select(
	              'rounds.id'
	            , 'rounds.round_name'
	            , 'examinations.examination_name'
	    )
	    ->from('rounds')
	    ->join('examinations', 'LEFT')
	    ->on('rounds.examination_id', '=', 'examinations.id')
	    ->where('rounds.id', $round_id)
	    ->execute();
		
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
	    ->where('answers.user_id', $this->user_id)
	    ->execute();
		
		/*
		 * 問題詳細がない場合を考慮
		 */
		$data['answerdetails'] = array();
		
		foreach($data['answers'] AS $answer_count => $answer) {
			$data['answerdetails'][$answer_count] 
 				= DB::select(
	            	  'answers.id'
	            	  , 'answers.round_id'
 					  , 'questions.question_number'
	            	  , 'firstcategories.first_category_name'
	            	  , 'firstcategories.secondcategory_id'
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
			
			$data['summary'][$answer_count]['secondcategory'] = array();
			$data['summary'][$answer_count]['all'] = 0;
			foreach($data['answerdetails'][$answer_count] AS $key => $records) {
				/*
				 * 中項目ごとに集計
				 */	
				if(!isset($data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_count']))
				{
					$data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_count'] = 1;
					$data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_name'] = $records['second_category_name'];
					if((int)$records['answer'] === (int)$records['choice_num']) {
						$data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_correct_count'] = 1;
					} else {
						$data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_correct_count'] = 0;
					}
				}
				else
				{
					$data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_count'] 
						= (int)$data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_count'] + 1;
					if((int)$records['answer'] === (int)$records['choice_num']) {
						$data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_correct_count']
						= $data['summary'][$answer_count]['secondcategory'][$records['second_category_name']]['second_category_correct_count'] + 1;
					}
				}

				/*
				 * 全体の集計数を取得
				 */
				if((int)$records['answer'] === (int)$records['choice_num']) {
					$data['summary'][$answer_count]['all'] = $data['summary'][$answer_count]['all'] + 1;
				}
			}
		}
		
		$this->template->title = $data['rounds'][0]['round_name'].$data['rounds'][0]['examination_name'];
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
