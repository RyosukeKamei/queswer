<?php

namespace Fuel\Migrations;

class Create_choices
{
	public function up()
	{
		\DBUtil::create_table('choices', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
		    // unsignedにしないと外部キーを貼るときにエラー
		    'question_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true), 
			'choice_num' => array('constraint' => 11, 'type' => 'int'),
			'choice_body' => array('type' => 'text'),
			'correct_flag' => array('type' => 'boolean'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		
		/*
		 * question（問題をJOIN）
		 * 外部キーを貼るときに必要なindexは自動的に貼ってくれる？
		 */
		\DBUtil::add_foreign_key('choices', [
		        'constraint' => 'index_choices_to_question',
		        'key' => 'question_id',
		        'reference' => [
		                'table' => 'questions',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE'
		        , 'on_delete' => 'CASCADE'
		]);
	}

	public function down()
	{
		\DBUtil::drop_table('choices');
	}
}