<?php
use Orm\Model;

class Model_Choice extends Model
{
	protected static $_properties = array(
		'id',
		'question_id',
		'choice_num',
		'choice_body',
		'correct_flag',
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
		$val->add_field('question_id', 'Question Id', 'required|valid_string[numeric]');
		$val->add_field('choice_num', 'Choice Num', 'required|valid_string[numeric]');
		$val->add_field('choice_body', 'Choice Body', 'required');
		$val->add_field('correct_flag', 'Correct Flag', 'required');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}
	/*
	 * questionをJOINするために追加
	 */
	protected static $_belongs_to = ['question'];
	
}
