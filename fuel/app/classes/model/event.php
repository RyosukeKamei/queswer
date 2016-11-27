<?php
use Orm\Model;

class Model_Event extends Model
{
	protected static $_properties = array(
		'id',
		'examination_id',
		'round_id',
		'start_datetime',
		'finish_datetime',
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
		$val->add_field('examination_id', 'Examination Id', 'required|valid_string[numeric]');
		$val->add_field('round_id', 'Round Id', 'required|valid_string[numeric]');
		$val->add_field('start_datetime', 'Start Datetime', 'required');
		$val->add_field('finish_datetime', 'Finish Datetime', 'required');

		return $val;
	}
	
	/*
	 * round
	 * examination
	 * をJOINするために追加
	 */
	protected static $_belongs_to = array('round', 'examination');
	
	
	/**
	 * get_event_ranking
	 * イベントのサマリーを取得する
	 *
	 * @param int $event_id イベントID
	 */
	public static function get_event_ranking($event_id) {
		$event_rankings = DB::select(
				 'answers.user_id'
				, 'admins.username'
				, array(DB::EXPR('SUM(CASE WHEN `answerdetails`.`answer` = `choices`.`choice_num` THEN 1 ELSE 0 END)'), 'correct_count')
				, array(DB::EXPR('COUNT(`answers`.`user_id`)'), 'question_count')
		)
		->from('answerdetails')
		->join('answers', 'INNER')
		->on('answerdetails.answer_id', '=', 'answers.id')
		->join('admins', 'INNER')
		->on('answers.user_id', '=', 'admins.id')
		->join('questions', 'INNER')
		->on('answerdetails.question_number', '=', 'questions.question_number')
		->and_on('answers.round_id', '=', 'questions.round_id')
		->join('choices', 'INNER')
		->on('questions.id', '=', 'choices.question_id')
		->and_on('choices.correct_flag', '=', DB::EXPR(1));
	
		/*
		 * イベントID
		 */
		if($event_id)
		{
			$event_rankings->where('answers.event_id', $event_id);
		}
	
		/*
		 * group by
		 */
		$event_rankings->group_by('answers.user_id');
		$event_rankings->group_by('admins.username');
		
		/*
		 * order by
		 */
		$event_rankings->order_by('correct_count', 'DESC');
	
		return $event_rankings->execute();
	}

	public static function get_event_infos($event_id) {
		$event_infos = DB::select(
				  'events.id'
				, 'rounds.round_name'
				, 'examinations.examination_name'
		)
		->from('events')
		->join('rounds', 'INNER')
		->on('events.round_id', '=', 'rounds.id')
		->join('examinations', 'INNER')
		->on('events.examination_id', '=', 'examinations.id');
	
		/*
		 * イベントID
		 */
		if($event_id)
		{
			$event_infos->where('events.id', $event_id);
		}
	
		return $event_infos->execute();
	}
}
