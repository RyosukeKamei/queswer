<?php
use Orm\Model;

class Model_Answerdetail extends Model
{
	protected static $_properties = array(
		'id',
		'question_num',
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
		$val->add_field('question_num', 'Question Num', 'required|valid_string[numeric]');
		$val->add_field('answer_id', 'Answer Id', 'required|valid_string[numeric]');
		$val->add_field('answer', 'Answer', 'required|valid_string[numeric]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}

}
