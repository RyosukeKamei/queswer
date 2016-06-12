<?php
/**
 * questionモデルのテスト
 */

class Test_Model_Question extends \TestCase
{
	public function test_get_questions() {
		
	    /*
	     * トライアンドエラー
	     * WHERE句のテスト
	     * WHERE句に値を入れて、返ってくる値すべてに入力したWHERE句があれば良いのでは？
	     */
	    /*
	     * firstcategory_idのWHEREテスト
	     */
	    $test_value = 1;
	    $question_wheres['firstcategory_id'] = $test_value;
	    $questions = Model_Question::get_questions($question_wheres, 0);
	    $question_wheres = null;
	    
	    /*
	     * 複数の値が前提なのでループする
	     * 1レコードずつアサート使うと量が増えるので
	     * 1つでも値が異なれば$errorをtrueにしてループを抜ける
	     * $errorがfalseかどうかのみをアサート
	     */
	    $error = false;
	    foreach($questions AS $key => $question) {
	        if((int)$question->firstcategory_id !== $test_value) {
	            $error = true;
	            break;
	        }
	    }
		$this->assertEquals($error, false);
		$questions = null;
		$test_value = null;
		/*
		 * end of firstcategory_idのWHEREテスト
		 */
		
		/*
		 * question_numberのWHEREテスト
		 */
		$test_value = 1;
		$question_wheres['question_number'] = $test_value;
		$questions = Model_Question::get_questions($question_wheres, 0);
		$question_wheres = null;
		 
		$error = false;
		foreach($questions AS $key => $question) {
			if((int)$question->question_number !== $test_value) {
				$error = true;
				break;
			}
		}
		$this->assertEquals($error, false);
		$questions = null;
		/*
		 * end of question_numberのWHEREテスト
		 */
		
		/*
		 * round_idのWHEREテスト
		 */
		$test_value = 14;
		$question_wheres['round_id'] = $test_value;
		$questions = Model_Question::get_questions($question_wheres, 0);
		$question_wheres = null;
		
		$error = false;
		foreach($questions AS $key => $question) {
			if((int)$question->round_id !== (int)$test_value) {
				$error = true;
				break;
			}
		}
		$this->assertEquals($error, false);
		$questions = null;
		/*
		 * end of question_numberのWHEREテスト
		 */
		
		/*
		 * get_oneのテスト
		 * get_questionsの第二引数のテスト
		 * $get_one = 0は上記のテストで実施済み
		 * $get_one = 1をテスト
		 * 
		 * 値は1つだけ取得
		 * 
		 */
		$test_round_id        = 14;
		$test_question_number = 1;
		$question_wheres['round_id']        = $test_round_id;
		$question_wheres['question_number'] = $test_question_number;
		$question = Model_Question::get_questions($question_wheres, 1);
		$question_wheres = null;
		$this->assertEquals($question->round_id,        $test_round_id);
		$this->assertEquals($question->question_number, $test_question_number);
		$questions = null;
	}
	
	/**
	 * test_get_question_keywords
	 * if文はないが引数をとるのでWHERE句と同じようにテスト
	 * WHEREに設定した値が結果として取れればテストOK
	 */
	public function test_get_question_keywords() {
	    $test_round_id        = 14;
	    $test_question_number = 1;
	    $question_keywords = Model_Question::get_question_keywords(
	    		  $test_round_id         /* = 14 */
	    		, $test_question_number  /* = 1  */
	    );
	    
	    $error = false;
	    foreach($question_keywords AS $key => $question_keyword) {
	        if((int)$question_keyword['round_id'] !== (int)$test_round_id) {
	        	$error = true;
	        	break;
	        }
	        if((int)$question_keyword['question_number'] !== (int)$test_question_number) {
	        	$error = true;
	        	break;
	        }
	    }
	    
	    $this->assertEquals($error, false);
	}
}