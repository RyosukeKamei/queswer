<?php

namespace Fuel\Migrations;

class Create_top_categories
{
	public function up()
	{
		\DBUtil::create_table('top_categories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'organization_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
		    'top_category_name' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('top_categories');
	}
}