<?php
use Orm\Model;

class Model_Round extends Model
{
	protected static $_properties = array(
		'id',
		'round_name',
		'examination_id',
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
		$val->add_field('round_name', 'Round Name', 'required|max_length[255]');
		$val->add_field('examination_id', 'Examination Id', 'required|valid_string[numeric]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}
	
	/*
	 * examinationsをJOINするために追加
	 */
	protected static $_belongs_to = ['examination'];
	
	/**
	 * 問題一覧画面に表示する
	 * @param int $examnation_id 実施回 平成28年度秋応用情報技術者試験なら15
	 */
	public static function get_rounds_by_examination($examnation_id)
	{
		return DB::select(
					  array('rounds.id', 'round_id')
					, array('answers.id', 'answer_id')
					, array('rounds.round_name', 'round_name')
					, array('examinations.examination_name', 'examination_name')
				)
				->from('rounds')
				->join('examinations', 'INNER')
				->on('rounds.examination_id', '=', 'examinations.id')
				->join('answers', 'LEFT')
				->on('rounds.id', '=', 'answers.round_id')
				->and_on('answers.finish_flag', '=', db::expr(0))
				->where('rounds.examination_id', $examnation_id)
				->order_by('rounds.id', 'desc')
				->execute();
	}
	
}
