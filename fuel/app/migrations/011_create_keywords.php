<?php

namespace Fuel\Migrations;

class Create_keywords
{
	public function up()
	{
		\DBUtil::create_table('keywords', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'keyword' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'desctiption' => array('type' => 'text'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('keywords');
	}
}