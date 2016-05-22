<?php

namespace Fuel\Migrations;

class Create_answerdetails
{
	public function up()
	{
		\DBUtil::create_table('answerdetails', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'question_num' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'answer_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'answer' => array('constraint' => 11, 'type' => 'int', 'null' => true, 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));

		/*
		 * answerをJOIN
		 */
		\DBUtil::add_foreign_key('answerdetails', [
		        'constraint' => 'index_answerdetails_to_answers',
		        'key' => 'answer_id',
		        'reference' => [
		                'table' => 'answers',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
		
	}

	

	public function down()
	{
		\DBUtil::drop_table('answerdetails');
	}
}