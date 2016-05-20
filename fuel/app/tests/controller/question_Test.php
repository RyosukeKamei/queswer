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
        $this->assertTrue(isset($questions['first_category_id']));
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
            = Controller_Question::removed_choice_question_body($questions['question_body']);
        /*
         * 選択肢が除去されていれば、除去前と比較して異なる
         */
        $this->assertNotEquals($conveted_question_body, $questions['question_body']);
    }
    
    /**
     * create_choiceをテスト
     * IPA系の場合4つの選択肢に値があればOK
	 * 各先頭の<li>と末尾の</li>が抜けていればOK
     */
    public function test_create_choice() {
        /*
         * beforequestionから値を取得
         */
        $questions = Controller_Question::get_before_question(2);
        
        /*
         * 選択肢を除去
         */
        $choices
            = Controller_Question::create_choice($questions['question_body']);
        
        /*
         * IPA系の場合選択肢は4つなので、foreachした時に4つ値が取れる
         * ただし、他の試験を考慮すると4つとは限らないので値は固定にしない
         * foreachすれば4つを超えても大丈夫なはず
         */
        foreach($choices AS $key => $choice) {
            /*
             * 4つの選択肢に値があればOK
             */
            $this->assertTrue(isset($choice));
            
            /*
             * 選択肢に<li>があればエラー
             * あればエラーなので"Not"をつける
             */
            $this->assertNotRegExp('{<li>}', $choice);
            
            /*
             * 選択肢に</li>があればエラー
             * あればエラーなので"Not"をつける
             */
            $this->assertNotRegExp('{</li>}', $choice);
        }
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
        $correct_flag = Controller_Question::create_correct($questions['question_commentary']);

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