<?php

namespace Fuel\Migrations;

class Create_examinations
{
	public function up()
	{
		\DBUtil::create_table('examinations', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'examination_name' => array('constraint' => 255, 'type' => 'varchar'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('examinations');
	}
}