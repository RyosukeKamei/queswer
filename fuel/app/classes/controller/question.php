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

    public function action_create()
    {
        if (Input::method() == 'POST')
        {
            $val = Model_Question::validate('create');

            if ($val->run())
            {
                $question = Model_Question::forge(array(
                    'question_number' => Input::post('question_number'),
                    'question_title' => Input::post('question_title'),
                    'question_body' => Input::post('question_body'),
                    'question_commentary' => Input::post('question_commentary'),
                    'first_category_id' => Input::post('first_category_id'),
                    'divition_id' => Input::post('divition_id'),
                    'round_id' => Input::post('round_id'),
                    'prefix_id' => Input::post('prefix_id'),
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
            $question->question_title = Input::post('question_title');
            $question->question_body = Input::post('question_body');
            $question->question_commentary = Input::post('question_commentary');
            $question->first_category_id = Input::post('first_category_id');
            $question->divition_id = Input::post('divition_id');
            $question->round_id = Input::post('round_id');
            $question->prefix_id = Input::post('prefix_id');
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
                $question->question_title = $val->validated('question_title');
                $question->question_body = $val->validated('question_body');
                $question->question_commentary = $val->validated('question_commentary');
                $question->first_category_id = $val->validated('first_category_id');
                $question->divition_id = $val->validated('divition_id');
                $question->round_id = $val->validated('round_id');
                $question->prefix_id = $val->validated('prefix_id');
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
    
    /**
     * action_solve
     * 解答し、次の問題を取得
     * 
     * パターン1 初めて問題に取り組む場合
     * 入力 $round_id = 15 $answer_id = 0, $answer = 0
     * answers（1レコード）とanswerdetails（80レコード）を生成
     * １問目を取得（answer_idから、answerカラムがnullで、一番若いレコードを取得）
     * 
     * パターン2 一覧画面から「続き」をクリックした場合
     * 入力 $round_id = 0 $answer_id = {int}, $answer = null
     * answer_idから、answerカラムがnullで、一番若いレコードを取得
     * 
     * パターン3 問題画面で解答した場合
     * 入力 $round_id = 0 $answer_id = {int}, $answer = {int}
     * answer_idから、answerカラムがnullで、一番若いレコードにanswerの値を入れる
     * answer_idから、answerカラムがnullで、一番若いレコードを取得
     * 
     * @param int $round_id 実施回 平成28年度春応用情報技術者試験の場合は15
     * @param int $answer_id 解答を格納するテーブルのヘッダID
     * @param int $answer 答え（1:ア 2:イ 3:ウ 4:エ）
     */
    public function action_solve($round_id, $answer_id = 0, $answer = 0) {
        /*
         * 一覧画面から問題画面に遷移する前に初期化する
         * 例
         * round_id = 15 平成28年度春応用情報技術者試験
         * answer_id = 1 回答ヘッダのid nullの場合は初回なので初期化する
         */

        /*
         * 答えが入力された場合は
         * 解答する
         * 
         * たぼっちへ
         * ここは最後
         */
        if($answer_id && $answer) {
            /*
             * answerdetailsのanswerにデータが入る
             */
            $this->answer($answer_id, $answer);
        }

        
        /*
         * 1. 初めて問題を解く場合
         * 初期化をしてanswer_idを取得
         * 2. 続きをする場合
         * ブラウザ入力された$answer_idそのまま
         * 
         * たぼっちへ
         * ここがはじめ
         */
        if(!$answer_id) {
            $answer_id = answer_init($round_id);
        }
        
        /*
         * 次の問題を取得
         * answer_idからanswerdetailsを見て、answerにデータがなく一番若いレコードを取得
         * 
         * たぼっちへ
         * ここが２つ目
         */
        $answers = $this->get_next_question($answer_id);
        
        
    }
    
    /**
     * answer
     * answerdetailsのanswerにデータが入る
     * 
     * answer_idからanswerdetailを取得
     * WHERE句はanswer_idとanswerがNULLで一番若いレコード
     * 
     * @param int $answer_id
     * @param int $answer
     */
    private function answer($answer_id, $answer) {
        /*
         * UPDATE文作成
         */
        
        /*
         * UPDATE文実行
         */
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
        $frequency = $this->get_frequency ( $round_id ) + 1;
        
        /*
         * create_answers メソッド
         * ヘッダの1レコード生成
         */
        if ($this->create_answers ( $round_id, $frequency )) {
            /*
             * answer_idは問題文を取得するのに利用する
             */
            $answer_id = $pdo->lastInsertId ( 'id' );
            
            /*
             * create_answer_details メソッド
             * answerdetail（80レコード）を生成
             */
            if (! $this->create_answer_details ( $answer_id )) {
                /*
                 * レコードができなかったらFatal Error
                 * 本来ユニットテストで対応するからありえないはず
                 *
                 */
                Session::set_flash ( 'error', 'FATAL ERROR answerdetailsレコード生成ができませんでした。 ' );
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
     * get_frequency
     * answerテーブルをround_idとuser_idでフィルタし
     * その実施回が何回目かを取得
     * 
     * @param int $round_id 実際回（平成28年度応用情報技術者試験 15）
     * @return int $frequency 実施回数（平成28年度応用情報技術者試験 2回目）
     */
    public function get_frequency($round_id) {
        $frequency = 0;
        
        /*
         * たぼっちへ
         * コーディングしてね
         */
        
        /*
         * SELECT文
         * 
         */
        
        /*
         * 実行
         */
        
        return $frequency;
    }
    
    /**
     * create_answers
     * answerテーブルを生成
     * 
     * @param int $round_id 実際回（平成28年度応用情報技術者試験 15）
     * @param int $frequency 実施回数（平成28年度応用情報技術者試験 2回目）
     * @return boolean $success INSERT文成功したかどうか
     */
    public function create_answers( $round_id, $frequency ) {
        /*
         * たぼっちへ
         * コーディングしてね
         */
        $success = false;
        
        /*
         * INSERT文
         */
        
        /*
         * INSERT文実行
         */
        
        return $success;
    }
    
    /**
     * create_answer_details
     * answerdetailテーブルを生成
     * answerはnullでquestion_numだけ
     * 80レコード
     * 
     * @param unknown $answer_id
     * @return boolean
     */
    public function create_answer_details($answer_id) {
        /*
         * たぼっちへ
         * コーディングしてね
         */
        $success = false;
        
        /*
         * 80レコード生成
         */
        $sql = "";
        for($question_num = 1; $question_num <= 80; $question_num++) {
            /*
             * 1レコードずつ
             */
            
        }
        
        /*
         * SQL実行
         */
        
        return $success;
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
     * 2. removed_choice_question_body($question_body)
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
         * POSTに値がある場合はコンバート実行
         */
        if (Input::method() == 'POST')
        {
            /*
             * QuestionとChoiceのINSERTを実行
             */
            $this->create_question($beforequestion_id);
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
         */
        $data['questions']['conveted_question_body'] = $this->removed_choice_question_body($before_questions->question_body);

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
     * @param int $beforequestion_id beforequestionのID
     */
    private function create_question($beforequestion_id) {
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
        $question_validation = Model_Question::validate('question_create');
        if ($question_validation->run())
        {
            /*
             * 問題を追加するINSERT（もしくはUPDATE）を生成
             */
            $question = Model_Question::forge(array(
                    'question_number'     => Input::post('question_number'),         // 問題番号（固定）
                    'question_body'       => Input::post('conveted_question_body'),  // 問題本文
                    'question_commentary' => Input::post('question_commentary'),     // 問題解説（固定）
                    'first_category_id'   => Input::post('first_category_id'),       // 小項目（固定）
                    'divition_id'         => Input::post('divition_id'),             // 問題区分（固定）
                    'round_id'            => Input::post('round_id'),                // 問題実施（固定）
                    'prefix_id'           => Input::post('prefix_id'),               // 選択肢の名称（固定）
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
                 */
                $success = $this->create_choices($question_last_id);
                
                /*
                 * エラーがない場合は成功メッセージをセットして、次の問題のコンバートに移動
                 */
                if($success) {
                    Session::set_flash('success', '問題を追加しました！ #'.$question->id.'.');
                    $pdo->commit();
                    /*
                     * 次のIDにリダイレクト
                     */
                    $to_redirect = '/question/convert/'.++$beforequestion_id;
                    Response::redirect($to_redirect);
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
    }
    
    /**
     * create_choices
     * 選択肢（4つ）を生成
     * 
     * @param int $question_last_id question.id
     * @return boolean
     */
    private function create_choices($question_last_id) {
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
            if($choice_num === (int)Input::post('correct_flag'))
            {
                $correct_flag = 1;
            }
         
            /*
             * Choiceのバリデーション
             */
            $choice_validation = Model_Choice::validate('convert', $choice_num);
            if ($choice_validation->run())
            {
                /*
                 * 問題を追加するINSERT（もしくはUPDATE）を生成
                 */
                $choice = Model_Choice::forge(array(
                    'question_id'  => $question_last_id,                       // 問題番号（固定）
                    'choice_num'   => $choice_num,                             // 選択肢番号
                    'correct_flag' => $correct_flag,                           // 正解
                    'choice_body'  => Input::post('choice_body_'.$choice_num), // 選択肢
                ));
        
                if (!($choice and $choice->save()))
                {
                    Session::set_flash('error', '選択肢を追加できませんでした。');
                    return false;
                }
            } else
            {
                Session::set_flash('error', $choice_validation->error());
                return false;
            }
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
     * beforequestion.question_bodyから選択肢を除去
     * 
     * @param string $question_body beforequestionのquestion_body（選択肢除去前）
     * @return string $conveted_question_body 選択肢を除去したquestion_body
     */
    public static function removed_choice_question_body($question_body) {
        /*
         * <ul><li></li>...</ul>を除去
         */
        return preg_replace('{<ul>(.*)</ul>}', '', $question_body);
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
            $choices[1] = $temp_choice[1];
        } else 
        {
            $choices[1] = '';
        }
        
        //-- 2 : イの選択肢
        preg_match("{<li>イ：(.*?)</li>}u", $question_body, $temp_choice);
        if(isset($temp_choice[1])) 
        {
            $choices[2] = $temp_choice[1];
        } else 
        {
            $choices[2] = '';
        }
        
        //-- 3 : ウの選択肢
        preg_match("{<li>ウ：(.*?)</li>}u", $question_body, $temp_choice);
        if(isset($temp_choice[1])) 
        {
            $choices[3] = $temp_choice[1];
        } else 
        {
            $choices[3] = '';
        }
        
        //-- 4 : エの選択肢
        preg_match("{<li>エ：(.*?)</li>}u", $question_body, $temp_choice);
        if(isset($temp_choice[1]))
        {
            $choices[4] = $temp_choice[1];
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
