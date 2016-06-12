<?php
/**
 * questionモデルのテスト
 */

class Test_Model_Choice extends \TestCase
{
	/**
	 * test_get_question_keywords
	 * if文はないが引数をとるのでWHERE句と同じようにテスト
	 * WHEREに設定した値が結果として取れればテストOK
	 */
	public function test_get_choice_keywords() {
	    $test_round_id        = 14;
	    $test_question_number = 1;
	    $choice_keywords = Model_Choice::get_choice_keywords(
	    		  $test_round_id         /* = 14 */
	    		, $test_question_number  /* = 1  */
	    );
	    
	    $error = false;
	    foreach($choice_keywords AS $key => $choice_keyword) {
	        if((int)$choice_keyword['round_id'] !== (int)$test_round_id) {
	        	$error = true;
	        	break;
	        }
	        if((int)$choice_keyword['question_number'] !== (int)$test_question_number) {
	        	$error = true;
	        	break;
	        }
	    }
	    
	    $this->assertEquals($error, false);
	}
}