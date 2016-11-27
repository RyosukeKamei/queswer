<?php
use Orm\Model;

class Model_Answer extends Model
{
	protected static $_properties = array(
		'id',
		'round_id',
		'user_id',
		'event_id',
		'finish_flag',
		'frequency',
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
		$val->add_field('round_id', 'Round Id', 'required|valid_string[numeric]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('event_id', 'Event Id', 'required|valid_string[numeric]');
		$val->add_field('finish_flag', 'Finish Flag', 'required|valid_string[numeric]');
		$val->add_field('frequency', 'Frequency', 'required|valid_string[numeric]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}
	
	/**
	 * get_answers
	 * 解答ヘッダを取得
	 * 
	 * @param int $round_id 実施回
	 * @param int $user_id  ユーザID
	 * @return Ambigous <\Orm\Model, multitype:\Orm\Model >
	 */
	public static function get_answers($round_id /* = 14 */, $user_id /* = 1 */) {
		return Model_Answer::find('all', array (
							'where' => array (
									  array('round_id',     "=", $round_id)
									, array('user_id',      "=", $user_id)
							)
						));
	}
	
	public static function check_exist_answers($round_id /* = 14 */, $user_id /* = 1 */) {
		$answers = Model_Answer::find('all', array (
							'where' => array (
									  array('round_id',     "=", $round_id)
									, array('user_id',      "=", $user_id)
									, array('finish_flag',  "=", 0)
							)
		));
		
		return count($answers);
	}
	
	/**
	 * create_answer
	 * 解答ヘッダのレコードを生成
	 * 
	 * @param int $round_id  実施回
	 * @param int $user_id   ユーザID
	 * @param int $frequency 回数
	 * @param int $event_id イベントID
	 * @return number
	 */
	public static function create_answer($round_id /* = 14 */, $user_id /* = 1 */, $frequency /* = 1 */, $event_id /* = 1 */) 
	{
		$answer = Model_Answer::forge(array(
			'round_id'     => $round_id,				// 実施回
			'user_id'      => $user_id,					// ユーザID
			'event_id'     => $event_id,				// イベントに参加するときだけevent.idが入る。イベントに参加しない場合は0が入る
			'frequency'    => $frequency,				// 回数
			'finish_flag'  => 0,						// 初期値は0
		));
	
		if ($answer and $answer->save())
		{
			return $answer->id;
		} else {
			return 0;
		}
	}
	
	/**
	 * answer_finished
	 * 解答終了
	 * 
	 * @param int $answer_id
	 * @return boolean
	 */
	public static function answer_finished($answer_id)
	{
		$answer = Model_Answer::find($answer_id);
		$answer->finish_flag = 1;
		
		if (!($answer and $answer->save()))
		{
			return false;
		}
		else
		{
			return true;
		}
		
	}
	
	/**
	 * get_correct_count_each_topcartegory
	 * トップカテゴリごとのその回の正解数
	 * 
	 * @param unknown $event_id
	 */
	public static function get_correct_count_each_topcartegory($event_id) {
		$correct_counts = DB::select(
				  array('topcategories.id', 'id')
				, array('topcategories.top_category_name', 'name')
				, array(DB::EXPR('SUM(CASE WHEN `answerdetails`.`answer` = `choices`.`choice_num` THEN 1 ELSE 0 END)'), 'correct_count')
				, array(DB::EXPR('COUNT(`topcategories`.`id`)'), 'question_count')
		)
		->from('answerdetails')
		->join('answers', 'INNER')
		->on('answerdetails.answer_id', '=', 'answers.id')
		->join('questions', 'INNER')
		->on('answerdetails.question_number', '=', 'questions.question_number')
		->and_on('answers.round_id', '=', 'questions.round_id')
		->join('choices', 'INNER')
		->on('questions.id', '=', 'choices.question_id')
		->and_on('choices.correct_flag', '=', DB::EXPR(1))
		->join('firstcategories', 'INNER')
		->on('questions.firstcategory_id', '=', 'firstcategories.id')
		->join('secondcategories', 'INNER')
		->on('firstcategories.secondcategory_id', '=', 'secondcategories.id')
		->join('thirdcategories', 'INNER')
		->on('secondcategories.thirdcategory_id', '=', 'thirdcategories.id')
		->join('topcategories', 'INNER')
		->on('thirdcategories.topcategory_id', '=', 'topcategories.id');	

		/*
		 * WHERE
		 */
		if($event_id) {
			$correct_counts->where('answers.id', '=', $event_id);
		}
		
		/*
		 * group by
		 */
		$correct_counts->group_by('topcategories.id');
		$correct_counts->group_by('topcategories.top_category_name');
		
		return $correct_counts->execute();
	}
}
