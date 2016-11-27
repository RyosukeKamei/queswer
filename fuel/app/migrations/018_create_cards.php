<?php

namespace Fuel\Migrations;

class Create_cards
{
	public function up()
	{
		\DBUtil::create_table('cards', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'card_name' => array('constraint' => 255, 'type' => 'varchar'),
			'point_distribution' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'topcategory_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('cards');
	}
}