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
	
}
