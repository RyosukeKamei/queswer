<?php
/**
 * answerdetailモデルのテスト
 * @group Question
 */

class Test_Model_Answerdetail extends \TestCase
{
	/**
	 * test_get_summary
	 * 試験区分ごとのトップページのサマリ情報を取得
	 * 
	 * @todo
	 * テストデータができたら、すべてのパターンを網羅する？
	 * 
	 * メモ
	 * 実質SQLのチェック程度
	 * このようなテストが必要かどうかは不明
	 */
	public function test_get_summary() {
		/*
		 * get_summaryの第一引数に入る値は固定化されているので配列化
		 * group byに使う
		 */
		$user_summary_categories[] = 'divitions';        // 問題種別ごと
		$user_summary_categories[] = 'topcategories';    // ストラテジ・テクノロジ・マネジメント
		$user_summary_categories[] = 'thirdcategories';  // 大項目
		$user_summary_categories[] = 'secondcategories'; // 中項目
		$user_summary_categories[] = 'firstcategories';  // 小項目
		
		/*
		 * 現状は第2引数, 第4引数を固定しているが、データが揃ったら動的にする
		 * ユーザID入力バージョン（ユーザごとのサマリ）
		 */
		$error_flag = false;
		foreach($user_summary_categories AS $user_summary_category) {
			$rounds = Model_Answerdetail::get_summary(
													  $user_summary_category /* 問題種別ごと */
													, 3                      /* 応用情報技術者試験 */
													, 1                      /* ユーザIDはテスト用で1固定 */
													, 14                     /* 平成27年度秋 */
			);
			
			/*
			 * 現状値が取れていれば良い
			 * 1件でもエラーがあればテスト不合格
			 */
			if(count($rounds) < 1) {
				$error_flag = true;
				break;
			}
		}
		
		/*
		 * $error_flagがfalseだとテストが通る
		 */
		$this->assertFalse($error_flag);

		/*
		 * 現状は第2引数, 第4引数を固定しているが、データが揃ったら動的にする
		 * ユーザID未入力バージョン（全体のサマリ。全体の傾向を見る）
		 */
		$error_flag = false;
		foreach($user_summary_categories AS $user_summary_category) {
			$rounds = Model_Answerdetail::get_summary(
					$user_summary_category /* 問題種別ごと */
					, 3                      /* 応用情報技術者試験 */
					, null                   /* ユーザID未入力 */
					, 14                     /* 平成27年度秋 */
			);
				
			/*
			 * 現状値が取れていれば良い
			 * 1件でもエラーがあればテスト不合格
			*/
			if(count($rounds) < 1) {
				$error_flag = true;
				break;
			}
		}
		
		/*
		 * $error_flagがfalseだとテストが通る
		 */
		$this->assertFalse($error_flag);
		
	}

}