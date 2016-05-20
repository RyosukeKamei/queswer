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
		'prefix_id',
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
		if($factory === 'question_create') {
            $val->add_field('question_number', '問題番号', 'required|valid_string[numeric]');              // 固定値なのであまり関係ない
           	$val->add_field('conveted_question_body', 'コンバートした問題文', 'required');                              // 問題文は未入力チェックのみ
            $val->add_field('question_commentary', '解説', 'required');                                   // 固定値なのであまり関係ない
            $val->add_field('first_category_id', 'First Category Id', 'required|valid_string[numeric]'); // 固定値なのであまり関係ない
            $val->add_field('divition_id', 'Divition Id', 'required|valid_string[numeric]');             // 固定値なのであまり関係ない
            $val->add_field('round_id', 'Round Id', 'required|valid_string[numeric]');                   // 固定値なのであまり関係ない
            $val->add_field('prefix_id', 'Prefix Id', 'required|valid_string[numeric]');                 // 固定値なのであまり関係ない
		}
		return $val;
	}


}
