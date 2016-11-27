<?php
use Orm\Model;

class Model_Card extends Model
{
	protected static $_properties = array(
		'id',
		'card_name',
		'point_distribution',
		'topcategory_id',
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
		$val->add_field('card_name', 'Card Name', 'required|max_length[255]');
		$val->add_field('point_distribution', 'Point Distribution', 'required|valid_string[numeric]');
		$val->add_field('topcategory_id', 'Topcategory Id', 'required|valid_string[numeric]');

		return $val;
	}

}
