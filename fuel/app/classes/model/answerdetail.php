<?php
use Orm\Model;

class Model_Answerdetail extends Model
{
	protected static $_properties = array(
		'id',
		'question_number', 
		'answer_id',
		'answer',
		'deleted_at',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('question_number', 'Question Num', 'required|valid_string[numeric]');
		$val->add_field('answer_id', 'Answer Id', 'required|valid_string[numeric]');
		$val->add_field('answer', 'Answer', 'required|valid_string[numeric]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}
	
	/*
	 * answerをJOIN
	 */
	protected static $_belongs_to = array('answer');
	
	
	/**
	 * create_answer_details
	 * 解答レコードを80個生成
	 * 
	 * @param int $answer_id 解答ID
	 * @return boolean
	 */
	public static function create_answer_details($answer_id) 
	{
		for($question_number = 1; $question_number <= 80; $question_number++) 
		{
			$answerdetail = Model_Answerdetail::forge(
				array(
					'question_number'     => $question_number,		// 問題番号
					'answer_id'      => $answer_id,					// 解答ヘッダID
				)
			);
			
			if (!($answerdetail and $answerdetail->save())) 
			{
				return false;
			}
		}
		return true;
	}
	
	/**
	 * answered
	 * 解答
	 * 
	 * @param int $answer_id
	 * @param int $question_number
	 * @param int $answer
	 * @return boolean
	 */
	public static function answered($answer_id, $question_number, $answer) 
	{
		$answerdetail = Model_Answerdetail::find('first', array (
							'where' => array (
									  array('answer_id',     "=", $answer_id)
									, array('question_number',      "=", $question_number)
							)
						));
		$answerdetail->answer = $answer;
		
		if (!($answerdetail and $answerdetail->save())) 
		{
			return false;
		} 
		else 
		{
			return true;
		}
	}
	
	/**
	 * get_summary
	 * サマリーを取得する
	 * 
	 * @param サマリーする単位 $user_summary_category
	 * 							divitions        問題種別
	 * 							topcategories    ストラテジ・テクノロジ・マネジメント
	 * 							thirdcategories  大項目
	 * 							secondcategories 中項目
	 * 							firstcategories  小項目
	 * @param int $examnation_id 問題区分 $examnation_id = 3 応用情報技術者試験
	 * @param int $user_id ユーザID 
	 * @param int $round_id 実施回 $round_id = 15 平成28年度春応用情報技術者試験
	 */
	public static function get_summary($user_summary_category, $examnation_id, $user_id = null, $round_id) {
		/*
		 * 引数がない場合の処理値はdivitions
		 */
		$summary_id   = 'divitions.id';
		$summary_name = 'divitions.divition_name';
		if($user_summary_category == 'divitions')
		{
			$summary_id   = 'divitions.id';
			$summary_name = 'divitions.divition_name';
		}
		elseif($user_summary_category == 'topcategories')
		{
			$summary_id   = 'topcategories.id';
			$summary_name = 'topcategories.top_category_name';
		}
		elseif($user_summary_category == 'thirdcategories')
		{
			$summary_id   = 'thirdcategories.id';
			$summary_name = 'thirdcategories.third_category_name';
		}
		elseif($user_summary_category == 'secondcategories')
		{
			$summary_id   = 'secondcategories.id';
			$summary_name = 'secondcategories.second_category_name';
		}
		elseif($user_summary_category == 'firstcategories')
		{
			$summary_id   = 'firstcategories.id';
			$summary_name = 'firstcategories.first_category_name';
		}
		
		$user_summaries = DB::select(
				array($summary_id, 'id')
				, array($summary_name, 'name')
				, array(DB::EXPR('SUM(CASE WHEN `answerdetails`.`answer` = `choices`.`choice_num` THEN 1 ELSE 0 END)'), 'correct_count')
				, array(DB::EXPR('COUNT(`answerdetails`.`id`)'), 'question_count')
		)
		->from('answerdetails')
		->join('answers', 'INNER')
		->on('answerdetails.answer_id', '=', 'answers.id')
		->join('rounds', 'INNER')
		->on('answers.round_id', '=', 'rounds.id')
		->join('examinations', 'INNER')
		->on('rounds.examination_id', '=', 'examinations.id')
		->join('questions', 'LEFT')
		->on('answerdetails.question_number', '=', 'questions.question_number')
		->and_on('answers.round_id', '=', 'questions.round_id')
		->join('choices', 'LEFT')
		->on('questions.id', '=', 'choices.question_id')
		->and_on('choices.correct_flag', '=', DB::EXPR(1))
		->join('divitions', 'INNER')
		->on('questions.divition_id', '=', 'divitions.id')
		->join('firstcategories', 'INNER')
		->on('questions.firstcategory_id', '=', 'firstcategories.id')
		->join('secondcategories', 'INNER')
		->on('firstcategories.secondcategory_id', '=', 'secondcategories.id')
		->join('thirdcategories', 'INNER')
		->on('secondcategories.thirdcategory_id', '=', 'thirdcategories.id')
		->join('topcategories', 'INNER')
		->on('thirdcategories.topcategory_id', '=', 'topcategories.id');
		
		/*
		 * 試験区分
		 * 例
		 * 応用情報技術者試験
		 * $examnation_id = 3
		 */
		if($examnation_id) 
		{
			$user_summaries->where('examinations.id', $examnation_id);
		}
		
		/*
		 * ユーザID
		 * 
		 */
		if($user_id) 
		{
			$user_summaries->where('answers.user_id', $user_id);
		}
		
		/*
		 * 実施回
		 * 
		 */
		if($round_id && (int)$round_id !== 9999) 
		{
			$user_summaries->where('answers.round_id', $round_id);
		}
		
		/*
		 * group by
		 */
		$user_summaries->group_by($summary_id);
		
		return $user_summaries->execute();		
	}
	
	public static function get_summary_question_count($summaries) {
		$summary_count = 0;
		if($summaries) {
			foreach($summaries AS $summary) {
				$summary_count = $summary_count + (int)$summary['question_count'];
			}
		}
		return $summary_count;
	}

}
