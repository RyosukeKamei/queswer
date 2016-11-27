<?php
class Controller_Round extends Controller_Template
{
	/*
	 * ユーザID
	 */
	private $user_id;
	
	public function before()
	{
		parent::before();
	
		/*
		 * 管理者ログインが必要なアクション
		 * なし
		 *
		 * 管理者ログインが不要なアクション（会員用）
		 * list
		 */
		$admin_login_need_action = array();
			
		// 現在アクティブなアクション
		$active = Request::active()->action;
			
		/*
		 * 管理者ログインが必要な画面は認証する
		 */
		if(in_array($active, $admin_login_need_action, true)) {
			if (!(Auth::check() && (int)Auth::get('group') === 100)) {
				Response::redirect('admin/login');
			}
		}
		
		/*
		 * ユーザID取得
		 */
		$user_infos = Auth::get_user_id();
		
		$this->user_id = $user_infos[1]; // ユーザID取得
		

	}
	
	/**
     * action_list
     * 試験一覧表示
     * 
     */
	public function action_list($examnation_id = null)
	{
	    /*
	     * ビューに渡す値
	     */
		$data = array('rounds');

		/*
		 * ユーザIDがある場合
		 * （ログインされている場合）
		 */
		if($this->user_id) 
		{
			$data['user_id'] = $this->user_id;
		}
		else
		{
			$data['user_id'] = null;
		}
		/*
		 * フォームから値がくる場合を考慮
		 * サマリーを切り替えた場合など
		 */
		if(!$examnation_id) {
			$examnation_id = Input::post('examnation_id');
		}
		
		/*
		 * 試験情報を引き継ぐ
		 */
		$data['examnations']['examnation_id'] = $examnation_id;
		
		/*
		 * Ver1.0 examinationでJOINして、試験ごとのリストを取得
		 * 例：応用情報
		 * 平成21年度春応用情報技術者試験
		 * 平成21年度秋応用情報技術者試験
		 * …
		 * 
		 * Ver2.0 後で
		 * 試験を開始 or 試験の続き・試験を終了（履歴を削除）の制御
		 * 
		 * データ取得（SELECT）の場合のテスト方針
		 * 下記のようにFuelPHPの作法に従った場合はテストしない（FuelPHPのメソッドで担保されているから）
		 * 自前でSQLを書かないといけない場合は、テストを書く
		 * 
		 */
	    if($examnation_id) {
	    	
            /*
             * 問題の一覧を取得
             * 
             * 引数
             * 試験区分
             * 平成28年度秋応用情報技術者試験 $examnation_id = 15
             * 平成28年度春応用情報技術者試験 $examnation_id = 14
             * …
             * SQLはモデルに移動
             */
	    	$data['rounds'] = Model_Round::get_rounds_by_examination($examnation_id);
	    	
	        /*
             * Input::post('user_summary_category')が空の場合
             * 初期値としてdivitionsを入れる
             */
	    	$user_summary_category = null;
	    	if(!Input::post('user_summary_category')) 
	    	{
	    		$user_summary_category = 'divitions';
	    	} else {
	    		$user_summary_category = Input::post('user_summary_category');
	    	}
	    	
	    	/*
	    	 * 個人の解答履歴（得意・不得意分野）
	    	 * 初期値は問題種別（divitions）
	    	 * 
	    	 * 第1引数
	    	 * サマリーする単位
	    	 * Input::post('user_summary_category')
	    	 *    'divitions'	     => '問題種別'
			 *    'topcategories'    => 'テクノロジ・マネジメント・ストラテジ'
			 *    'thirdcategories'  => '大項目'
			 *    'secondcategories' => '中項目'
			 *    'firstcategories'  => '小項目'
			 * 
			 * 第2引数
			 * $examnation_id
			 * 応用情報技術者試験 $examnation_id = 3
             * 
             * 第3引数
             * $this->user_id ユーザID
             * 
	    	 * 第4引数
	    	 * $round_id
	    	 * 平成28年度秋応用情報技術者試験 $round_id = 15
	    	 * 平成28年度春応用情報技術者試験 $round_id = 14
             * 
	    	 */
	    	$data['user_summaries'] = Model_Answerdetail::get_summary($user_summary_category, $examnation_id, $this->user_id, Input::post('user_summary_round_id'));
	    	
	    	/*
	    	 * 問題数を取得
	    	 */
	    	$data['user_summary_count'] = Model_Answerdetail::get_summary_question_count($data['user_summaries']);

	    	/*
             * Input::post('user_summary_category')が空の場合
             * 初期値としてdivitionsを入れる
             */
	    	$all_summary_category = null;
	    	if(!Input::post('all_summary_category')) 
	    	{
	    		$all_summary_category = 'divitions';
	    	} else {
	    		$all_summary_category = Input::post('all_summary_category');
	    	}
	    	
	    	/*
	    	 * 全体の解答履歴（得意・不得意分野）
	    	 * 初期値は問題種別（divitions）
	    	 *
	    	 * 第1引数
	    	 * サマリーする単位
	    	 * Input::post('user_summary_category')
	    	 *    'divitions'	     => '問題種別'
	    	 *    'topcategories'    => 'テクノロジ・マネジメント・ストラテジ'
	    	 *    'thirdcategories'  => '大項目'
	    	 *    'secondcategories' => '中項目'
	    	 *    'firstcategories'  => '小項目'
	    	 *
	    	 * 第2引数
	    	 * $examnation_id
	    	 * 応用情報技術者試験 $examnation_id = 3
	    	 *
	    	 * 第3引数
	    	 * ユーザID
	    	 * null ここをnullにすることで全体の集計になる
	    	 * 
	    	 * 第4引数
	    	 * $round_id
	    	 * 平成28年度秋応用情報技術者試験 $round_id = 15
	    	 * 平成28年度春応用情報技術者試験 $round_id = 14
	    	 * 
	    	 */
	    	$data['all_summaries'] = Model_Answerdetail::get_summary($all_summary_category, $examnation_id, null, Input::post('all_summary_round_id'));
	    	/*
	    	 * 問題数を取得
	    	 */
	    	$data['all_summary_count'] = Model_Answerdetail::get_summary_question_count($data['all_summaries']);
	    	
	    	/*
	    	 * サマリー用の実施回(rounds)
	    	 */
	    	$data['rounds_for_summary'] 
	    		= Arr::pluck(Model_Round::find('all'), 'round_name', 'id');
	    	$data['rounds_for_summary'][9999] = 'すべて 選択すると試験で絞り込みをする';
	    	krsort($data['rounds_for_summary']);
	    	
	    }
	    /*
	     * 全体の解答履歴
	     */
	    	  
        $this->template->title = "苦手分野がわかる！問題・解答システム！";
		$this->template->content = View::forge('round/list', $data);
	}
	
	/**
	 * action_pastlist
	 * 過去問一覧表示
	 *
	 */
	public function action_pastlist($examnation_id = null)
	{
		/*
		 * ビューに渡す値
		 */
		$data = array('rounds');
	
		/*
		 * ユーザIDがある場合
		 * （ログインされている場合）
		 */
		if($this->user_id)
		{
			$data['user_id'] = $this->user_id;
		}
		else
		{
			$data['user_id'] = null;
		}
	
		/*
		 * 試験情報を引き継ぐ
		 */
		$data['examnations']['examnation_id'] = $examnation_id;
	
		/*
		 * Ver1.0 examinationでJOINして、試験ごとのリストを取得
		 * 例：応用情報
		 * 平成21年度春応用情報技術者試験
		 * 平成21年度秋応用情報技術者試験
		 * …
		 *
		 * Ver2.0 後で
		 * 試験を開始 or 試験の続き・試験を終了（履歴を削除）の制御
		 *
		 * データ取得（SELECT）の場合のテスト方針
		 * 下記のようにFuelPHPの作法に従った場合はテストしない（FuelPHPのメソッドで担保されているから）
		 * 自前でSQLを書かないといけない場合は、テストを書く
		 *
		 */
		if($examnation_id) {
	
			/*
			 * 過去問の一覧を取得
			 *
			 * 引数
			 * 試験区分
			 * 平成28年度秋応用情報技術者試験 $examnation_id = 15
			 * 平成28年度春応用情報技術者試験 $examnation_id = 14
			 * …
			 * SQLはモデルに移動
			 */
			$data['rounds'] = Model_Round::get_rounds_by_examination($examnation_id);
			foreach($data['rounds'] AS $round) {
				$data['questions'][$round['round_id']] = Model_Question::query()
				->related('round')
				->related('divition')
				->related('firstcategory')
				->related('firstcategory.secondcategory')
				->related('firstcategory.secondcategory.thirdcategory')
				->related('firstcategory.secondcategory.thirdcategory.topcategory')
				->order_by('question_number')
				->where('round.id', $round['round_id'])
				->where('round.examination_id', $examnation_id)
				->get();
			}

		}
		/*
		 * 全体の解答履歴
		 */
	
		$this->template->title = "過去問を解説！";
		$this->template->content = View::forge('round/pastlist', $data);
	}
    
    /*
	 * 以下はscaffoldされた自動生成ファイル
	 * 使わない
	 * action_index
	 * action_view
	 * 登録・更新・削除は後日使うかも
	 * action_create
	 * action_exit
	 * action_delete
	 */
// 	public function action_index()
// 	{
// 		$data['rounds'] = Model_Round::find('all');
// 		$this->template->title = "Rounds";
// 		$this->template->content = View::forge('round/index', $data);

// 	}

// 	public function action_view($id = null)
// 	{
// 		is_null($id) and Response::redirect('round');

// 		if ( ! $data['round'] = Model_Round::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find round #'.$id);
// 			Response::redirect('round');
// 		}

// 		$this->template->title = "Round";
// 		$this->template->content = View::forge('round/view', $data);

// 	}

// 	public function action_create()
// 	{
// 		if (Input::method() == 'POST')
// 		{
// 			$val = Model_Round::validate('create');

// 			if ($val->run())
// 			{
// 				$round = Model_Round::forge(array(
// 					'round_name' => Input::post('round_name'),
// 					'examination_id' => Input::post('examination_id'),
// 					'deleted_at' => Input::post('deleted_at'),
// 				));

// 				if ($round and $round->save())
// 				{
// 					Session::set_flash('success', 'Added round #'.$round->id.'.');

// 					Response::redirect('round');
// 				}

// 				else
// 				{
// 					Session::set_flash('error', 'Could not save round.');
// 				}
// 			}
// 			else
// 			{
// 				Session::set_flash('error', $val->error());
// 			}
// 		}

// 		$this->template->title = "Rounds";
// 		$this->template->content = View::forge('round/create');

// 	}

// 	public function action_edit($id = null)
// 	{
// 		is_null($id) and Response::redirect('round');

// 		if ( ! $round = Model_Round::find($id))
// 		{
// 			Session::set_flash('error', 'Could not find round #'.$id);
// 			Response::redirect('round');
// 		}

// 		$val = Model_Round::validate('edit');

// 		if ($val->run())
// 		{
// 			$round->round_name = Input::post('round_name');
// 			$round->examination_id = Input::post('examination_id');
// 			$round->deleted_at = Input::post('deleted_at');

// 			if ($round->save())
// 			{
// 				Session::set_flash('success', 'Updated round #' . $id);

// 				Response::redirect('round');
// 			}

// 			else
// 			{
// 				Session::set_flash('error', 'Could not update round #' . $id);
// 			}
// 		}

// 		else
// 		{
// 			if (Input::method() == 'POST')
// 			{
// 				$round->round_name = $val->validated('round_name');
// 				$round->examination_id = $val->validated('examination_id');
// 				$round->deleted_at = $val->validated('deleted_at');

// 				Session::set_flash('error', $val->error());
// 			}

// 			$this->template->set_global('round', $round, false);
// 		}

// 		$this->template->title = "Rounds";
// 		$this->template->content = View::forge('round/edit');

// 	}

// 	public function action_delete($id = null)
// 	{
// 		is_null($id) and Response::redirect('round');

// 		if ($round = Model_Round::find($id))
// 		{
// 			$round->delete();

// 			Session::set_flash('success', 'Deleted round #'.$id);
// 		}

// 		else
// 		{
// 			Session::set_flash('error', 'Could not delete round #'.$id);
// 		}

// 		Response::redirect('round');

// 	}

}
