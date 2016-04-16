<?php
use Orm\Model;

class Model_Question extends Model
{
	protected static $_properties = array(
		'id',
		'question_number',
		'question_body',
		'question_commentary',
		'first_category_id',
		'divition_id',
		'round_id',
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
		$val->add_field('question_number', 'Question Number', 'required|valid_string[numeric]');
		$val->add_field('question_body', 'Question Body', 'required');
		$val->add_field('question_commentary', 'Question Commentary', 'required');
		$val->add_field('first_category_id', 'First Category Id', 'required|valid_string[numeric]');
		$val->add_field('divition_id', 'Divition Id', 'required|valid_string[numeric]');
		$val->add_field('round_id', 'Round Id', 'required|valid_string[numeric]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}

}
