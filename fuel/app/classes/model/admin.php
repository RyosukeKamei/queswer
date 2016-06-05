<?php
use Orm\Model;

class Model_Admin extends Model
{
	protected static $_properties = array(
		'id',
	    'username',
		'password',
 		'examination_id',
 		'group',
		'email',
 		'last_login',
		'login_hash',
		'profile_fields',
		'deleted_at',
		'created_at',
		'updated_at',
	);

	/*
	 * 【参考】
	 * 自動的に日付を追加／更新してくれる
	 * CreatedAtはINSERT時のみ
	 * UpdatedAtは保存（INSERT/UPDATE両方）時
	 */
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
		/*
		 * 今後、デフォルトにないバリデーションがあった場合は、オリジナルバリデーションを作る
		 * 【参考】
		 * http://raining.bear-life.com/fuelphp/バリデーションのルールを追加する
		 */
	    $validation = Validation::forge($factory);
		/*
		 * 第2引数は「ラベル」なのでエラーメッセージの時に表示するはず…
		 * 日本語の方が良いかも
		 * トライアンドエラーしてみて
		 */
	    $validation->add_field('user_id',        'User Id',        'required|max_length[255]');
		$validation->add_field('password',       'Password',       'required|max_length[255]');
		$validation->add_field('examination_id', 'Examination Id', 'required|valid_string[numeric]');
// 		$validation->add_field('deleted_at',     'Deleted At',     'required|valid_string[numeric]');

		return $val;
	}
}
