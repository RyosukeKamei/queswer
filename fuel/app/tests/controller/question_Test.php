<?php
use Fuel\Core\Controller;
/**
 * questionテスト
 * 
 *
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
     * removed_choice_question_bodyをテスト
     * beforequestion.question_bodyとquestion.question_bodyを比較して異なればOK（苦しい？）
     */
    public function test_removed_choice_question_body() {
        /*
         * beforequestionから値を取得
         */
        $questions = Controller_Question::get_before_question(2);
        
        /*
         * 選択肢を除去
         */
        $conveted_question_body 
            = Controller_Question::removed_choice_question_body($questions['question_body'], 'ul');
        /*
         * 選択肢が除去されていれば、除去前と比較して異なる
         */
        $this->assertNotEquals($conveted_question_body, $questions['question_body']);
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
}