<?php
/**
 * Keywordcategoryモデルのテスト
 */

class Test_Model_Keywordcategory extends \TestCase
{
	public function test_get_keywordcategories() {
		
	    /*
	     * トライアンドエラー
	     * WHERE句のテスト
	     * WHERE句に値を入れて、返ってくる値すべてに入力したWHERE句があれば良いのでは？
	     */
	    /*
	     * WHEREテスト
	     * テストが通るはずの組み合わせ
	     * （SQLが通るかどうかのテストレベル）
	     */
	    $test_firstcategory_id  = 1;
	    $test_secondcategory_id = 1;
	    $test_keyword_id        = 240;
	    $keywordcartegory_wheres['firstcategory_id']  = $test_firstcategory_id;
	    $keywordcartegory_wheres['secondcategory_id'] = $test_secondcategory_id;
	    $keywordcartegory_wheres['keyword_id']        = $test_keyword_id;
	    $keywordcartegories = Model_Keywordcategory::get_keywordcategories($keywordcartegory_wheres, 0);
	    $keywordcartegory_wheres = null;
	    
	    /*
	     * 複数の値が前提なのでループする
	     * 1レコードずつアサート使うと量が増えるので
	     * 1つでも値が異なれば$errorをtrueにしてループを抜ける
	     * $errorがfalseかどうかのみをアサート
	     */
	    $error = false;
	    foreach($keywordcartegories AS $key => $keywordcartegory) {
	        if((int)$keywordcartegory->firstcategory_id !== $test_firstcategory_id) {
	            $error = true;
	            break;
	        }
	        if((int)$keywordcartegory->firstcategory->secondcategory_id !== $test_secondcategory_id) {
	        	$error = true;
	        	break;
	        }
	        if((int)$keywordcartegory->keyword_id !== $test_keyword_id) {
	        	$error = true;
	        	break;
	        }
	    }
		$this->assertEquals($error, false);
		$keywordcartegories     = null;
		$test_firstcategory_id  = null;
		$test_secondcategory_id = null;
		$test_keyword_id        = null;
		/*
		 * end of WHEREテスト
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
		$test_firstcategory_id  = 1;
		$test_secondcategory_id = 1;
		$test_keyword_id        = 240;
		$keywordcartegory_wheres['firstcategory_id']  = $test_firstcategory_id;
		$keywordcartegory_wheres['secondcategory_id'] = $test_secondcategory_id;
		$keywordcartegory_wheres['keyword_id']        = $test_keyword_id;
		$keywordcartegory = Model_Keywordcategory::get_keywordcategories($keywordcartegory_wheres, 1);
	    $keywordcartegory_wheres = null;
		$this->assertEquals($keywordcartegory->firstcategory_id,                 $test_firstcategory_id);
		$this->assertEquals($keywordcartegory->firstcategory->secondcategory_id, $test_secondcategory_id);
		$this->assertEquals($keywordcartegory->keyword_id,                       $test_keyword_id);
		$questions = null;
	}
}