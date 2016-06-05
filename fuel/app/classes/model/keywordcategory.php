<?php
use Orm\Model;

class Model_Keywordcategory extends Model
{
	protected static $_properties = array(
		'id',
		'firstcategory_id',
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
		$val->add_field('firstcategory_id', 'Firstcategory Id', 'required|valid_string[numeric]');
		$val->add_field('keyword_id', 'Keyword Id', 'required|valid_string[numeric]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');

		return $val;
	}
	
	/*
	 * secondcategoryをJOIN
	 */
	protected static $_belongs_to = array('keyword', 'firstcategory');
	
	/**
	 * get_keywordcategories
	 * キーワードカテゴリーと関連付けたキーワードを取得
	 *
	 * @todo
	 * すべてのWHEREに対応していない
	 *
	 * @param array $keywordcategory_wheres where句の元
	 * @param int $get_one 1:get_one 0:get
	 * @return $question_obj->get_one() か $question_obj->get()
	 */
	public static function get_keywordcategories($keywordcategory_wheres, $get_one = 0) {
	    $keywordcategory_obj = parent::query()
        ->related('firstcategory')
        ->related('firstcategory.secondcategory')
        ->related('firstcategory.secondcategory.thirdcategory')
        ->related('keyword');
	    	     
	    /*
	     * WHERE句
	     */
	    //-- 中項目 secondcategory_id
	    if(!empty($keywordcategory_wheres['secondcategory_id'])) {
	        $keywordcategory_obj->where(
	                'firstcategory.secondcategory_id'
	                , $keywordcategory_wheres['secondcategory_id']
	        );
	    }
	    
		//-- 小項目 firstcategory_id
	    if(!empty($keywordcategory_wheres['firstcategory_id'])) {
	        $keywordcategory_obj->where(
	                'firstcategory_id'
	                , $keywordcategory_wheres['firstcategory_id']
	        );
	    }
	    
	    //-- キーワードID
	    if(!empty($keywordcategory_wheres['keyword_id'])) {
	        $keywordcategory_obj->where(
	                'keyword_id'
	                , $keywordcategory_wheres['keyword_id']
	        );
	    }
	     
	    //-- get_one（１行）がget（複数行）か
	    if((int)$get_one === 1) {
	        return $keywordcategory_obj->get_one();
	    } else {
	        return $keywordcategory_obj->get();
	    }
	}
}
