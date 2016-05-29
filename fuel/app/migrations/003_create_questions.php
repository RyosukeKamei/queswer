<?php

namespace Fuel\Migrations;

class Create_questions
{
	public function up()
	{
		\DBUtil::create_table('questions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'question_number' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
// 			'question_title' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'question_body' => array('type' => 'text'),
			'question_commentary' => array('type' => 'text'),
			'firstcategory_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'divition_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'round_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'prefix_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * questions から roundsをJOIN
		 */
		\DBUtil::add_foreign_key('questions', [
		        'constraint' => 'index_questions_to_rounds',
		        'key' => 'round_id',
		        'reference' => [
		                'table' => 'rounds',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
		
	}

	public function down()
	{
		\DBUtil::drop_table('questions');
	}
}