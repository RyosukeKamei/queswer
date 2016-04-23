<?php
use Orm\Model;

class Model_Keyword_Category extends Model
{
	protected static $_properties = array(
		'id',
		'first_category_id',
		'keyword_id',
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
		$val->add_field('first_category_id', 'First Category Id', 'required|valid_string[numeric]');
		$val->add_field('keyword_id', 'Keyword Id', 'required|valid_string[numeric]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}

}
