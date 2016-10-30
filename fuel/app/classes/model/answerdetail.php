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

}
