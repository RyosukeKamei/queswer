<?php
/**
 * roundモデルのテスト
 * @group Question
 */

class Test_Model_Round extends \TestCase
{
	/**
	 * test_get_rounds_by_examination
	 * 試験の一覧を試験区分（応用情報はexamination_id = 3）ごとに取得する
	 * 
	 * メモ
	 * 実質SQLのチェック程度
	 * このようなテストが必要かどうかは不明
	 */
	public function test_get_rounds_by_examination() {
		/*
		 * @TODO
		 * 現状は$examination_id = 3のみ
		 * いずれはexaminationsから値を取得し、全テスト
		 */
		$rounds = Model_Round::get_rounds_by_examination(3);
		
		/*
		 * １件以上取得できれば良いとする
		 * （SQL構文チェック程度）
		 */
		$this->assertGreaterThanOrEqual(1, /* ≦ */ count($rounds));
	}

}