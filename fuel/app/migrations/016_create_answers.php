<?php

namespace Fuel\Migrations;

class Create_answers
{
	public function up()
	{
		\DBUtil::create_table('answers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'round_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'event_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'finish_flag' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),		
			'frequency' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('answers');
	}
}