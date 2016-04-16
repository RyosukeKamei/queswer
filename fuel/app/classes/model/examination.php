<?php
use Orm\Model;

class Model_Examination extends Model
{
	protected static $_properties = array(
		'id',
		'examination_name',
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
		$val->add_field('examination_name', 'Examination Name', 'required|max_length[255]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}

}
