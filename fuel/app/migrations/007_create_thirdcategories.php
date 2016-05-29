<?php

namespace Fuel\Migrations;

class Create_thirdcategories
{
	public function up()
	{
		\DBUtil::create_table('thirdcategories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'topcategory_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'third_category_name' => array('constraint' => 255, 'type' => 'varchar'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * topcategoriesをJOIN
		 */
		\DBUtil::add_foreign_key('thirdcategories', [
		        'constraint' => 'index_thirdcategories_to_topcategories',
		        'key' => 'topcategory_id',
		        'reference' => [
		                'table' => 'topcategories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);		
	}

	public function down()
	{
		\DBUtil::drop_table('thirdcategories');
	}
}