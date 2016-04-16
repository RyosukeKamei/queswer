<?php

namespace Fuel\Migrations;

class Create_questions
{
	public function up()
	{
		\DBUtil::create_table('questions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'question_number' => array('constraint' => 11, 'type' => 'int'),
			'question_body' => array('type' => 'text'),
			'question_commentary' => array('type' => 'text'),
			'first_category_id' => array('constraint' => 11, 'type' => 'int'),
			'divition_id' => array('constraint' => 11, 'type' => 'int'),
			'round_id' => array('constraint' => 11, 'type' => 'int'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('questions');
	}
}