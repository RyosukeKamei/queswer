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

	public static function validate($factory, $choice_num = '')
	{
    	$val = Validation::forge($factory.$choice_num);
	    if($factory == 'convert') 
		{
            /*
             * コンバートする場合は、問題番号はQuestionでバリデーションし、
             * 選択肢番号は1から4で固定
             * 図形に選択肢がある時は空白がありえる
             */
// 		    $val->add_field('choice_body_'.$choice_num, '選択肢', 'required');                   // 選択肢
		} else
		{
		    /*
		     * デフォルト
		     */
		    $val->add_field('question_id', '問題番号', 'required|valid_string[numeric]');  // 1問から80問
		    $val->add_field('choice_num', '選択肢番号', 'required|valid_string[numeric]');  // ア、イ、ウ、エ
		    $val->add_field('choice_body', '選択肢', 'required');                          // 選択肢
		    $val->add_field('correct_flag', 'Correct Flag', 'required');
		    $val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');
		}
		return $val;
	}
	
	/*
	 * questionをJOINするために追加
	 */
	protected static $_belongs_to = ['question'];
	
	/**
	 * get_choice_keywords
	 * round_idとquestion_idで指定した
	 *
	 * @param int $round_id 例：14 平成27年度応用情報技術者試験
	 * @param int $question_number 問題の番号
	 */
	public static function get_choice_keywords (
			  $round_id        /* = 14 */
			, $question_number /* = 1  */
	)
	{
		return DB::select(
		          'keywords.id'
		        , 'keywords.keyword'
		        , 'keywords.description'
		        , 'questions.round_id'
		        , 'questions.question_number')
        	->from('choices')
        	->join('questions', 'INNER')
        	->on('questions.id', '=', 'choices.question_id')
        	->join('keywords',  'INNER')
        	->on('choices.choice_body', 'LIKE', DB::expr('CONCAT("%", `keywords`.`keyword`, "%")'))
        	->where('questions.round_id'       , $round_id)
        	->where('questions.question_number', $question_number)
        	->execute();
	}	
	
}
