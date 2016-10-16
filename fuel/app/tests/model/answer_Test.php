<?php
/**
 * questionモデルのテスト
 * @group Question
 */

class Test_Model_Answer extends \TestCase
{
	public function test_create_answer() {
		/*
		 * 準備
		 */
		$round_id  = 12;
		$user_id   = 1;
		$frequency = 1;
		
		$answer_id = Model_Answer::create_answer($round_id, $user_id, $frequency);
		$this->assertGreaterThanOrEqual(1, /* ≦ */ $answer_id);
		
		$this->assertTrue(Model_Answerdetail::create_answer_details ( $answer_id ));
		
		/*
		 * 後始末
		 */
		$answer = Model_Answer::find($answer_id);
		$answer->delete();
	}
}