<?php
class Controller_Question extends Controller_Template
{
	public function before()
	{
		parent::before();
		$is_admin = Session::get('is_admin');
	
		//ログイン画面にリダイレクト
		if (!$is_admin) {
			Response::redirect('admin/login');
		}
	}
	
    /**
     * action_index
     * 問題一覧
     * 
     * 管理側で使う
     */
    public function action_index()
    {
    	$data['questions'] = 
            Model_Question::query()
            ->related('round')
            ->related('divition')
            ->related('firstcategory')
            ->get();
        $this->template->title = "問題一覧";
        $this->template->content = View::forge('question/index', $data);

    }

    /**
     * action_view
     * 問題詳細
     * 
     * 不要
     * 
     * @param int $id 問題ID
     */
//     public function action_view($id = null)
//     {
//         is_null($id) and Response::redirect('question');

//         if ( ! $data['question'] = Model_Question::find($id))
//         {
//             Session::set_flash('error', 'Could not find question #'.$id);
//             Response::redirect('question');
//         }

//         $this->template->title = "Question";
//         $this->template->content = View::forge('question/view', $data);

//     }

    /**
     * action_create
     * 問題生成
     * 選択肢も同時に登録
     */
    public function action_create()
    {
    	if (Input::method() == 'POST')
        {
            $val = Model_Question::validate('create');

            if ($val->run())
            {
                /*
                 * POSTを変換
                 * テストするため
                 */
            	$posts = Input::post();
                if ($posts && $this->create_question($posts))
                {
                	Session::set_flash('問題の登録に成功しました。');

                    Response::redirect('question/create');
                }

                else
                {
                    Session::set_flash('error', '問題の登録に失敗しました。');
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "問題登録";
        $this->template->content = View::forge('question/create');

    }

    /**
     * action_edit
     * 問題編集
     * 選択肢（choice）も同時に更新
     * 
     * @param int $id 問題ID
     */
    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('question');

        /*
         * $question = Model_Question::find($id)
         * これをすることで、saveメソッドで自動的にupdateする
         */
        //-- 問題文
        if ( ! $question = Model_Question::find($id))
        {
            {
	        	Session::set_flash('error', '問題が見つかりません。 #'.$id);
    	        Response::redirect('question');
            }
        }
        //-- 選択肢
        if( ! $choices =
        		Model_Choice::find('all'
        				, array(
        						'where' => array(
        								array('question_id', $id),
        						)
        				)
        		)
        )
        {
        	Session::set_flash('error', '選択肢が見つかりません。 #'.$id);
        	Response::redirect('question');
        }        
        
        /*
         * edit_questionでバリデーションエラーの場合
         * エラーコードを取得
         */
        if($this->edit_question($id, $question, Input::post())) {
        	/*
        	 * 選択肢登録で成功しても失敗しても元の画面にリダイレクト
        	 */
        	if($this->edit_choices($id, $choices, Input::post())) {
        		Session::set_flash('問題の登録に成功しました。');
        	}
        	Response::redirect('question/edit/'.$id);
        }
        else
        {
            if (Input::method() == 'POST')
            {
                $question->question_number     = $val->validated('question_number');
                $question->question_body       = $val->validated('question_body');
                $question->question_commentary = $val->validated('question_commentary');
                $question->firstcategory_id    = $val->validated('firstcategory_id');
                $question->divition_id         = $val->validated('divition_id');
                $question->round_id            = $val->validated('round_id');

                Session::set_flash('error', $val->error());
            }

            /*
             * 選択肢を整形
             */
            $choice_array = array();
            $choice_num = 1;
            foreach($choices AS $item) {
            	$choice_array[$choice_num] = $item->choice_body;
            	/*
            	 * 正解のデフォルト
            	 */
            	if((int)$item->correct_flag === 1) {
            		$choice_array['correct_flag'] = $choice_num;
            	}
            	$choice_num++;
            }
            
            $this->template->set_global('question', $question, false);
            $this->template->set_global('choices',   $choice_array,   false);
        }

        $this->template->title = "問題更新";
        $this->template->content = View::forge('question/edit');

    }

    /**
     * action_delete
     * 問題削除
     * 
     * @todo
     * 論理削除に変更
     * 
     * @param int $id 問題ID
     */
    public function action_delete($id = null)
    {
        is_null($id) and Response::redirect('question');

        if ($question = Model_Question::find($id))
        {

//             $question->delete();
			// カスケードした外部参照ごと削除するにはこちら
        	DB::delete('questions')->where('id', $id)->execute();

            Session::set_flash('success', '削除しました。 #'.$id);
        }

        else
        {
            Session::set_flash('error', '削除できませんでした。 #'.$id);
        }

        Response::redirect('question');

    }
    
    /**
     * action_commentary
     * 問題の解説を表示
     * 
     * @param string $question_number
     * @param string $round_id
     */
    public function action_commentary($question_number = null, $round_id = null)
    {
        /*
         * $question_numberがない場合、問題一覧にリダイレクト
         * 
         * @todo
         * リダイレクト先は後から考える
         * 候補 round/index/3？
         */
        is_null($question_number) and Response::redirect('question');
        
        /*
         * 問題文を取得
         * 失敗するとFATAL ERRORでリダイレクト
         */
        $data['questions'] = $this->get_questions($round_id, $question_number);
        
        /*
         * 選択肢を取得
         * 失敗するとFATAL ERRORでリダイレクト
         */
        $data['choices'] = $this->get_choices($data['questions']->id);  
        
        /*
         * この問題に出てくるキーワード 下記SQLの結果
         * 問題文（question_keywords）と選択肢（choeice_keywords）
         * 
         */
        $data['question_keywords'] = Model_Question::get_question_keywords(
                  $round_id         /* = 14 */
                , $question_number  /* = 1  */
        );
        	
        $data['choice_keywords'] = Model_Choice::get_choice_keywords(
                  $round_id         /* = 14 */
                , $question_number  /* = 1  */
        );
        
        /*
         * 小項目の問題リンクのためデータを取得
         * データ取得メソッドはモデルにstaticで記載
         * 引数は
         */
        //-- 今回利用する引数はfirstquestion_idのみ
        $question_wheres['firstcategory_id'] = $data['questions']->firstcategory_id;
        $data['firstcategories'] = Model_Question::get_questions(
                                          $question_wheres
                                        , 0 /*get 複数行*/
        );
        $question_wheres = null;

        /*
         * 中項目のキーワードリンクのためデータを取得
         * first_category_idで取得できる
         * データがない場合は何も表示しない
         */
        $keywordcategory_where['secondcategory_id'] = $data['questions']->firstcategory->secondcategory_id;
        $data['keywordcategories'] = Model_Keywordcategory::get_keywordcategories(
                                          $keywordcategory_where
                                        , 0 /*get 複数行*/
        );
        $keywordcategory_where = null;
                
        /*
         * タイトルは加工
         */
        $this->template->title = 
                  $data['questions']->round->round_name
            .' ' .$data['questions']->round->examination->examination_name
            .' 過去問'.$data['questions']->question_number
            
        ;
        $this->template->content = View::forge('question/commentary', $data, false);
        
    }
    
    /**
     * action_solve
     * 解答し、次の問題を取得
     * 
     * パターン1 初めて問題に取り組む場合
     * 入力 $round_id = 15 $mode = 'init'
     * answers（1レコード）とanswerdetails（80レコード）を生成
     * １問目を取得（answer_idから、answerカラムがnullで、一番若いレコードを取得）
     * 
     * パターン2 一覧画面から「続き」をクリックした場合
     * 入力 $round_id = 15 $mode = 'continue'
     * answer_idから、answerカラムがnullで、一番若いレコードを取得
     * 
     * パターン3 問題画面で解答した場合
     * 入力 $round_id = 0 $mode = null POSTで値を取得
     * answer_idから、answerカラムがnullで、一番若いレコードにanswerの値を入れる
     * answer_idから、answerカラムがnullで、一番若いレコードを取得
     * 
     * @param int $round_id 実施回 平成28年度春応用情報技術者試験の場合は15
     * @param int $answer_id 一覧画面から「続き」をクリックした場合値が入る
     */
    public function action_solve($round_id = 0, $answer_id = 0) {
        /*
         * 新規の場合：answer_idなし
         * 続きの場合：answer_idあり
         * 解答の場合」answer_idをPOSTから取得
         */
    	if(Input::post('answer_id')) {
	    	/*
	    	 * 解答の場合
	    	 */
    		$answer_id = Input::post('answer_id');
    	} elseif((int)$answer_id === 0) {
	    	/*
    		 * 新規の場合
    		 * 初期化（80レコード作成）をしてanswer_idを取得
	    	 * 2. 続きをする場合
    		 * ブラウザ入力された$answer_idそのまま
    		 */
    		$answer_id = $this->answer_init($round_id);
    	} elseif($answer_id) {
    		/*
    		 * 続きの場合
    		 * 何もしない
    		 */
    	}

        /*
         * 答えが入力された場合は解答する
         */
        if(Input::post('answer_id') && Input::post('question_number') && Input::post('answer')) {
            /*
             * answerdetailsのanswerにデータが入る
             */
            if(! Model_Answerdetail::answered(Input::post('answer_id'), Input::post('question_number'), Input::post('answer')))
            {
            	/*
            	 * ほとんどありえないエラー（SQLエラー）
            	 */
            	Session::set_flash(
            			  'error'
            			, 'FATAL 解答の更新に失敗しました。 '.Input::post('answer_id'));
            	 
            	/*
            	 * @todo
            	 * リダイレクト先は後から考える
            	 * 候補 round/index/3？
            	*/
            	Response::redirect('question');
            }
        }
        
        /*
         * 共通
         * 次の問題を取得
         * answer_idからanswerdetailsを見て、answerにデータがなく一番若いレコードを取得
         * question_numberを取得
         */
        $answers = Model_Answerdetail::find('first', array (
							'where' => array (
									array('answer_id', "=", $answer_id),
									array('answer', "IS", NULL),
							),
        					'order_by' => array('question_number' => 'asc'),
						));
        
        /*
         * $answersがない場合は全問終了
         */
        if($answers) {
			/*
			 * 続きがある場合は問題文を取得
			 */
			
			/*
			 * answer_idは使いまわすのでここでビューに渡す
			 */
        	$data['answer_id'] = $answer_id;
        
			/*
			 * 問題文を取得
			 */
			$data['questions'] = $this->get_questions($round_id, $answers->question_number);

			/*
			 * 選択肢を取得
			 */
			$data['choices'] = $this->get_choices($data['questions']->id); 
        } else {
        	/*
        	 * answersにfinish_flagを立てる
        	 */
        	if(! Model_Answer::answer_finished($answer_id))
        	{
        		/*
        		 * ほとんどありえないエラー（SQLエラー）
        		 */
        		Session::set_flash(
        		'error'
        				, 'FATAL 解答の終了に失敗しました。 '.Input::post('answer_id'));
        	
        		/*
        		 * @todo
        		 * リダイレクト先は後から考える
        		 * 候補 round/index/3？
        		 */
        		Response::redirect('question');
        	} else {
				/*
				 * 80問終了の場合はリダイレクト
				 * 問題一覧にリダイレクト
				 */
				Session::set_flash(
					  'success'
					, 'お疲れ様です。80問すべて解答しました。');
				Response::redirect('answerdetail/list/'.$answer_id);
			}
        }

        /*
         * タイトルは加工
         */
        $this->template->title =
        $data['questions']->round->round_name
        .' ' .$data['questions']->round->examination->examination_name
        .' 過去問'.$data['questions']->question_number;
        $this->template->content = View::forge('question/solve', $data, false);
        
    }
    
    /**
     * データを取得
     *
     * @param int $round_id
     * @param int $question_number
     * @return array $questions 問題文のレコード
     */
    private function get_questions($round_id, $question_number) {
    	//-- WHEREを整理
    	$question_wheres['question_number'] = $question_number;
    	$question_wheres['round_id']        = $round_id;
    	//-- データ取得
    	$questions = Model_Question::get_questions($question_wheres, 1);
    	//-- 変数スコープを明示
    	$question_wheres = null;
    	
    	if ( ! $questions )
    	{
    		/*
    		 * ほとんどありえないエラー（SQLエラー）
    		 */
    		Session::set_flash(
    		'error'
    				, '問題取得（questionsテーブル）に失敗しました。 問題番号 '.$question_number);
    	
    		/*
    		 * @todo
    		 * リダイレクト先は後から考える
    		 * 候補 round/index/3？
    		*/
    		Response::redirect('question');
    	}
    	
    	return $questions;
    }
    
    /**
     * get_choices
     * 
     * 
     * @param int $questions_id
     * @return array choices 選択肢配列
     */
    private function get_choices($questions_id) {
    	/*
    	 * 問題取得成功
    	 *
    	 * 選択肢を取得
    	 * 引数が一つだけなら、find_byを使う
    	 *
    	 * ●命名規則「3ヶ月後の自分自身に優しく、チームに優しく、まだ見ぬメンバーに優しく」
    	 * 5. フレームワークの作法に従い、ライブラリを活用することで、コーディング負荷は軽減される
    	 */
    	if ( ! $choices = Model_Choice::find_by('question_id', $questions_id))
    	{
    		/*
    		 * ほとんどありえないエラー（SQLエラー）
    		 */
    		Session::set_flash(
    		'error'
    				, '選択肢取得（choicesテーブル）に失敗しました');
    	
    		/*
    		 * @todo
    		 * リダイレクト先は後から考える
    		 * 候補 round/index/3？
    		*/
    		Response::redirect('question');
    	}
    	
    	return $choices;
    }
    
    /**
     * answer_init
     * 答えが存在しなければ、「新規」なので
     * answer（1レコード）とanswerdetail（80レコード）を生成
     * 最後にanswer_idを返す
     * 
     * @param int $round_id 問題の回数（平成28年度春応用情報技術者試験は15）
     * @return int $answer_id 次の問題ID
     */
    private function answer_init($round_id) {
        /*
         * @ToDo
         * Oauth実装後にユーザIDを取得するロジックに変更
         */
    	$user_id = 1; // スタブ
        
        /*
         * $pdoを取得
         * トランザクションとQuesitonをINSERTした後のidを取得
         */
        Database_Connection::instance()->connect();
        $pdo = Database_Connection::instance()->connection();
        $pdo->beginTransaction();
        
        /*
         * $round_idから、前回のfrequencyを取得
         * 「前回の」なので + 1して「今回」にする
         */
        $frequency_result = Model_Answer::get_answers ( $round_id, /* = 14 */ $user_id /* = 1 */ );
        $frequency = count($frequency_result) + 1; // 今回の実施回frequency

        $answer_id = Model_Answer::create_answer($round_id, $user_id, $frequency);
        
        if (0 < $answer_id) {
            /*
             * create_answer_details メソッド
             * answerdetail（80レコード）を生成
             */
            if (! Model_Answerdetail::create_answer_details ( $answer_id )) {
                /*
                 * レコードができなかったらFatal Error
                 * 本来ユニットテストで対応するからありえないはず
                 *
                 */
                Session::set_flash ( 'error', 'FATAL ERROR 解答詳細(answerdetails)レコード生成ができませんでした。 ' );
            } else {
                /*
                 * 解答ヘッダ（answers）と解答詳細（answerdetails）が生成されたら成功なので
                 * answer_idを返す
                 */
                $pdo->commit();
                return $answer_id;
            }
        } else {
            /*
             * レコードができなかったらFatal Error
             * 本来ユニットテストで対応するからありえないはず
             */
            Session::set_flash ( 'error', 'FATAL ERROR answersレコード生成ができませんでした。 ' );
        }
        /*
         * 正しければ、コミットされてreturnされる
         * ここまできたらエラーってこと
         * ロールバックしてリダイレクト
         */
        $pdo->rollback();
        Response::redirect ( 'question' );
    }
    
    /**
     * get_next_question
     * 次の問題を取得
     * answer_idとanswerがnullで一番若いレコードが次の問題
     * 
     * @param int $answer_id 
     * @return array $next_questions 次の問題文や選択肢が格納された配列
     */
    public function get_next_question($answer_id) {
        $next_questions = array();
        
        /*
         * SELECT生成
         */
        $next_questions = find('first', array (
							'where' => array (
									array('answer', "IS", NULL),
							),
        					'order_by' => array('question_number' => 'asc'),
						));
        
        /*
         * SELECT実行
         */
        
        return $next_questions;
    }
    
    
    /**
     * action_convert
     * beforequestionからquestionに整形する
     * 
     * create_question
     * POSTに値がある場合はquestionとchoiceのINSERTを生成
     * 
     * データベースの値をそのままにしておくもの
     * beforequestion.question_number   → question.question_number
     * beforequestion.first_category_id → question.first_category_id
     * beforequestion.divition_id       → question.divition_id
     * beforequestion.round_id          → question.round_id
     * beforequestion.prefix_id         → question.prefix_id
     * 
     * コンバートするもの
     * beforequestion.question
     * 問題と選択肢を分ける
     * question.question_body
     * 選択肢を抜いたものを表示（目視）
     * 選択肢はア〜エに分解して、choiceテーブルに4レコード作成（目視）
     * 
     * beforequestion.question_commentary
     * 正解を抽出
     * 
     * 1. get_before_question($beforequestion_id)
     *   beforequestionから値を取得 
     *     コンバートする各値があればOK
     *     
     * 2. removed_tag_and_contents($question_body)
     *   beforequestion.question_bodyから選択肢を除去
     *     beforequestion.question_bodyとquestion.question_bodyを比較して異なればOK（苦しい？）
     *     
     * 3. convert_choice($question_body)
     *   beforequestion.question_bodyから選択肢を生成
     *     4つの選択肢に値があればOK
     *     各先頭の<li>と末尾の</li>が抜けていればOK
     * 
     * 4. covert_correct($question_commentary)
     *   beforequestion.question_commentaryから解答を生成
     *     1〜4であればOK
     *     
     * 5. insert_question($questions[])
     *   全てのinsertが正しく実行されていればOK
     * 
     */
    public function action_convert($beforequestion_id = 0)
    {        
        /*
         * Viewに渡すデータ
         */
        $data = array();

        /*
         * 
         */
        
        /*
         * POSTに値がある場合はコンバート実行
         * POSTに問題がない場合は、コンバートした問題文と選択肢を取得する
         */
        if (Input::method() == 'POST')
        {
            /*
             * QuestionとChoiceのINSERTを実行
             */
            if($this->create_question(Input::post())) {
				/*
				 * INSERTが成功したら
				 * 次の$beforequestion_idにリダイレクト
				 */
				$to_redirect = '/question/convert/'.++$beforequestion_id;
				Response::redirect($to_redirect);
            }
        }

        /*
         * コンバートした問題文と選択肢を取得
         */
        /*
         * beforequestionから
         * $beforequestion_idの値を取得
         *
         */
        $before_questions = $this->get_before_question($beforequestion_id);

        /*
         * Viewに渡すデータを生成
         */
        $data['before_questions'] = $before_questions; // beforequesitonそのまま
        
        /*
         * 問題文(question_body)から選択肢を除去
         * <ul>(.*)</ul>
         * 続いて、見出しを除去
         * <h3>(.*)</h3>
         */
        $data['questions']['conveted_question_body'] = 
        		$this->removed_tag_and_contents(
        			$this->removed_tag_and_contents(
        	    		strip_tags($before_questions->question_body, '<p><img><sup><sub><span><ul><h3>')
        			    , 'ul'
        			)
        			, 'h3'
        		);
        $data['questions']['conveted_question_body'] = str_replace('http://korejoap.info/image', '/assets/img', $data['questions']['conveted_question_body']);
        $data['questions']['conveted_question_body'] = str_replace('/question/', '/', $data['questions']['conveted_question_body']);
        $data['questions']['conveted_question_body'] = str_replace('alt=', 'class="img-responsive" alt=', $data['questions']['conveted_question_body']);
        $data['questions']['conveted_question_body'] = str_replace('<p></p>', '', $data['questions']['conveted_question_body']);
        
        /*
         * 解説から不要な文言を除去
         */
        $data['questions']['conveted_question_commentary'] =
			$this->removed_tag_and_contents(
				  strip_tags($before_questions->question_commentary, '<p><img><sup><sub><span><ul><h3><iframe>')
        		, 'h3'
        );
        

        /*
         * 問題文(question_body)から選択肢を生成
         */
        $data['choices'] = $this->convert_choice($before_questions->question_body);
        
        /*
         * 問題の解説(question_commentary)から正解を取得
         * ア : 1
         * イ : 2
         * ウ : 3
         * エ : 4
         */
        $data['correct_flag'] = $this->covert_correct($before_questions->question_commentary);
        
        $this->template->title = "問題コンバート";
        $this->template->content = View::forge('question/convert', $data);
    
    }
    
    /**
     * create_question
     * INSERT文作成部分を切り出し
     * 可読性向上のための完全にprivateなのでテスト不要？
     * 
     * @param $posts POSTの配列
     * @param $testmode true/false
     * @return $question_last_id 問題ID（テストで削除するため）
     */
    public static function create_question($posts, $testmode = false) {
        /*
         * 成功する場合はquestion_idを返す
         */
    	$question_last_id = 0;
  	
        /*
         * $pdoを取得
         * トランザクションとQuesitonをINSERTした後のidを取得
         */
        Database_Connection::instance()->connect();
        $pdo = Database_Connection::instance()->connection();
        $pdo->beginTransaction();        
        /*
         * Questionのバリデーション
         */
        $question_validation = Model_Question::validate('question');
        if ($testmode || $question_validation->run())
        {
			/*
			 * ユニットテスト（$testmode = true）はバリデーションを無視
			 * 
			 */
            /*
             * 問題を追加するINSERT（もしくはUPDATE）を生成
             */
        	$question_body = null;
        	if(isset($posts['conveted_question_body'])) {
        		$question_body = $posts['conveted_question_body'];
        	} elseif(isset($posts['question_body'])) {
        		$question_body = $posts['question_body'];
        	}
        	if(isset($posts['conveted_question_commentary'])) {
        		$question_commentary = $posts['conveted_question_commentary'];
        	} elseif(isset($posts['question_commentary'])) {
        		$question_commentary = $posts['question_commentary'];
        	}
            $question = Model_Question::forge(array(
                    'question_number'     => $posts['question_number'],					// 問題番号
                    'question_body'       => $question_body,							// 問題本文
                    'question_commentary' => $question_commentary,						// 問題解説
                    'firstcategory_id'    => $posts['firstcategory_id'],				// 小項目（固定）
                    'divition_id'         => $posts['divition_id'],						// 問題区分（固定）
                    'round_id'            => $posts['round_id'],						// 問題実施（固定）
                    'prefix_id'           => 1,						// 固定
            ));

            if ($question and $question->save())
            {

                /*
                 * questionをINSERTした時のIDを取得
                 * choiceとの関連付け
                 */
                $question_last_id = $pdo->lastInsertId('id');
                
                /*
                 * 選択肢(choice)を作成
                 * 第1引数 問題のID
                 * 第2引数 POSTの値
                 * 第3引数 テストモードの場合はtrue
                 */
                $success = Controller_Question::create_choices($question_last_id, $posts, $testmode);
                
                /*
                 * エラーがない場合は成功メッセージをセットして、次の問題のコンバートに移動
                 */
                if($success) {
                    Session::set_flash('success', '問題を追加しました！');
                    $pdo->commit();
                    return $question_last_id;

                }
            } else
            {
                Session::set_flash('error', '問題を追加できませんでした。');
            }
        } else
        {
            Session::set_flash('error', $question_validation->error());
        }
        /*
         * エラーがある場合、ここを通過するのでロールバック
         */
        $pdo->rollBack();
        return $question_last_id;
    }
    
    /**
     * create_choices
     * 選択肢（4つ）を生成
     * 
     * @param int $question_last_id question.id
     * @param array $posts 
     * @param boolean $testmode
     * @return boolean
     */
    public static function create_choices($question_last_id, $posts, $testmode = false) {
        /*
         * IPA系の試験は選択肢は4つある
         */
        for($choice_num = 1; $choice_num <= 4; $choice_num++)
        {
            /*
             * 正解フラグは選択肢が4つあるうち一つだけ
             * 正解の番号が入力される
             * それとプログラム内部の選択肢番号が一致すればそれが正解
             */
            $correct_flag = 0;
            /*
             * ●コーディング規則「優しいコードを書こう」
             * 5. 条件式　左側は調査対象（変化する）右側は比較対象（変化しない）
             */
            if($choice_num === (int)$posts['correct_flag'])
            {
                $correct_flag = 1;
            }
         
            /*
             * Choiceのバリデーション
             */
            $choice_validation = Model_Choice::validate('convert', $choice_num);
            if ($testmode || $choice_validation->run())
            {
                /*
                 * ユニットテストの場合はバリデーションを通さない
                 */
                /*
                 * 問題を追加するINSERT（もしくはUPDATE）を生成
                 */
                $choice = Model_Choice::forge(array(
                    /*
                     * ●命名規則「3ヶ月後の自分自身に優しく、チームに優しく、まだ見ぬメンバーに優しく」
                     * 4. 省略は誰でもわかる単語だけ（cntなど）、
                     * よくわからない省略は使わない（BEManagerってなに？BackEndManager）
                     */
                	'question_id'  => $question_last_id,					// 問題番号（固定）
                    'choice_num'   => $choice_num,							// 選択肢番号
                    'correct_flag' => $correct_flag,						// 正解
                    'choice_body'  => $posts['choice_body_'.$choice_num],	// 選択肢
                ));
        
                if (!($choice and $choice->save()))
                {
                    Session::set_flash('error', '選択肢を追加できませんでした。');
                    /*
                     * ●コーディング規則「優しいコードを書こう」
                     * 8. 早めにreturnし、関数から抜ける
                     */
                    return false;
                }
            } else
            {
                Session::set_flash('error', $choice_validation->error());
                /*
                 * ●コーディング規則「優しいコードを書こう」
                 * 8. 早めにreturnし、関数から抜ける
                 */
                return false;
            }
        }
        return true;    
    }
    
    public static function edit_question($question_id, $question, $posts, $testmode = false) {
    	/*
    	 * 登録が成功するとtrueを返す
    	 * 登録が失敗するとリダイレクトする
    	 * バリデーションチェックに引っかかったらfalseを返す
    	 */
    	$val = Model_Question::validate('edit');
    	
    	if ($testmode || $val->run())
    	{
    		$question->question_number     = $posts['question_number'];
    		$question->question_body       = $posts['question_body'];
    		$question->question_commentary = $posts['question_commentary'];
    		$question->firstcategory_id    = $posts['firstcategory_id'];
    		$question->divition_id         = $posts['divition_id'];
    		$question->round_id            = $posts['round_id'];
    	
    		if ($question->save())
    		{
				return true;
    		}
    		else
    		{
    			Session::set_flash('error', '問題を更新できませんでした。 #' . $question_id);
    			Response::redirect('question/edit/'.$question_id);
    		}
    	}
    	return false;
    }
    
    public static function edit_choices($question_id, $choices, $posts) {
    	$choice_count = 1;
    	foreach($choices AS $item) {
    		/*
    		 * 選択肢があるか
    		 */
    		if ( ! $choice = Model_Choice::find($item->id))
    		{
    			Session::set_flash('error', '選択肢が見つかりません。 #'.$item->id);
    			return false;
    		}
    		else
    		{
    			$choice->choice_body     = $posts['choice_body_'.$choice_count];
    			/*
    			 * 正解
    			*/
    			if((int)$posts['correct_flag'] === $choice_count) {
    				/*
    				 * 正解の選択肢の場合は1
    				 */
    				$choice->correct_flag = 1;
    			} else {
    				/*
    				 * 不正解な場合は0
    				 */
    				$choice->correct_flag = 0;
    			}
    			if(!$choice->save())
    			{
    				Session::set_flash('error', '選択肢を更新できませんでした。 #' . $question_id);
    				return false;
    			}
    		}
    		$choice_count++;
    	}
    	return true;  	
    }
    
    /**
     * コンバート前のデータを取得
     * @param int $beforequestion_id コンバート前の$beforequestion_id
     * @return array 該当IDのbefore_questionを格納したテーブル
     */
    public static function get_before_question($beforequestion_id) {
         
    	return Model_Beforequestion::find($beforequestion_id);
    }
    
    /**
     * タグとタグの中身を除去
     * removed_tag_and_contents
     * 
     * ●コーディング規則「優しいコードを書こう」
     * 4. コメントは「意図を相手に伝えること」なので、簡潔に例となる値やToDo、欠陥を書く
     * 
     * 検証済み（下記以外のタグを使う場合はテストを追加すること）
     * <ul>(.*)</ul>
     * <h3>(.*)</h3>
     * 
     * ●コーディング規則「優しいコードを書こう」
     * 2. 1関数1機能にすると、コードが短く簡潔になり、テストがしやすくなる
     * 
     * @param string $body タグを除去するHTML
     * @return string タグを除去したHTML
     */
    public static function removed_tag_and_contents($body, $tag_name) {
        return 
        	preg_replace(
        			  '{<'.$tag_name.'>(.*)</'.$tag_name.'>}'
        			, ''
        			, $body
        	);
    }

    public static function removed_tag_header($body, $tag_name) {
    	return
    	preg_replace(
    			'{<'.$tag_name.'(.*)'.'>}'
    			, ''
    			, $body
    	);
    }
    
    /**
     * convert_choice
     * beforequestion.question_bodyから、選択肢を生成
     * 例：IPA系の場合は4つ
     * 
     * @param string $question_body
     * @return array $choices
     */
    public static function convert_choice($question_body) {
        /*
         * IPA系の場合、選択肢は4つあるので配列で返す
         */
        $choices = array();
        
        /*
         * 選択肢を生成
         * <ul>
         *   <li>ア：{選択肢ア}</li>
         *   <li>イ：{選択肢イ}</li>
         *   <li>ウ：{選択肢ウ}</li>
         *   <li>エ：{選択肢エ}</li>
         * </ul>
         * から
         * {選択肢ア}
         * {選択肢イ}
         * {選択肢ウ}
         * {選択肢エ}
         * を抜き出す
         * 
         * 正規表現のポイント
         * ? 最短マッチにする
         */
        //-- 1 : アの選択肢 
        preg_match("{<li>ア：(.*?)</li>}u", $question_body, $temp_choice);
        if(isset($temp_choice[1])) 
        {
            $choices[1] = strip_tags($temp_choice[1], '<sup><sub><span>');
        } else 
        {
            $choices[1] = '';
        }
        
        //-- 2 : イの選択肢
        preg_match("{<li>イ：(.*?)</li>}u", $question_body, $temp_choice);
        if(isset($temp_choice[1])) 
        {
            $choices[2] = strip_tags($temp_choice[1], '<sup><sub><span>');
        } else 
        {
            $choices[2] = '';
        }
        
        //-- 3 : ウの選択肢
        preg_match("{<li>ウ：(.*?)</li>}u", $question_body, $temp_choice);
        if(isset($temp_choice[1])) 
        {
            $choices[3] = strip_tags($temp_choice[1], '<sup><sub><span>');
        } else 
        {
            $choices[3] = '';
        }
        
        //-- 4 : エの選択肢
        preg_match("{<li>エ：(.*?)</li>}u", $question_body, $temp_choice);
        if(isset($temp_choice[1]))
        {
            $choices[4] = strip_tags($temp_choice[1], '<sup><sub><span>');
        } else 
        {
            $choices[4] = '';
        }
         
        return $choices;
    }
    
    /**
     * covert_correct
     * beforequestion.question_commentaryから、正解を取得
     * 
     * ●命名規則「3ヶ月後の自分自身に優しく、チームに優しく、まだ見ぬメンバーに優しく」
     * 1. 変数名・関数名は「短いコメント」と思い、明確で具体的で誤解のない単語を選ぶ（汎用的なtmpなどを使わない）
     * 例 $question_commentary 問題の解説
     * 
     * @param string $question_commentary beforequestion.question_commentary
     * @return int $correct_flag 1:ア 2:イ 3:ウ 4:エ
     */
    public static function covert_correct($question_commentary) {
        $correct_flag = 0;
        
        /*
         * beforequestion.question_commentary
         * の
         * <h3>正解：{ア|イ|ウ|エ}</h3>
         * から、{ア|イ|ウ|エ}をいずれか取得し
         * ア=1
         * イ=2
         * ウ=3
         * エ=4
         * にコンバート
         * 
         */
        //-- 正解を取得
        preg_match("{<h3>正解：(.*?)</h3>}u", $question_commentary, $temp_correct);
        if($temp_correct[1] === 'ア') {
            /*
             * ●命名規則「3ヶ月後の自分自身に優しく、チームに優しく、まだ見ぬメンバーに優しく」
             * 2. 接頭辞・接尾辞をうまく使い1.を実現する
             * フラグの場合は"_flag"接尾辞をつける
             */
        	$correct_flag = 1;
        } elseif($temp_correct[1] === 'イ') {
            $correct_flag = 2;
        } elseif($temp_correct[1] === 'ウ') {
            $correct_flag = 3;
        } elseif($temp_correct[1] === 'エ') {
            $correct_flag = 4;
        } 
        
        return $correct_flag;
    }

}
