<?php
use Orm\Model;

class Model_Question extends Model
{
	protected static $_properties = array(
		'id',
		'question_number',
		'question_body',
		'question_commentary',
		'firstcategory_id',
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
            $val->add_field('firstcategory_id', 'First Category Id', 'required|valid_string[numeric]'); // 固定値なのであまり関係ない
            $val->add_field('divition_id', 'Divition Id', 'required|valid_string[numeric]');             // 固定値なのであまり関係ない
            $val->add_field('round_id', 'Round Id', 'required|valid_string[numeric]');                   // 固定値なのであまり関係ない
            $val->add_field('prefix_id', 'Prefix Id', 'required|valid_string[numeric]');                 // 固定値なのであまり関係ない
		}
		return $val;
	}

	/*
	 * round
	 *  examination
	 * divition
	 * をJOINするために追加
	 */
	protected static $_belongs_to = array('round', 'divition', 'firstcategory', 'choice');
	
	/**
	 * get_questions
	 * 問題データを取得
	 * 
	 * @todo
	 * すべてのWHEREに対応していない
	 * 
	 * @param array $question_wheres where句の元
	 * @param int $get_one 1:get_one 0:get
	 * @return $question_obj->get_one() か $question_obj->get()
	 */
	public static function get_questions($question_wheres, $get_one = 0) {
	    $question_obj = parent::query()
	    ->related('round')
	    ->related('round.examination')
        ->related('divition')
        ->related('firstcategory')
        ->related('firstcategory.secondcategory')
        ->related('firstcategory.secondcategory.thirdcategory');
	    
	    /*
	     * WHERE句
	     */
	    //-- 小項目 firstcategory_id
	    if(!empty($question_wheres['firstcategory_id'])) {
	        $question_obj->where('firstcategory_id', $question_wheres['firstcategory_id']);
	    }
	    
	    //-- 問題番号 question_number
	    if(!empty($question_wheres['question_number'])) {
	        $question_obj->where('question_number', $question_wheres['question_number']);
	    }
	    
	    //-- 問題の回数 round_id
	    if(!empty($question_wheres['round_id'])) {
	        $question_obj->where('round_id', $question_wheres['round_id']);
	    }
	    
	    //-- get_one（１行）がget（複数行）か
	    if((int)$get_one === 1) {
	        return $question_obj->get_one();
	    } else {
	        return $question_obj->get();
	    }
	}
}
