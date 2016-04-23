<?php

namespace Fuel\Migrations;

class Create_beforequestions
{
	public function up()
	{
		\DBUtil::create_table('beforequestions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'question_number' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'question_body' => array('type' => 'text'),
			'question_commentary' => array('type' => 'text'),
			'first_category_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'divition_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'round_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'prefix_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('beforequestions');
	}
}