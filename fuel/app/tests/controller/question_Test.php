<?php
use Fuel\Core\Controller;
/**
 * questionテスト
 * 
 * @group Question
 * @group App
 */
class Test_Controller_Question extends TestCase
{
    /**
     * get_before_questionをテスト
     * コンバートする値があるか
     * 
     * 
     */
    public function test_get_before_question()
    {
        $questions = Controller_Question::get_before_question(2);
        /*
         * コンバートするカラムのみテスト対象
         */
        $this->assertTrue(isset($questions['question_body']));
        $this->assertTrue(isset($questions['question_commentary']));
        $this->assertTrue(isset($questions['firstcategory_id']));
        $this->assertTrue(isset($questions['divition_id']));
        $this->assertTrue(isset($questions['round_id']));
        $this->assertTrue(isset($questions['prefix_id']));
    }
    
    /**
     * removed_tag_and_contentsをテスト
     * beforequestion.question_bodyと
     * question.question_bodyを比較して異なればOK（苦しい？）
     * 
     * ●コーディング規則「優しいコードを書こう」
     * 1. テストファースト（ユニットテストを先に書く）
     */
    public function test_removed_tag_and_contents() {
        /*
         * beforequestionから値を取得
         */
        $questions = Controller_Question::get_before_question(2);
        
        /*
         * 選択肢を除去
         */
        $conveted_question_body 
            /*
             * ●コーディング規則「優しいコードを書こう」
             * 3. 横幅は80文字以内とし、縦の線をまっすぐにする意識をすると、ソースの可読性が向上する
             */
            = Controller_Question::removed_tag_and_contents(
            		  $questions['question_body']
            		, 'ul'
            );
        /*
         * 選択肢が除去されていれば、除去前と比較して異なる
         */
        $this->assertNotEquals(
        		  $conveted_question_body
        		, $questions['question_body']
        );
    }
    
    /**
     * test_create_correct
     * 正解を1から4の数値で得る
     * 元のHTMLに不具合がある場合は0を返す
     */
    public function test_create_correct() {
        /*
         * beforequestionから値を取得
         */
        $questions = Controller_Question::get_before_question(2);
        
        /*
         * 正解を取得
         */
        $correct_flag = Controller_Question::covert_correct($questions['question_commentary']);

        /*
         * IPA系の場合
         * 1から4の値であること
         * 元のHTMLに不具合がある場合は0
         * テストではOKとする
         */
        $this->assertGreaterThanOrEqual(0, /* ≦ */ $correct_flag);
        $this->assertLessThanOrEqual   (4, /* ≧ */ $correct_flag);  
    }
    
    public function test_create_question() {
    	/*
    	 * サンプルで登録する値
    	 * POSTで取得する想定
    	 */
        $posts['question_number']     = 1;
		$posts['question_body']       = '問題本文テスト';
		$posts['question_commentary'] = '問題解説';
        $posts['firstcategory_id']    = 1;				// 小項目
        $posts['divition_id']         = 1;				// 問題区分
        $posts['round_id']            = 1;				// 問題実施
        $posts['prefix_id']           = 1;				// 固定
        $posts['choice_body_1']       = '選択肢ア';
        $posts['choice_body_2']       = '選択肢イ';
        $posts['choice_body_3']       = '選択肢ウ';
        $posts['choice_body_4']       = '選択肢エ';
        $posts['choice_body_4']       = '選択肢エ';
        $posts['correct_flag']        = 1;				// 正解はア
        
        /*
         * テスト実行
         * 成功すると、$question_last_id（その時登録したquestion_id）を取得
         */
        $question_last_id = Controller_Question::create_question($posts, true);
        
        /*
         * $question_last_id（その時登録したquestion_id）が1以上なら、登録成功
         */
        $this->assertGreaterThanOrEqual(1, /* ≦ */ $question_last_id);

        /*
         * 変更対象
         */
        $question = Model_Question::find($question_last_id);
        $choices  = Model_Choice::find('all', array('where' => array(array('question_id', $question_last_id),)));
        
        /*
         * サンプルで登録する値
         * POSTで取得する想定
        */
        $posts['question_number']     = 2;
        $posts['question_body']       = '変更テスト';
        $posts['question_commentary'] = '変更解説';
        $posts['firstcategory_id']    = 2;				// 小項目
        $posts['divition_id']         = 2;				// 問題区分
        $posts['round_id']            = 2;				// 問題実施
        $posts['prefix_id']           = 1;				// 固定
        $posts['choice_body_1']       = '選択肢ア変更';
        $posts['choice_body_2']       = '選択肢イ変更';
        $posts['choice_body_3']       = '選択肢ウ変更';
        $posts['choice_body_4']       = '選択肢エ変更';
        $posts['correct_flag']        = 3;				// 正解はウ
        
        /*
         * テスト
         */
        $this->assertTrue(Controller_Question::edit_question($question_last_id, $question, $posts, true));
        $this->assertTrue(Controller_Question::edit_choices($question_last_id,  $choices,  $posts));        
        
        /*
         * 後始末
         * テストで追加したデータを削除
         * questionを削除すると、choicesも削除
         */
        $this->assertEquals(1, DB::delete('questions')->where('id', $question_last_id)->execute());
    }
    
//     public function test_edit_question() {
//     	/*
//     	 * サンプルで登録する値
//     	 * POSTで取得する想定
//     	 */
//         $posts['question_number']     = 1;
// 		$posts['question_body']       = '問題本文テスト';
// 		$posts['question_commentary'] = '問題解説';
//         $posts['firstcategory_id']    = 1;				// 小項目
//         $posts['divition_id']         = 1;				// 問題区分
//         $posts['round_id']            = 1;				// 問題実施
//         $posts['prefix_id']           = 1;				// 固定
//         $posts['choice_body_1']       = '選択肢ア';
//         $posts['choice_body_2']       = '選択肢イ';
//         $posts['choice_body_3']       = '選択肢ウ';
//         $posts['choice_body_4']       = '選択肢エ';
//         $posts['correct_flag']        = 1;				// 正解はア
        
//         /*
//          * テスト実行
//          * 成功すると、$question_last_id（その時登録したquestion_id）を取得
//          */
//         $question_last_id = Controller_Question::create_question($posts, true);
        
//     	/*
//     	 * 変更対象
//     	 */
//     	$question = Model_Question::find($question_last_id);
//     	$choices  = Model_Choice::find('all', array('where' => array(array('question_id', $question_last_id),)));
        
//     	/*
//     	 * サンプルで登録する値
//     	 * POSTで取得する想定
//     	 */
//     	$posts['question_number']     = 2;
//     	$posts['question_body']       = '変更テスト';
//     	$posts['question_commentary'] = '変更解説';
//     	$posts['firstcategory_id']    = 2;				// 小項目
//     	$posts['divition_id']         = 2;				// 問題区分
//     	$posts['round_id']            = 2;				// 問題実施
//     	$posts['prefix_id']           = 1;				// 固定
//     	$posts['choice_body_1']       = '選択肢ア変更';
//     	$posts['choice_body_2']       = '選択肢イ変更';
//     	$posts['choice_body_3']       = '選択肢ウ変更';
//     	$posts['choice_body_4']       = '選択肢エ変更';
//     	$posts['correct_flag']        = 3;				// 正解はウ

//     	/*
//     	 * テスト
//     	 */
//     	$this->assertTrue(Controller_Question::edit_question($question_id, $question, $posts, true));
//     	$this->assertTrue(Controller_Question::edit_choices($question_id,  $choices,  $posts));
    	    	
//     	/*
//     	 * 後始末
//     	 * テストで追加したデータを削除
//     	 * questionを削除すると、choicesも削除
//     	 */
//     	$this->assertEquals(1, DB::delete('questions')->where('id', $question_last_id)->execute());
    	
    	 
    	 
//     }
}