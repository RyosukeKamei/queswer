<?php

namespace Fuel\Migrations;

class Create_events
{
	public function up()
	{
		\DBUtil::create_table('events', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'examination_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'round_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'start_datetime' => array('type' => 'timestamp'),
			'finish_datetime' => array('type' => 'timestamp'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('events');
	}
}