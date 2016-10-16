<?php
use Orm\Model;

class Model_Answer extends Model
{
	protected static $_properties = array(
		'id',
		'round_id',
		'user_id',
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
	
	/**
	 * create_answer
	 * 解答ヘッダのレコードを生成
	 * 
	 * @param int $round_id  実施回
	 * @param int $user_id   ユーザID
	 * @param int $frequency 回数
	 * @return number
	 */
	public static function create_answer($round_id /* = 14 */, $user_id /* = 1 */, $frequency /* = 1 */) 
	{
		$answer = Model_Answer::forge(array(
			'round_id'     => $round_id,				// 実施回
			'user_id'      => $user_id,					// ユーザID
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
}
