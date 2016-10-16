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
	
	public static function create_answer_details($answer_id) {
		for($question_number = 1; $question_number <= 80; $question_number++) {
			$answer_detail = Model_Answerdetail::forge(array(
					'question_number'     => $question_number,		// 問題番号
					'answer_id'      => $answer_id,					// 解答ヘッダID
			));
			
			if (!($answer_detail and $answer_detail->save())) {
				return false;
			}
		}
		return true;
	}

}
